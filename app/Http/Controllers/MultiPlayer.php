<?php

namespace App\Http\Controllers;

use App\Events\PresenceUser;
use App\Models\BaseUser;
use App\Models\Hopital;
use App\Models\Personnel_user;
use App\Models\TypeBase;
use App\Models\UniteUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MultiPlayer extends Controller
{
    
    public function index()
    {
        $hopitals = Hopital::all();
        $typeDeBase = TypeBase::all();
        // $baseUser = BaseUser::where('user_id', Auth::guard('appuser')->user()->id);
        // $uniteUser = UniteUser::where('user_id', Auth::guard('appuser')->user()->id);
        // $personnel = Personnel_user::join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')->where('user_id', Auth::guard('appuser')->user()->id)->get();
        // $missionUser = DB::select("SELECT m.description_mission, mu.id, mu.is_completed  , m.personnel_id, m.type_unite_id, mu.position_x, mu.position_y, mu.icon, mu.etat, m.nom_mission, m.duree, m.recompense, m.image FROM missions AS m, users AS u, mission_users AS mu WHERE m.id = mu.mission_id AND " . Auth::guard('appuser')->user()->id . " = mu.user_id AND mu.is_completed < 1 ;");
        return view('dashboard.multiplayer', compact('hopitals', 'typeDeBase'));
    }

    public function LoadUserConnected()
    {
        $users = User::where('online', 1)->get();
        return $users;
    }
}
