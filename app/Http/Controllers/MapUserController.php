<?php

namespace App\Http\Controllers;

use App\Models\BaseUser;
use App\Models\TypeBase;
use App\Models\Hopital;
use App\Models\Mission;
use App\Models\Unite;
use App\Models\ParametreJeu;
use App\Models\MissionUser;
use App\Models\Personnel_user;
use App\Models\UniteUser;
use App\Models\User;
use App\Models\Ville;
use DateTime;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MapUserController extends Controller
{
    public function index()
    {
        $dateNow = new DateTimeImmutable();
        $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
        $hopitals = Hopital::all();
        $typeDeBase = TypeBase::all();
        $baseUser = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->get();
        $uniteUser = UniteUser::where('user_id', Auth::guard('appuser')->user()->id)->get();
        $villes = Ville::all();
        $gameSetting = ParametreJeu::find(1);
        $user = User::find(Auth::guard('appuser')->user()->id);
        $personnel = Personnel_user::join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')->where('user_id', Auth::guard('appuser')->user()->id)->get();
        $missionUser = DB::select("SELECT m.description_mission, mu.id, mu.is_completed, mu.fin_mission, m.personnel_id, m.type_unite_id, mu.position_x, mu.position_y, mu.icon, mu.etat, m.nom_mission, m.duree, m.recompense	FROM missions AS m INNER JOIN mission_users AS mu ON m.id = mu.mission_id INNER JOIN users AS u ON mu.user_id = u.id WHERE mu.user_id = " . Auth::guard('appuser')->user()->id ." AND mu.is_completed < 1 LIMIT 2;");
        return view('dashboard.game', compact('hopitals', 'dateNow', 'uniteUser', 'missionUser', 'personnel', 'personnel', 'typeDeBase', 'baseUser', 'user', 'villes', 'gameSetting'));
    }
    public function missionList()
    {
        $missionUser = DB::select("SELECT m.description_mission, mu.id, mu.is_completed , m.personnel_id, m.type_unite_id, mu.position_x, mu.position_y, mu.icon, mu.etat, m.nom_mission, m.duree, m.recompense, m.image FROM missions AS m, users AS u, mission_users AS mu WHERE m.id = mu.mission_id AND " . Auth::guard('appuser')->user()->id . " = mu.user_id AND mu.is_completed < 1 ;");
        return response()->json(['response' => $missionUser], 200);
    }

    public function listHospital()
    {
        $hopitals = Hopital::all();
        // return view('admin.map.index', compact('hopitals'));
        return response()->json(['response' => $hopitals], 200);
    }

    public function getVilleId($id)
    {
        $ville = Ville::find($id);
        return response()->json(['response' => $ville], 200);
    }

    public function getHospitalById($id)
    {
        $hopital = Hopital::find($id);
        return response()->json(['response' => $hopital], 200);
    }

    public function getUniteUserById($id)
    {
        $unite = UniteUser::find($id);
        return response()->json(['response' => $unite], 200);
    }

    public function getUniteById($id)
    {
        $unite = Unite::find($id);
        return response()->json(['response' => $unite], 200);
    }

    public function getBaseById($id)
    {
        $base = BaseUser::find($id);
        return response()->json(['response' => $base], 200);
    }

    public function listBase()
    {
        $hopitals = BaseUser::query()->where('user_id', Auth::guard('appuser')->user()->id)->get();
        // return view('admin.map.index', compact('hopitals'));
        return response()->json(['response' => $hopitals], 200);
    }

    public function updateUniteUser(Request $request)
    {
        $data = $request->all();
        $uniteUser = UniteUser::find($data['unite_user_id']);
        
        if($uniteUser){
            $sante = $uniteUser->sante - (($uniteUser->sante * $uniteUser->taux_usure)/100);
            $uniteUser->update(['etat_unite' => $data['etat_unite'], 'etat_mouvement_unite' =>'en pause', 'sante' => $sante ]);
            $missionUser = MissionUser::find($data['mission_user_id']);
            if ($missionUser) {
                $missionUser->update(['etat' => '0']);
            }
        }
    }

    public function updateUserMission(Request $request){
        $data = $request->all();
        // $id = 47;
        $missionUser = MissionUser::find($data['mission_user_id']);
        $missionUser->update(['etat' => intVal($data['etat']), 'is_completed' => intVal($data['is_completed']) ]);
        return response()->json(['response' => $missionUser  , ], 200);
        // return response()->json(['response' => true  ], 200);
    }

    public function listMission()
    {
        $mission = Mission::orderByRaw("RAND()")->first();
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
        // 0 e cours
        $data = $request->all();
        $data['user_id'] = Auth::guard('appuser')->user()->id;
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
        User::find(Auth::guard('appuser')->user()->id)->update(['ville' => $data['ville_id'], 'lat' => $data['position_y'], 'lgt' => $data['position_x'], 'experience' => intval(Auth::guard('appuser')->user()->experience) + 1000]);
        $data['user_id'] = Auth::guard('appuser')->user()->id;
        BaseUser::create($data);
        return redirect('/dashboard/jeu')->with('status', 'Base ajoutée!');
    }

}
