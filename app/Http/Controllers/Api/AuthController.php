<?php

namespace App\Http\Controllers\Api;

use App\Events\PresenceUser;
use App\Http\Controllers\Controller;
use App\Mail\Authentification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\MissionUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function register(Request $request)
    {

         $request->validate([
            'email' => 'bail|required|unique:users|email',
            'password' => ['bail', 'required', 'min:8'],
            'pseudo' => ['required', 'min:3'],
        ]);
    
        $data = $request->all();
        $data['password'] =  Hash::make($request->password);
        $data['profile'] = "/assets/images/user-profile.png";
        $data['pseudo'] = $request->pseudo;
        $data['email'] = $request->email;
        $data['lat'] = $request->lat;
        $data['lgt'] = $request->lgt;
       
        // $data['language'] = Setting::first()->language;
        $user = User::create($data);
        $user['token'] = $user->createToken('urgenceSAMU')->accessToken;
        // Mail::to("hunterjul007@gmail.com")->send(new Authentification());
        event(new Registered($user));
        // Mail::send('emails.welcome', ['name' => 'John Doe'], function($message) {
        //     $message->from('urgenceSAMU@example.com', 'urgenceSAMU')
        //             ->to('hunterjul007@gmail.com    ', 'Destinataire')
        //             ->subject('Bienvenue !');
        // });
        return redirect('/inscription-complet');;
        // return response()->json(, 200);
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' =>  ['bail', 'required', 'min:8'],
            // 'g-recaptcha-response' => 'recaptcha'
        ]);
        $data = array('email' => $request->email, 'password' => $request->password);
    
        $userLogFirst = User::where('email', $request->email)->first();
        if (is_null($userLogFirst)) {
            return redirect('/connexion')->with("message", "Ce compte n'existe pas!");
        }else{
            if(!$userLogFirst->is_verified){
        //    event(new Registered($userLogFirst));
                    return redirect('/email/verify');
            } 
           
        }
        if (Auth::guard('appuser')->attempt($data)) {

            $user = Auth::guard('appuser')->user();
        
            $userLog = User::find($user->id);
            $userLog->update(['online' => true]);
            // broadcast(new PresenceUser($userLog));
            $user['token'] = $user->createToken('urgenceSAMU')->accessToken;
            return redirect('/dashboard');
            
        } else {

            // return 0;
            return redirect('/connexion')->with("message", "Mot de passe ou E-mail incorrect");
        }
    }
   

    
    public function userLogout()
    {
        //  return response()->json(['message' => 'Mot de passe ou E-mail incorrect'], 200);
        if (Auth::guard('appuser')->check()) {
            $user = User::find(Auth::guard('appuser')->user()->id);
            $user->update(['online' => false]);
            MissionUser::updatePendingMissionOnLogout();
            Auth::guard('appuser')->logout();
            // broadcast(new PresenceUser($user));
            return redirect('/connexion');
        }
    }

    public function verificationNotif (Request $request) {    
        $request->user()->sendEmailVerificationNotification();
        return back()->with('message', 'Verification link sent!');
    }

    public function loginAdmin(Request $request)
    {
        $request->validate([
            'email' => 'bail|required|email',
            'password' => 'bail|required',
        ]);

        $data = array('email' => $request->email, 'password' => $request->password);
        if (Auth::guard('appadmin')->attempt($data)) {
            $admin = Auth::guard('appadmin')->user();
            // return response()->json(['message' => ], 200);
            $admin['token'] = $admin->createToken('urgenceSAMU')->accessToken;
            return redirect('admin/dashboard');
        } else {
            return view('admin.auth.login', ['message' => 'Mot de passe ou E-mail incorrect']);
        }
    }

    public function logoutAdmin()
    {
        //  return response()->json(['message' => 'Mot de passe ou E-mail incorrect'], 200);
        if (Auth::guard('appadmin')->check()) {
            Auth::guard('appadmin')->logout();
            return redirect('/admin/connexion');
        } else {
            return redirect('/admin/dashboard');
        }
    }
}
