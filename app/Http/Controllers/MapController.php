<?php

namespace App\Http\Controllers;

use App\Models\Base;
use App\Models\BaseUser;
use App\Models\TypeBase;
use App\Models\Hopital;
use App\Models\Mission;
use App\Models\MissionUser;
use App\Models\Personnel_user;
use App\Models\UniteUser;
use App\Services\HopitalService;
use DateTime;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index()
    {
        $dateNow = new DateTimeImmutable();
        $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
        $hopitals = Hopital::all();
        $typeDeBase = TypeBase::all();
        $baseUser = BaseUser::where('user_id', Auth::guard('appuser')->user()->id);
        $uniteUser = UniteUser::where('user_id', Auth::guard('appuser')->user()->id);
        $personnel = Personnel_user::join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')->where('user_id', Auth::guard('appuser')->user()->id)->get();
        $missionUser = DB::select("SELECT m.description_mission, m.id, m.nom_mission, mu.fin_mission, m.recompense, m.image FROM missions AS m, users AS u, mission_users AS mu WHERE m.id = mu.mission_id AND " .  Auth::guard('appuser')->user()->id . " = mu.user_id AND mu.is_completed <> 1 GROUP BY m.id;");
        return view('admin.map.index', compact('hopitals', 'dateNow',  'missionUser', 'typeDeBase', 'baseUser', 'uniteUser', 'personnel'));
    }
   
    public function missionList()
    {
        $missionUser = DB::select("SELECT m.description_mission, m.id, m.nom_mission, m.duree, m.recompense, m.image FROM missions AS m, users AS u, mission_users AS mu WHERE m.id = mu.mission_id AND " .  Auth::guard('appuser')->user()->id . " = mu.user_id AND mu.is_completed <> 1 GROUP BY m.id;");
        return response()->json(['response' => $missionUser], 200);
    }
    public function listHospital(HopitalService $hopitalService)
    {
        $base = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
    
        $hopitals = $hopitalService->getCloserToBase($base);

        return response()->json(['response' => $hopitals], 200);
    }
    public function getHospitalById($id)
    {
        $hopital = Hopital::find($id);
        return response()->json(['response' => $hopital], 200);
    }
    public function getBaseById($id)
    {
        $base = BaseUser::find($id);
        return response()->json(['response' => $base], 200);
    }
    public function listBase()
    {
        $hopitals = BaseUser::query()->where('user_id', '=', Auth::guard('appuser')->user()->id)->get();
        // return view('admin.map.index', compact('hopitals'));
        return response()->json(['response' => $hopitals], 200);
    }
    public function listMission()
    {
        $mission = Mission::orderByRaw("RAND()")->get();
        $origineX = 51.505;
        $origineY = -1.20;
        $countDown = 1500;
        $rayon = rand(-10,10) / 1000;
        $positionY = $origineY + $rayon;
        $positionX = $origineX + $rayon ;
        $nameArray = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
        $rand_keys = array_rand($nameArray, 2);
        $name = $nameArray[$rand_keys[0]];
        return response()->json(['response' => $mission, 'countDown' => $countDown, 'positionX' =>  $positionX, 'positionY' =>  $positionY, 'patient' => $name  ], 200);
    }
    public function AddingTime($time1,$time2)
    {
        $x = new DateTime($time1);
        $y = new DateTime($time2);
        $interval1 = $x->diff(new DateTime('00:00:00')) ;
        $interval2 = $y->diff(new DateTime('00:00:00')) ;
        $e = new DateTime('00:00');
        $f = clone $e;
        $e->add($interval1);
        $e->add($interval2);
        $total = $f->diff($e)->format("%H:%I:%S");;
        return $total;
    }
    public function addUserMission(Request $request)
    {
     
        $data = $request->all();
        $data['user_id'] =  Auth::guard('appuser')->user()->id;
        $data['is_completed'] = 0;
        $dateNowInit = new DateTimeImmutable();
        $dateNow = date_format($dateNowInit, 'H:i:s');
        $dateNow2 = date_format($dateNowInit, 'Y-m-d');
        $dateFinal = new DateTimeImmutable($dateNow2. ' '. $this->AddingTime( $dateNow, $data['duree']));
        
        $data['fin_mission'] = date_format($dateFinal, 'Y-m-d H:i:s');
        MissionUser::create($data);
        // return view('admin.map.index', compact('hopitals'));
        return response()->json(['message' => true], 200);
    }
    public function storeBase(Request $request)
    {
       // return response()->json($request->all(), 200);
        $data = $request->all();
        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $pathImage = 'images/' . $imageName;
            $data['icon_base'] = $pathImage;
            // return response()->json(['message' => $data['image']], 200);
        }
        $data['user_id'] =  Auth::guard('appuser')->user()->id;
        BaseUser::create($data);

        return redirect('/admin/dashboard/map')->with('status', 'Base ajoutée!');
    }
    public function storeHopital(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('icon_hopital')) {
            $image = $request->icon_hopital;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $pathImage = 'images/' . $imageName;
            $data['icon_hopital'] = $pathImage;
            // return response()->json(['message' => $data['image']], 200);
        } else {
            $data['icon_hopital'] = 'assets/images/hopital.svg';
        }
        if ($request->hasFile('image_hopital')) {
            $image = $request->image_hopital;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $pathImage = 'images/' . $imageName;
            $data['image_hopital'] = $pathImage;
            // return response()->json(['message' => $data['image']], 200);
        }
        Hopital::create($data);
        return redirect('/admin/dashboard/map')->with('status', 'Evénement ajouté!', 'color', 'success');
    }
    public function updateHopital(Request $request)
    {
        $data = $request->all();
        if ($request->hasFile('icon_hopital')) {
            $image = $request->icon_hopital;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $pathImage = 'images/' . $imageName;
            $data['icon_hopital'] = $pathImage;
            // return response()->json(['message' => $data['image']], 200);
        }
        if ($request->hasFile('image_hopital')) {
            $image = $request->image_hopital;
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $pathImage = 'images/' . $imageName;
            $data['image_hopital'] = $pathImage;
            // return response()->json(['message' => $data['image']], 200);
        }
        Hopital::find($request->id)->update($data);
        return redirect('/admin/dashboard/map')->with('status', 'Evénement modifié!',  'color', 'success');
    }

    public function deleteHopital($id)
    {
        Hopital::destroy($id);
        return redirect('/admin/dashboard/map')->with('status', 'Evénement supprimé!',  'color', 'danger');
    }
}
