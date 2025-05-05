<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $userCount = User::count();
        $users = User::all();
        $usersBlockedCount = User::query()
            ->where('isblocked', '1')
            ->count();
        $usersBanned = User::query()
            ->where('isblocked', '0')
            ->get();
        $usersOnline = User::query()
            ->where('online', '1')
            ->count();
        return view('admin.joueur.index', compact('userCount', 'users', 'usersBlockedCount', 'usersBanned', 'usersOnline'));
    }

    public function detailUser($id)
    {
        $user = User::find($id);
        // $order = Order::with(['customer', 'event', 'organization', 'ticket'])->find($id);
        // $orderchild = User::where('order_id', $order->id)->get();
        return view('admin.joueur.review', compact('user'));
    }

    public function rankingUser()
    {
        // abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $userCount = User::count();
        $users = User::query()
            ->orderBy('experience', 'desc')
            ->get();
        $usersBlockedCount = User::query()
            ->where('isblocked', '1')
            ->count();
        $usersBanned = User::query()
            ->where('isblocked', '1')
            ->get();
        $usersOnline = User::query()
            ->where('online', '1')
            ->count();
        return view('admin.joueur.index', compact('userCount', 'users', 'usersBlockedCount', 'usersBanned', 'usersOnline'));
    }

    public function bannedUser(Request $request)
    {
        //   return response()->json(['message' => intval($request['id'])], 200);
        // $request->validate($request, [
        //     'id' => 'required',
        // ]);
        $id = $request['id'];
        $user = User::find($id);
        if ($user->isblocked == 1) {
            $user->isblocked = 0;
        } else {
            $user->isblocked = 1;
        }
        $user->save();
        return redirect('/admin/dashboard/joueurs');
    }


}
