<?php

namespace App\Http\Controllers;

use App\Events\PrivateChat;
use App\Events\PublicChat;
use App\Events\MessageSent;
use App\Models\BaseUser;
use App\Models\Clan;
use App\Models\ClanUser;
use App\Models\Personnel_user;
use App\Models\UniteUser;
use App\Models\ChatMessage;
use App\Models\Formation;
use App\Models\equipementUser;
use App\Models\Hopital;
use App\Models\Mission;
use App\Models\MissionUser;
use App\Models\ParametreJeu;
use App\Models\Personnel;
use App\Models\Personnel_formation;
use App\Models\PrivateChatMessage;
use App\Models\TypeBase;
use DateTime;
use App\Models\TypeUnite;
use App\Models\Unite;
use App\Models\User;
use App\Models\Ville;
use DateTimeImmutable;
use DateTimeZone;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AppController extends Controller
{
  
  public function InitData (){
    $clanUser = ClanUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
    $baseUser = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->get();
    $villes = Ville::all();
    $typeDeBase = TypeBase::all();
    $gameSetting = ParametreJeu::find(1);
    $user = User::find(Auth::guard('appuser')->user()->id);
    $belongsToAlliance = false;
    if($clanUser){
      $belongsToAlliance = true;
    }
    $dateNow = new DateTimeImmutable();
    $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
    $dateNowF = new DateTimeImmutable($this->AddingTime( $dateNow, '0000-00-00 01:00:00'));
    $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');
   
    return view('dashboard.index', compact('baseUser', 'belongsToAlliance',  'villes', 'dateNow', 'typeDeBase', 'gameSetting', 'user'));
  }
  public function FirstBaseTemplate(){
    $clanUser = ClanUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
    $baseUser = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->get();
    $villes = Ville::all();
    $typeDeBase = TypeBase::all();
    $gameSetting = ParametreJeu::find(1);
    $user = User::find(Auth::guard('appuser')->user()->id);
    $belongsToAlliance = false;
    if($clanUser){
      $belongsToAlliance = true;
    }

    $dateNow = new DateTimeImmutable();
    $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
    $dateNowF = new DateTimeImmutable($this->AddingTime( $dateNow, '0000-00-00 01:00:00'));
    $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');
   
    return view('dashboard.game', compact('baseUser', 'belongsToAlliance',  'villes', 'dateNow', 'typeDeBase', 'gameSetting', 'user'));
  }
  
  public function InitMapData()
  {
        $hopitals = Hopital::all();
        $typeDeBase = TypeBase::all();
        $baseUser = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->get();
        $unites = UniteUser::query()->select('type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite',  'unite_users.*', 'unites.image')->join('unites', 'unites.id', '=', 'unite_users.unite_id')
        ->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')->where('unite_users.user_id', Auth::guard('appuser')->user()->id)
        ->get();
        $personnels  = Personnel_user::getPersonnels();
        $dataPersonnel = array();
        $personnelUser = array();
        foreach ($personnels as $key => $value) {
          $dataPersonnel['dateFin'] = $this->GetFormation($value->id, $value->etat_formation_personnel);
          $dataPersonnel['personnel'] = $value;
          $personnelUser[$key] = $dataPersonnel;
        }
        $user = User::find(Auth::guard('appuser')->user()->id);
        $ville = Ville::find($user->ville);
        $missionUser = MissionUser::where('user_id', Auth::guard('appuser')->user()->id)->get();
        $data = (object) array( 'missions' => $missionUser, 
                                'totalMissions' => 0, // count($missionUser)
                                'ville' => $ville, 
                                'intervaleTimeMission' => 0,
                                'personnels' => $personnelUser,
                                'unites' => $unites,
                                'bases' => $baseUser,
                                'types' => $typeDeBase,
                                'hopitals' => $hopitals);
        return  response()->json(['status' => 'success', 'data' =>  $data, 'message' => 'Vous avez acheté une unité'], 200 );
  }



  //////
  public function GetMission()
  {
    try {
      
      $lastMission= MissionUser::where('user_id',Auth::guard('appuser')->user()->id)
      ->where('etat', 'COMPLETED')
        ->orderByDesc('created_at')
        ->first();
        $hopital= $lastMission?->hopital;
        $mission = Mission::orderByRaw("RAND()")->first();
        $nameArray = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank", "Carli", "Mickey", "Jean", "Paul");
        $phoneArray = array("+33637855884", "+33920001827", "+33607042276", "+33820015283", "+33926484254", "+33359070527", "+33210455759", "+33203753154", "+33145789262", "+33831812282");
        $rand_keys = array_rand($nameArray, 2);
        $name = $nameArray[$rand_keys[0]];
        $dateNowInit = new DateTimeImmutable();
        $dateNow = date_format($dateNowInit, 'Y-m-d H:i:s');
        $dateNowF = new DateTimeImmutable($this->AddingTimeFormatio($dateNow, $mission->duree));
        $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');
        $phone = $phoneArray[$rand_keys[0]];
        $bases = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->count();
        $base = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
        $data = (object) array('patient_name' => $name, 'mission' => $mission, 'tel' => $phone, 'temps_restant' => $dateNowF, 'bases' => $bases, 'hopital' => $hopital, 'base' => $base);
        return  response()->json(['status' => 'success', 'data' =>  $data, 'message' => ''], 200);
    } catch (\Throwable $th) {
      return $th;
    }
  }
  
  public function ImportHopital()
  {
    // http://localhost:8000/dashboard/api/import-hopital
    try {
      // Chemin vers le fichier JSON
      $filePath = resource_path('data/hospitals_point.json');

      // Lire le fichier JSON
      $json = file_get_contents($filePath);
      $data = json_decode($json, true);

      // Plages de coordonnées pour la France
      $franceLatitudeMin = 41.0;
      $franceLatitudeMax = 51.5;
      $franceLongitudeMin = -5.0;
      $franceLongitudeMax = 9.5;

      $data['features'] = array_slice($data['features'], 0, 500);
      
      Hopital::all()->each->delete(); // Supprimer tous

      // Parcourir les hôpitaux et les insérer dans la base de données
      foreach ($data['features'] as $feature) {
        // Récupérer les coordonnées en EPSG:3857
        $x = $feature['geometry']['coordinates'][0]; // Coordonnée X (longitude en mètres)
        $y = $feature['geometry']['coordinates'][1]; // Coordonnée Y (latitude en mètres)

        // Conversion des coordonnées EPSG:3857 en WGS 84 (latitude et longitude)
        $lon = $x / 20037508.34 * 180; // Longitude en degrés
        $lat = $y / 20037508.34 * 180; // Latitude en degrés
        $lat = 180 / pi() * (2 * atan(exp($lat * pi() / 180)) - pi() / 2); // Correction pour la latitude

        // Vérifier si les coordonnées sont en France
        if (
          $lat >= $franceLatitudeMin && $lat <= $franceLatitudeMax &&
          $lon >= $franceLongitudeMin && $lon <= $franceLongitudeMax
        ) {
          $defaultImage = 'assets/icons/wb_-hospital-256.png'; // Vous pouvez modifier cela selon vos besoins
          // Créer l'hôpital dans la base de données avec les coordonnées converties
          Hopital::create([
            'nom_hopital' => $feature['properties']['name'] ?? "",
            'capacite_hopital' => $feature['properties']['capacity'] ?? 30,
            'position_x' => $lat, // Longitude convertie
            'position_y' => $lon, // Latitude convertie
            'icon_hopital' => $defaultImage, 
            'image_hopital' => $defaultImage,
          ]);
        } else {
          dd(['lat' => $lat, 'lon' => $lon]);
        }
      }

      return response()->json(['status' => 'success', 'data' => true, 'message' => 'Hôpitaux importés avec succès'], 200);
    } catch (\Throwable $th) {
      return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
    }
  }
  
  public function GetBases(){
    try{
      $data = BaseUser::query()->where('user_id', Auth::guard('appuser')->user()->id)->get();
      $datas = array();
      foreach ($data as $key => $value) {
        $base = (object) array('base' => $value, 'details' => $this->GetBaseDetailById($value->id));
        $datas[$key] = $base;
      }
      return  response()->json(['status' => 'success', 'data' =>  $datas, 'message' => ''], 200 );
    }catch (\Throwable $th) {
        return $th;
    }
  }
  
  public function GetBase($id){
    try{
      $base = BaseUser::find($id);
      $unite = UniteUser::where("base_id", $id)->get();
      $uniteDisponible = UniteUser::where("base_id", $id)->where('etat_unite', 'base')->get();
      $personnel = Personnel_user::getPersonnelsByBaseId($id);
      $personnelDisponible = Personnel_user::getPersonnelsInBase($id);
      $dataPersonnel = array();
      $datas = array();
      foreach ($personnel as $key => $value) {
        $dataPersonnel['dateFin'] = $this->GetFormation($value->id, $value->etat_formation_personnel);
        $dataPersonnel['personnel'] = $value;
        $datas[$key] = $dataPersonnel;
      }
      $data = (object) array('personnelDisponible' => $personnelDisponible, 'uniteDisponible' => $uniteDisponible, 'base' => $base, 'totalPersonnelDisponible' => count($personnelDisponible), 'personnel' => $datas, 'totalPersonnel' => count($personnel), 'totalUniteDisponible' => count($uniteDisponible), 'totalUnite' => count($unite), 'unites' => $unite);
      return  response()->json(['status' => 'success', 'data' =>  $data, 'message' => ''], 200 );
    }catch (\Throwable $th) {
        return $th;
    }
  }

  private function GetBaseDetailById($id){
    try{
      $unite = count(UniteUser::where("base_id", $id)->get());
      $uniteDisponible = count(UniteUser::where("base_id", $id)->where('etat_unite', 'base')->get());
      $personnel = count(Personnel_user::where("base_id", $id)->get());
      $personnelDisponible = count(Personnel_user::where("base_id", $id)->where('etat_formation_personnel', 'base')->get());
      $data = (object) array('personnelDisponible' => $personnelDisponible, 'personnel' => $personnel, 'uniteDisponible' => $uniteDisponible, 'unite' => $unite);
      return $data;
    }catch (\Throwable $th) {
        return $th;
    }
  }

  public function GetUserData () {
    try{
      $settingsGame = ParametreJeu::find(1);
      $prixClan = $settingsGame->prix_clan;
      $user = User::find(Auth::guard('appuser')->user()->id);
      $clanUser = ClanUser::where('user_id', $user->id)->first();
      $clan = null;
      $nbIntervention = count(MissionUser::where('user_id', Auth::guard('appuser')->user()->id)->get());
      $nbUnite = count(UniteUser::where('user_id', Auth::guard('appuser')->user()->id)->get());
      $nbPersonnel = count(Personnel_user::where('user_id', Auth::guard('appuser')->user()->id)->get());
      $nbInterventionSuccess = count(MissionUser::where('user_id', Auth::guard('appuser')->user()->id)->where('is_completed', 1)->get());
      $nbEquipement = count(equipementUser::where('user_id', Auth::guard('appuser')->user()->id)->get());
      $nbAmelioration = 0;
      if($nbIntervention > 0 && $nbInterventionSuccess > 0){
        $percentageSuccess = ($nbInterventionSuccess / $nbIntervention) * 100;
      }else{
        $percentageSuccess = 0;
      }
      $prices = (object) array('price_clan' => $prixClan);
      if($clanUser){
        $clan = Clan::find($clanUser->clan_id); 
      }
      $belongsToAlliance = false;
      if($clanUser){
        $belongsToAlliance = true;
      }
      $dateNow = new DateTimeImmutable();
      $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
      $dateNowF = new DateTimeImmutable($this->AddingTime( $dateNow, '0000-00-00 01:00:00'));
      $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');
      $countBase = count(BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->get());
      $noAccessToAlliance = false;
      date_create($user->last_alliance_belong_date);
      if ((date_create($user->last_alliance_belong_date) > date_create($dateNowF) ) && $user->last_alliance_belong_date) {
        $noAccessToAlliance = true;
      }
      $noAccessCreateAlliance = false;
      date_create($user->last_alliance_created_at);
      if ((date_create($user->last_alliance_created_at) > date_create($dateNowF) ) && $user->last_alliance_created_at) {
        $noAccessCreateAlliance = true;
      }
      $data = (object) array('nbEquipement' => $nbEquipement, 'nbAmelioration' => $nbAmelioration, 'prices' => $prices, 'belongsToAlliance' => $belongsToAlliance, 'countBase' => $countBase, 'noAccessToAlliance' => $noAccessToAlliance, 'noAccessCreateAlliance' => $noAccessCreateAlliance, 'clan' => $clan, 'user' => $user, 'nbIntervention' => $nbIntervention, 'nbUnite' => $nbUnite, 'nbPersonnel' => $nbPersonnel, 'percentageSuccess' => $percentageSuccess);
      return response()->json(['status' => 'success', 'data' =>  $data, 'message' => 'Vous avez acheté une unité'], 200 );
    }catch (\Throwable $th) {
      return $th;
    }
  }
  public function PurchaseUnite (Request $request){
   try{
    $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
    $data = $request->json()->all();  
    if ($rest >= 0) {
        $data['user_id'] = Auth::guard('appuser')->user()->id;
        User::find(Auth::guard('appuser')->user()->id)->update(['argent' => $rest]);
        $uniteUser = UniteUser::create($data);
        return response()->json(['status' => 'success', 'data' =>  $uniteUser, 'message' => 'Vous avez acheté une unité'], 200 );
    } else {
        return response()->json(['status' => 'warning', 'error' =>  '500', 'message' => 'Pas vous n\'avez pas assez d\'argent pour effectuer cette achat'], 500 );
    }
   }catch(\Throwable $th) {
    return $th;
   }
  }

  public function getParisTime()
  {
      $now = new DateTime('now', new DateTimeZone('Europe/Paris'));
      return response()->json([
          'timestamp' => $now->getTimestamp() * 1000, // timestamp en ms
          'iso' => $now->format(DateTime::ATOM), // format ISO 8601
      ]);
  }

  public function PurchaseFormation(Request $request)
  {
    try {
      $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
      $data = $request->all();

      if ($rest >= 0) {
        // $personnelUser = Personnel_user::find(intval($data['personnel_id']));
        // $personnelUser->update(['etat_formation_personnel' => "en formation"]);

        $dateNowInit = new DateTimeImmutable();
        // Convertir temps_formation en heures (cas où il est au format "HH:MM:SS")
        $formationTime = explode(":", $data['temps_formation']);
        $hoursToAdd = intval($formationTime[0]); // Récupérer les heures

        // Ajouter dynamiquement le temps de formation
        $dateNowF = $dateNowInit->modify("+{$hoursToAdd} hour");
        $dateNowF = $dateNowF->format('Y-m-d H:i:s');

        // Add the formation time to the new time
        $dateFinal = new DateTimeImmutable($dateNowF);
        $dateFinal = $dateFinal->modify('+' . $data['temps_formation']);

        // Format the final date
        $data['date_fin_formation'] = $dateFinal->format('Y-m-d H:i:s');
        $data['date_debut_formation'] = $dateNowInit->format('Y-m-d H:i:s');
        // dd($dateNowInit->format('Y-m-d H:i:s'));

        // Update user's balance
        $user = User::find(Auth::guard('appuser')->user()->id);
        $user->update(['argent' => $rest]);

        // Check if the personnel is already in a formation
        $personnelFormation = Personnel_formation::where("formation_id", $data['id'])
          ->where('personnel_user_id', intval($data['personnel_id']))
          ->first();

        if (!$personnelFormation) {
          if (isset($data['next'])) {
            Personnel_formation::create([
              'formation_id'         => $data['id'],
              'personnel_user_id'    => intval($data['personnel_id']),
              'date_debut_formation' => $data['date_debut_formation'],
              'date_fin_formation'   => $data['date_fin_formation'],
              'next_formation'       => $data['next']
            ]);
          } else {
            Personnel_formation::create([
              'formation_id'         => $data['id'],
              'personnel_user_id'    => intval($data['personnel_id']),
              'date_debut_formation' => $data['date_debut_formation'],
              'date_fin_formation'   => $data['date_fin_formation'],
            ]);
          }
          return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Votre personnel participe desormais à une formation'], 200);
        } else {
          return response()->json(['status' => 'danger', 'error' => 500, 'message' => "Une erreur s'est produite, veuillez recommencer"], 500);
        }
      } else {
        return response()->json(['status' => 'warning', 'error' => 500, 'message' => "Vous n'avez pas assez d'argent pour effectuer cet achat"], 500);
      }
    } catch (\Throwable $th) {
      return response()->json(['status' => 'error', 'error' => 500, 'message' => $th->getMessage()], 500);
    }
  }

  public function PurchaseFormationx(Request $request)
  {
    try {
      $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
      $data = $request->all();

      if ($rest >= 0) {
        $personnelUser = Personnel_user::find(intval($data['personnel_id']));
        $personnelUser->update(['etat_formation_personnel' => "en formation"]);

        $dateNowInit = new DateTimeImmutable();
        $dateNow = date_format($dateNowInit, 'H:i:s');
        $dateNow2 = date_format($dateNowInit, 'Y-m-d');
        $dateNowF = new DateTimeImmutable($this->AddingTimeFormatio($dateNow, '01:00:00'));
        $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');

        dd([
          "dateNowF" => $dateNowF,
          "dateNow2" => $dateNow2,
          // "dateFinal" => $dateFinal
        ]);
        $dateFinal = new DateTimeImmutable($dateNow2. ' '. $this->AddingTime( $dateNowF, $data['temps_formation']));
        // return response()->json(['status' => 'success', 'data' =>  $dateNowF, 'message' => $data['temps_formation']], 200);

        $data['date_fin_formation'] = date_format($dateFinal, 'Y-m-d H:i:s');
        $user = User::find(Auth::guard('appuser')->user()->id);
        $user->update(['argent' => $rest]);
        return response()->json(['status' => 'success', 'data' =>  $dateNowF, 'message' => $data['temps_formation']], 200);

        $personnelFormation = Personnel_formation::where("formation_id", $data['id'])->where('personnel_user_id', intval($data['personnel_id']))->first();
        if (!$personnelFormation) {
          if (isset($data['next'])) {
            Personnel_formation::create(['formation_id' => $data['id'], 'personnel_user_id' => intval($data['personnel_id']), 'date_fin_formation' =>  $data['date_fin_formation'], 'next_formation' => $data['next']]);
          } else {
            Personnel_formation::create(['formation_id' => $data['id'], 'personnel_user_id' => intval($data['personnel_id']), 'date_fin_formation' =>  $data['date_fin_formation']]);
          }
          return response()->json(['status' => 'success', 'data' =>  $data, 'message' => 'Votre personnel participe desormais à une formation'], 200);
        } else {
          return response()->json(['status' => 'danger', 'error' =>  500, 'message' => "Une erreur s'est produit, veuillez recommencer"], 500);
        }
        return response()->json(['status' => 'danger', 'error' =>  500, 'message' => "Une erreur s'est produit, veuillez recommencer"], 500);
      } else {
        return response()->json(['status' => 'warning', 'error' =>  500, 'message' => "Pas vous n\'avez pas assez d\'argent pour effectuer cette achat"], 500);
      }
    } catch (\Throwable $th) {
      return $th;
    }
  }

  private function AddingTimeFormatio($time1,$time2) {  
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
  private function GetFormation($id, $status){
    $dateNow = new DateTimeImmutable();
    $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
    $dateNowF = new DateTimeImmutable($this->AddingTime( $dateNow, '0000-00-00 01:00:00'));
    $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');
    $formations = Personnel_formation::where('date_fin_formation', '>', $dateNowF)->where('personnel_user_id', $id)->first();
    if($formations){
      if(date_create($formations->date_fin_formation) > date_create($dateNowF)){
        return $formations->date_fin_formation;
      }else{
        if($status == "en formation"){
          $p = Personnel_user::find(intval($id));
          $p->update(["etat_formation_personnel" => "libre", "niveau" => $p->niveau + 1]);
          return $formations->date_fin_formation;
        }
        return $formations->date_fin_formation;
      }
    }else{
      return null;
    }
  }

  public function GetFormationList($id)
  {
    $personnelUser = Personnel_user::find(intval($id));
    $dateNow = new DateTimeImmutable();
    $dateNow = date_format($dateNow, 'Y-m-d H:i:s');

    if ($personnelUser) {
      $formations = Formation::getFormations();  //where('personnel_id', $personnelUser->personnel_id)->
      // dd($formations);
      $data = array();
      $datas = array();

      foreach ($formations as $key => $value) {
        $formationPersonnel = Personnel_formation::getByFormationAndPersonnel($value->id, $id);
        $data['libelle'] = $value->libelle_formation;
        $data['prix'] = $value->prix_formation;
        $data['temps_formation'] = $value->temps_formation;
        $data['image'] = $value->image_formation;
        $data['personnel_id'] = $id;
        $data['description'] = $value->description_formation;;
        $data['niveau'] = $value->niveau;
        $data['id'] = $value->id;
        $data['isFinish'] = false;

        if ($formationPersonnel) {
          $data['id_personnel_f'] =  $formationPersonnel->id;
          $data['date_fin'] = $formationPersonnel->date_fin_formation;
          if (isset($formations[$key + 1])) {
            $data['next'] = $formations[$key + 1]->id;
          }
          $data['isBuy'] = true;

          if (date_create($formationPersonnel->date_fin_formation) < date_create($dateNow)) {
            $data['isFinish'] = true;
          }
        } else {
          $data['isBuy'] = false;
        }

        $data['isLocked'] = false;

        if ($key >= 1) {
          if (isset($datas[$key - 1])) {
            if (!$datas[$key - 1]['isFinish'] || !$datas[$key - 1]['isBuy']) {
              $data['isLocked'] = true;
            }
          }
        }

      // $checkNiveau = $data['niveau'] < $value['niveau'];
      // if($checkNiveau) {
      //   $data['isLocked'] = false;
      //   $data['isFinish'] = true;
      // }

        $datas[$key] = $data;
      }

      return response()->json(['status' => 'success', 'data' =>  $datas], 200);
    } else {
      return response()->json(['status' => $id, 'error' =>  "404", 'message' => "Aucune personnel non trouvé"], 404);
    }
    // $formations = DB::select("	SELECT formations.id AS formations_id, formations.libelle_formation, formations.prix_formation, formations.image_formation, formations.recompense_formation, formations.temps_formation, personnel_formations.id AS personnel_formations_id, personnel_formations.date_fin_formation  FROM formations  LEFT JOIN personnel_formations ON formations.id = personnel_formations.formation_id ");
  }

  public function PurchasePersonnel(Request $request)
  {
      try {
          $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
          $data = $request->all();
  
          if ($rest >= 0) {
              $data['user_id'] = Auth::guard('appuser')->user()->id;
              User::find($data['user_id'])->update(['argent' => $rest]);
  
              $niveau = Personnel::getNiveauById($data['personnel_id']) ?? 0;
  
              $personnelUser = Personnel_user::create([
                  'base_id'                  => $data['base_id'],
                  'nom_personnel'            => $data['nom_personnel'],
                  'prenom_personnel'              => $data['prenom_personnel'],
                  'etat_mouvement_personnel' => "non",
                  'etat_formation_personnel' => 'base',
                  'user_id'                  => $data['user_id'],
                  'personnel_id'             => $data['personnel_id'],
                  'niveau'                   => $niveau
              ]);

              foreach ($data as $key => $value) {
                if (Str::startsWith($key, 'personnel_information')) {
                    DB::table('personnel_user_informations')->insert([
                        'personnel_user_id'       => $personnelUser->id,
                        'personnel_information_id'=> intval($value),
                        'created_at'              => now(),
                        'updated_at'              => now(),
                    ]);
                }
            }

              Personnel_formation::onPurchasePersonnel($personnelUser->id, $niveau);
  
              return response()->json(
                  ['status' => 'success', 'data' =>  $personnelUser, 'message' => 'Vous avez acheté un personnel'],
                  201
              );
          } else {
              return response()->json([
                  'status' => 'warning',
                  'error' => '200',
                  'message' => 'Vous n\'avez pas assez d\'argent pour effectuer cet achat'
              ], 200);
          }
      } catch (\Throwable $th) {
          return response()->json(['status' => 'error', 'message' => $th->getMessage()], 500);
      }
  }
  
  public function PurchaseEquipement (Request $request){
      $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
      $data = $request->all();
      if ($rest >= 0) {
          $data['user_id'] = Auth::guard('appuser')->user()->id;
          User::find(Auth::guard('appuser')->user()->id)->update(['argent' => $rest]);
          $equipementUser = equipementUser::where("user_id", "=", Auth::guard('appuser')->user()->id)->where('equipement_id', '=', $data['equipement_id'])->first();
          if (!$equipementUser) {
              Personnel_user::create(['user_id' => $data['user_id'], 'equipement_id' => $data['equipement_id']]);
          }else{
              $quantite = intval($equipementUser->equipementUser) + 1;
              $equipementUser->update(["quantite_equipement" => $quantite]);
          }
          return response()->json(['status' => 'success', 'data' =>  $equipementUser, 'message' => 'Vous avez acheté un équipement'], 201 );
      } else {
        return response()->json(['status' => 'warning', 'error' =>  '422', 'message' => 'Pas vous n\'avez pas assez d\'argent pour effectuer cette achat'], 422 );
      }
  }
  public function GetMissions()
  {
    try {
      $missionUsers = MissionUser::getMyMissions();
      $data = array();
      $datas = array();

      foreach ($missionUsers as $key => $value) {
        $data['mission']  = Mission::with('typeunite')->find($value['mission_id']);
        $data['base']     = BaseUser::find($value['base_id']);
        $data['hopital']  = Hopital::find($value['hopital_id']);
        $data['units']    = UniteUser::getUnitFromMission($value->unit_ids);
        $data['info']     = $value;
        $datas[$key]      = $data;
      }

      return  response()->json(['status' => 'success', 'data' =>  $datas, 'message' => ''], 200);
    } catch (\Throwable $th) {
      return $th;
    }
  }
  public function GetMissionsPending()
  {
    try {
      $missionUsers = MissionUser::getPendingMissions();
      return  response()->json(['status' => 'warning', 'data' =>  count($missionUsers)>0, 'message' => 'pending missions'], 200);
    } catch (\Throwable $th) {
      return $th;
    }
  }

  public function GetUserGameData()
  {
    try {
      $missionPending = MissionUser::getPendingMissions();
      $bases = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->get();
      $unities = [];
      foreach ($bases as $key => $base) {
        $baseUnit = UniteUser::where('base_id', $base->id)->get();
        if(count($baseUnit) > 0){
          $unities[$key] = $baseUnit;
        }
      }

      return  response()->json([
        'status' => 'warning',
        'data' =>  [
          'bases' => $bases,
          'unities' => $unities, 
          'mission_pending' => count($missionPending) > 0,
          'nbBases' => count($bases),
        ],
        'message' => 'pending missions'
      ], 200);
    } catch (\Throwable $th) {
      return $th;
    }
  }
  
  public function UpdateMissionUser(Request $request){
    // dd($request->all());
    try {
      $data = $request->all();
      \Log::info($data);
      if($data['action'] != 4){
        $missionUser = MissionUser::find($data['mission_id']);
        if($missionUser){
          switch ($data['action']) {
            case 0:
                $missionUser->update(['etat' => 'PENDING', 'is_completed' => 0]);
                foreach ($data['unites'] as $value) {
                  $uniteUser = UniteUser::find($value);
                  if($uniteUser){
                    $sante =  intVal($uniteUser->taux_usure) - $uniteUser->sante;
                    $uniteUser->update(['etat_unite' => 'en mission']);
                  }
                }
                foreach ($data['personnel'] as $value) {
                  $personnelUser = Personnel_user::find($value);
                  if($personnelUser){
                    $sante =  intVal($personnelUser->taux_usure) - $personnelUser->sante;
                    $personnelUser->update(['etat_unite' => 'en mission']);
                  }
                }
                $data = (object) array('status' => 'PENDING');
                return  response()->json(['status' => 'warning', 'data' => $data, 'message' => 'Mission en attente'], 200 );
                break;
            case 1:
              $missionUser->update(['etat' => 'COMPLETED', 'is_completed' => 1]);
              foreach ($data['unites'] as $value) {
                $uniteUser = UniteUser::find($value);
                if($uniteUser){
                  $sante =  intVal($uniteUser->taux_usure) - $uniteUser->sante;
                  $uniteUser->update(['etat_unite' => 'base', 'sante' => $sante]);
                }
              }
              foreach ($data['personnel'] as $value) {
                $personnelUser = Personnel_user::find($value);
                if($personnelUser){
                  $sante =  intVal($personnelUser->taux_usure) - $personnelUser->sante;
                  $personnelUser->update(['etat_unite' => 'base', 'total_used' => (intVal($personnelUser->total_used) + 1)]);
                }
              }
              User::find(Auth::guard('appuser')->user()->id)->update(['argent' => (intVal( User::find(Auth::guard('appuser')->user()->id) + 1000)), 'experience' => (intVal( User::find(Auth::guard('appuser')->user()->experience) + 1000))]);
              $data = (object) array('status' => 'COMPLETED');
              return  response()->json(['status' => 'warning', 'data' => $data, 'message' => 'Mission terminée'], 200 );
              break;
            case 2:
              $missionUser->update(['etat' => 'IN PROGRESS', 'is_completed' => 2]);
              if(isset($data['poxX']) && isset($data['poxY'])){
                  $missionUser->update(['position_x' => $data['poxX'], 'position_y' => $data['poxY']]);
              }
              $data = (object) array('status' => 'IN PROGRESS');
              return  response()->json(['status' => 'warning', 'data' => $data, 'message' => 'Mission lancée'], 200 );
              break;
            case 3:
              $missionUser->update(['etat' => 'FAILED', 'is_completed' => 3]);
              foreach ($data['unites'] as $value) {
                $uniteUser = UniteUser::find($value);
                if($uniteUser){
                  $sante =  intVal($uniteUser->taux_usure) - $uniteUser->sante;
                  $uniteUser->update(['etat_unite' => 'base']);
                }
              }
              foreach ($data['personnel'] as $value) {
                $personnelUser = Personnel_user::find($value);
                if($personnelUser){
                  $sante =  intVal($personnelUser->taux_usure) - $personnelUser->sante;
                  $personnelUser->update(['etat_unite' => 'base']);
                }
              }
              User::find(Auth::guard('appuser')->user()->id)->update(['argent' => (intVal( User::find(Auth::guard('appuser')->user()->id) - 100)), 'experience' => (intVal( User::find(Auth::guard('appuser')->user()->experience) - 100))]);
              $data = (object) array('status' => 'FAILED');
              return  response()->json(['status' => 'warning', 'data' => $data, 'message' => 'Echec de la mission'], 200 );
            break;
          }      
        }
        return  response()->json(['status' => 'warning', 'data' =>  "", 'message' => 'mission updated'], 403 );
      }else{
        $data['user_id'] =  Auth::guard('appuser')->user()->id;

        $userMissionExi= MissionUser::where('user_id', $data['user_id'])->whereIn('etat', ['IN PROGRESS', 'PENDING'])->exists();

        if($userMissionExi){
          return  response()->json(['status' => 'warning', 'data' =>  "", 'message' => 'vous avez deja une mission en cours'], 403 );
        }

        $data['is_completed'] = 0;
        $data['unit_ids'] = implode(",", $data['unites']);
        $mission = MissionUser::create($data);
        $missionCreated = MissionUser::with('mission')->find($mission->mission_id);
        return  response()->json(['status' => 'success', 'data' =>  $missionCreated, 'message' => 'mission updated'], 200 );
      }
    } catch (\Throwable $th) {
      return $th;
    }
  }
  public function UpgradePersonnel (Request $request, $id){
    try {
          $personnelUser = Personnel_user::find($id);
          if($personnelUser){
            $personnelUser->update(['niveau' => (intval($personnelUser->niveau, 10) + 1) , "etat_formation_personnel" => "libre" ]);
            return response()->json(['status' => 'success', 'data' =>  $personnelUser, 'message' => 'Formation terminée'], 200 );
          }else{
            return response()->json(['status' => 'warning', 'error' => 404, 'message' => 'Personnel non trouvé'], 404 );
          }  
    } catch (\Throwable $th) {
      return response()->json(['status' => 'danger', 'error' =>  $th, 'message' => 'Vous avez acheté un personnel'], 500 );
    }
  }
  public function GetAllianceList (Request $request){
    $page = intval($request->query('page'));
    $limit = 10;
    $clans = DB::select(' SELECT COUNT(cu.id) AS user_count, c.id, c.nom_clan, c.niveau, c.max, c.banner
                          FROM clans c
                          LEFT JOIN clan_users cu ON cu.clan_id = c.id
                          WHERE c.deleted_at IS NULL
                          GROUP BY c.id, c.nom_clan, c.niveau, c.max, c.banner
                          LIMIT '. $limit.' OFFSET '. (($page - 1) * $limit) .' ;');
    return response()->json(['status' => 'success', 'data' =>  $clans, 'message' => 'alliance list is finish loading'], 200 ); 
  }

  public function GetItemList()
  {
    $unites = UniteUser::query()->select('type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite',  'unite_users.*', 'unites.image')->join('unites', 'unites.id', '=', 'unite_users.unite_id')
    ->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')->where('unite_users.user_id', Auth::guard('appuser')->user()->id)
      ->get();
    // 'personnels.titre_personnel',  
    $personnels = Personnel_user::getPersonnels();
    // dd($personnels);
    $dataPersonnel = array();
    $datas = array();
    foreach ($personnels as $key => $value) {
      $dataPersonnel['dateFin'] = $this->GetFormation($value->id, $value->etat_formation_personnel);
      $dataPersonnel['personnel'] = $value;
      $datas[$key] = $dataPersonnel;
    }
    $equipement  = equipementUser::select('equipements.nom_equipement',  'equipement_users.*')->join('equipements', 'equipements.id', '=', 'equipement_users.equipement_id')->where('equipement_users.user_id', Auth::guard('appuser')->user()->id)
      ->get();
    $data = (object) array('unites' => $unites, 'personnels' => $datas, 'equipements' => $equipement);
    return response()->json(['status' => 'success', 'data' =>  $data, 'message' => 'item list is finish loading'], 200);
  }
  
  public function GetClanListByName(Request $request){
    $page = intval($request->query('page'));
    $limit = 10;
    $search = $request->name;
    $clans = DB::select(' SELECT COUNT(clan_users.id) as user_count, clans.id as id, clans.nom_clan, clans.niveau, clans.max, clans.banner   
                          FROM  clans 
                          LEFT JOIN clan_users ON clan_users.clan_id = clans.id 
                          WHERE deleted_at IS NULL AND nom_clan 
                          LIKE  "%' . $search . '%" GROUP BY clans.id, clans.nom_clan, clans.niveau, clans.max, clans.banner
                          LIMIT '. $limit.' OFFSET '. (($page - 1) * $limit) .' ;');
    return response()->json(['status' => 'success', 'data' =>  $clans, 'message' => 'alliance list is finish loading'], 200 );   
  }
  public function CheckLastLogin(){
    $user = User::find(Auth::guard('appuser')->user()->id);
    $dateNow = new DateTimeImmutable();
    $dateNow = date_format($dateNow, 'Y-m-d');

    if (date_create($user->last_login) < date_create($dateNow )    || !$user->last_login ) {
      return response()->json(['status' => 'success','message' => "it's a new day", 'data' => true], 200 );
    }else{
      return response()->json(['status' => 'success','message' => 'Is not a new day', 'data' => false], 200 );
    }
  }
  public function EnterIntoAlliance(Request $request){
    $data = $request->all();
    $clanUser = ClanUser::create(['clan_id' => $data['clan_id'], 'user_id' => Auth::guard('appuser')->user()->id]);
    if($clanUser){
      return response()->json(['status' => 'success', 'data' =>  true, 'message' => "Vous faites desormais partie d'un alliance"], 200 );  
    }else{
      return response()->json(['status' => 'danger', 'error' =>  '500',  'message' => 'Réessayer plus tard'], 500 );  
    }
  }
  public function AcceptDailyGain(){
    $dateNow = new DateTimeImmutable();
    $dateNow = date_format($dateNow, 'Y-m-d');
    $user = User::find(Auth::guard('appuser')->user()->id)->update(['argent' => Auth::guard('appuser')->user()->argent + 500, 'last_login' => $dateNow]);
    if ($user) {
      return response()->json(['status' => 'success','message' => "daily gain accept", 'data' => true], 200 );
    }else{
      return response()->json(['status' => 'warning', 'error' => 500, 'message' => "Une erreur c'est produite"], 500 );
    }
  }
  public function LeaveAlliance(Request $request){
    $data = $request->all();
    $clanUser = ClanUser::where('clan_id', $data['clan_id'])->where('user_id', Auth::guard('appuser')->user()->id)->first();
    if($clanUser){
      $clanDestroy = ClanUser::destroy($clanUser->id);
      $dateNow = new DateTimeImmutable();
      $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
      $dateNowF = new DateTimeImmutable($this->AddingTime( $dateNow, '0000-00-00 01:00:00'));
      $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');
      $user = User::find(Auth::guard('appuser')->user()->id);
      if($user->last_alliance_id != $data['clan_id']){
        $dateFinal = new DateTimeImmutable($this->AddingTime( $dateNowF, '0000-00-00 12:00:00'));
      }else{
        $dateFinal = new DateTimeImmutable($this->AddingTime( $dateNowF, '0000-00-01 00:00:00'));
      }
      $user->update(['last_alliance_belong_date' => $dateFinal, 'last_alliance_id' => $data['clan_id']]);
      if($clanDestroy){
        return response()->json(['status' => 'success', 'data' =>  true, 'message' => $dateFinal], 200 );  
      }else{
        return response()->json(['status' => 'warning', 'data' =>  false, 'message' => "Impossible de quitter l'alliance"], 200 );  
      }
    }else{
      return response()->json(['status' => 'danger', 'error' =>  '500',  'message' => 'Réessayer plus tard'], 500 );  
    }
  }
  public function DestroyBase($id){
    $base = BaseUser::find($id);
    if($base->user_id ===  Auth::guard('appuser')->user()->id){
      if($base){
        // delete base
        BaseUser::destroy($id);

        // delete all unit
        $related_unite = UniteUser::where('base_id', $id)->get();
        foreach ($related_unite as $value) {
          $unite = UniteUser::find($value->id);
          $unite->update(['base_id', 0]);
        }
        // UniteUser::where('base_id', $id)->update(['base_id', 0]);

        // delete all personnel
        $related_personnel = Personnel_user::where('base_id', $id)->get();
        foreach ($related_personnel as $value) {
          $personnel = Personnel_user::find($value->id);
          $personnel->update(['base_id', 0]);
        }
        return response()->json(['status' => 'success', 'data' =>  true, 'message' => "Votre base à été detruit"], 200 ); 
      }else{
        return response()->json(['status' => 'danger', 'warning' =>  '404',  'message' => 'Base non trouvé'], 404 );  
      }
    }else{
      return response()->json(['status' => 'danger', 'warning' =>  '403',  'message' => "Vous n'avez pas l'autorisation necessaire"], 403 );  
    }
  }
  public function DestroyAlliance($id){
    $clan = Clan::where('chef_id', Auth::guard('appuser')->user()->id)->first();
    // if($clan->chef_id ===  Auth::guard('appuser')->user()->id){
      if($clan){
        Clan::destroy($clan->id);
        $clanUser = ClanUser::where('clan_id', $clan->id)->get();
        foreach ($clanUser as $value) {
          ClanUser::destroy($value->id);
        }
        $dateNow = new DateTimeImmutable();
        $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
        $dateNowF = new DateTimeImmutable($this->AddingTime( $dateNow, '0000-00-00 01:00:00'));
        $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');
        $dateFinal = new DateTimeImmutable($this->AddingTime( $dateNowF, '0000-00-02 00:00:00'));
        User::find(Auth::guard('appuser')->user()->id)->update(['last_alliance_created_at' => $dateFinal]);
        return response()->json(['status' => 'success', 'data' =>  true, 'message' => "Votre alliance à été detruit"], 200 ); 
      }else{
        return response()->json(['status' => 'danger', 'warning' =>  '404',  'message' => 'Alliance non trouvé'], 404 );  
      }
    // }else{
    //   return response()->json(['status' => 'danger', 'warning' =>  '403',  'message' => "Vous n'avez pas l'autorisation necessaire"], 403 );  
    // }
  }
  public function GetClan ($id) {
    $clan = Clan::find($id);
    if($clan){
      $clanUsers = DB::select('SELECT users.pseudo, users.id, users.experience, users.online FROM clan_users  INNER JOIN users ON clan_users.user_id = users.id WHERE clan_users.clan_id = ' . $clan->id);
      $checkBelongClan = false;
      $clanCheck = ClanUser::where('user_id', Auth::guard('appuser')->user()->id)->where('clan_id', $clan->id)->first();
      if($clanCheck){
        $checkBelongClan = true;
      }
      $checkIsMyClan  = false;
      if($clan->chef_id === Auth::guard('appuser')->user()->id){
        $checkIsMyClan = true;
      }
      $clanUser = ClanUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
      $userIntoAnotherClan  = false;
      if($clanUser){
        $userIntoAnotherClan = true;
      }
      $dateNow = new DateTimeImmutable();
      $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
      $dateNowF = new DateTimeImmutable($this->AddingTime( $dateNow, '0000-00-00 01:00:00'));
      $dateNowF = date_format($dateNowF, 'Y-m-d H:i:s');
      $noAccessToAlliance = false;
      date_create(Auth::guard('appuser')->user()->last_alliance_belong_date);
      if(Auth::guard('appuser')->user()->last_alliance_belong_date){
        if (date_create(Auth::guard('appuser')->user()->last_alliance_belong_date) > date_create($dateNowF) ) {
          $noAccessToAlliance = true;
        }
      }

      $data = (object) array('info_clan' => $clan, 'last_alliance_belong_date' => Auth::guard('appuser')->user()->last_alliance_belong_date, 'members' =>  $clanUsers, 'noAccessToAlliance' => $noAccessToAlliance, 'checkBelongClan' =>  $checkBelongClan, 'checkIsMyClan' => $checkIsMyClan, 'userIntoAnotherClan' => $userIntoAnotherClan);
      return response()->json(['status' => 'success', 'data' =>  $data, 'message' => 'alliance list is finish loading'], 200 );   
    }else{
      return response()->json(['status' => 'warning', 'error' =>  '400', 'message' => 'Aucune alliance trouvée'], 400 );
    }
  }
  public function GetUnite ($id) {
    $uniteUser = UniteUser::find($id);
    if($uniteUser){
      $unite = Unite::find($uniteUser->unite_id);
      $typeUnite = TypeUnite::find($unite->type_unite_id);
      $data = (object) array('uniteUser' => $uniteUser, 'unite' => $unite, 'typeUnite' => $typeUnite);
      return response()->json(['status' => 'success', 'data' =>  $data, 'message' => 'unite detail is finish loading'], 200 );   
    }else{
      return response()->json(['status' => 'warning', 'error' =>  '400', 'message' => 'Aucune unité trouvée'], 400 );
    }
  }
  public function CreateAlliance(Request $request){
    $clanUser = ClanUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
    if($clanUser){
      return response()->json(['status' => 'danger', 'error' =>  '500', 'message' => 'Vous possédez déjà une alliance'], 500 );  
    }else{
      $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
      $data = $request->all();
      if ($rest >= 0) {
          $data['user_id'] = Auth::guard('appuser')->user()->id;
          User::find(Auth::guard('appuser')->user()->id)->update(['argent' => $rest]);
          $data['chef_id'] = Auth::guard('appuser')->user()->id;
          $clan = Clan::create($data);
          if($clan){
            ClanUser::create(['clan_id' => $clan->id, 'user_id' => Auth::guard('appuser')->user()->id]);
            return response()->json(['status' => 'success', 'data' =>  $data, 'message' => 'Felicitation vous venez de créer votre clan'], 200 );  
          }else{
            return response()->json(['status' => 'danger', 'error' =>  '500','message' => 'Internal Error'], 500 );
          }
      }else{
         return response()->json(['status' => 'warning', 'error' =>  '500', 'message' => 'Pas vous n\'avez pas assez d\'argent pour effectuer cette achat'], 500 );  
      }
    }
  }
  public function UpgradeAlliance ($id) { 
    try{
      $clanuser = Clan::find($id);
      if($clanuser->niveau == 5) {
        return response()->json(['status' => 'success', 'data' =>  $clanuser,'message' => "Vous ne pouvez plus monter de niveau"], 200 );
      } else {
          $max = 12;
          if(intval($clanuser->niveau) == 1){
            $max = 12;
          }else if(intval($clanuser->niveau) == 2){
            $max = 12;
          }else if(intval($clanuser->niveau) == 3){
            $max = 15;
          }else if(intval($clanuser->niveau) == 4){
            $max = 17;
          }else{
            $max = 30;
          }
          $clanUpdate = $clanuser->update(['niveau' => intval($clanuser->niveau) + 1, 'max' => $max]);
          if($clanUpdate){
              return response()->json(['status' => 'success', 'data' =>  $clanuser,'message' => "Votre alliance est desormais de niveau " . intval($clanuser->niveau) + 1 ], 200 );
          }
      }
        return response()->json(['status' => 'warning', 'error' =>  '201','message' => "Les modifications n'ont pas été prise en compte!"], 201 );
    }catch(\Throwable $th){
      return $th;
    }
  }
  public function EditAlliance(Request $request, $id){
    try{
      $data = $request->all();
      $clanuser = Clan::find($id);
      $clanUpdate = $clanuser->update(['nom_clan' => $data['nom_clan'], 'description_clan' => $data['description_clan']]);
      if($clanUpdate){
          return response()->json(['status' => 'success', 'data' =>  $data,'message' => "Alliance modifiée"], 200 );
      }else{
        return response()->json(['status' => 'warning', 'error' =>  '201','message' => "Les modifications n'ont pas été prise en compte!"], 201 );
      }
    }catch(\Throwable $th){
      return $th;
    }
  }
  public function CreateUserBase(Request $request){
    // return response()->json(['e' => $request->all()]);
    try
    {
      $data = $request->all();

      // Vérifier si les coordonnées se situent en France
      $latitude = $data['position_x'];
      $longitude = $data['position_y'];
      $isInFrance = $this->isCoordinatesInFrance($latitude, $longitude);

      if (!$isInFrance) {
        return response()->json(['status' => 'error', 'message' => 'Les coordonnées doivent être en France.'], 400);
      }

      if ($request->hasFile('image')) {
          $image = $request->image;
          $imageName = time() . '.' . $image->extension();
          $image->move(public_path('images'), $imageName);
          $pathImage = 'images/' . $imageName;
          $data['icon_base'] = $pathImage;
      } else {
        $data['icon_base'] = 'assets/icons/icons8-marker-48.png';
      }

      if (!isset($data['prix'])) {
        $data['prix'] = 150000; 
      }

      $rest = intval(Auth::guard('appuser')->user()->argent - $data['prix']);
      $baseUser = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
      $data['user_id'] = Auth::guard('appuser')->user()->id;
      $base = BaseUser::create($data);
      if($baseUser){
        if ($rest >= 0) {
          User::find(Auth::guard('appuser')->user()->id)->update(['argent'=> $rest]);
          return response()->json(['status' => 'success', 'data' =>  $base, 'message' => "Base créee"], 200 ); 
          } else {
            return response()->json(['status' => 'warning', 'error' =>  '500', 'message' => 'Pas vous n\'avez pas assez d\'argent pour effectuer cette achat'], 500 ); 
          }
      }else{
          User::find(Auth::guard('appuser')->user()->id)->update(['ville' => $data['ville_id'], 'lat' => $data['position_y'], 'lgt' => $data['position_x']]);
          return response()->json(['status' => 'success', 'data' =>  $base, 'message' => "Base créee"], 200 );  
      }
    } catch (\Throwable $th) {
      return $th;
    }
  }
  
  /**
   * Determine if the given coordinates are within the boundaries of France.
   *
   * This function checks whether the provided latitude and longitude fall within
   * the geographical boundaries of mainland France or the island of Corsica.
   *
   * @param float $latitude  The latitude of the point to check.
   * @param float $longitude The longitude of the point to check.
   * @return bool Returns true if the coordinates are within France; otherwise, false.
   */
  private function isCoordinatesInFrance($latitude, $longitude) {
    // France Métropolitaine
    $franceLatMin = 41.36;
    $franceLatMax = 51.09;
    $franceLonMin = -5.14;
    $franceLonMax = 9.56;

    // Corse
    $corseLatMin = 41.33;
    $corseLatMax = 43.00;
    $corseLonMin = 8.55;
    $corseLonMax = 9.56;

    // Vérifier si les coordonnées sont en France Métropolitaine
    if (
        ($latitude >= $franceLatMin && $latitude <= $franceLatMax) &&
        ($longitude >= $franceLonMin && $longitude <= $franceLonMax)
    ) {
        return true;
    }

    // Vérifier si les coordonnées sont en Corse
    if (
        ($latitude >= $corseLatMin && $latitude <= $corseLatMax) &&
        ($longitude >= $corseLonMin && $longitude <= $corseLonMax)
    ) {
        return true;
    }

    return false;
  }
  
  private function AddingTime($time1,$time2) {
        $x = new DateTime($time1);
        $y = new DateTime($time2);

        $interval1 = $x->diff(new DateTime('0000-00-00 00:00:00')) ;
        $interval2 = $y->diff(new DateTime('0000-00-00 00:00:00')) ;

        $e = new DateTime('0000-00-00 00:00:00');
        $f = clone $e;
        $e->add($interval1);
        $e->add($interval2);
        $total = $f->diff($e)->format("%Y-%M-%D %H:%I:%S");;
        return $total;
  }
  public function DestroyPersonnel($id){
    $personnel = Personnel_user::find($id);
    if($personnel){
      Personnel_user::destroy($id);
      return response()->json(['status' => 'success', 'data' =>  true, 'message' => "Votre personnel à été retiré"], 200 ); 
    }else{
      return response()->json(['status' => 'danger', 'warning' =>  '404',  'message' => 'personnel non trouvé'], 404 );  
    }
  }
  public function LoadPublicChatMessage(){
    $messages = ChatMessage::query('user.pseudo', 'chat_messages.id', 'chat_messages.text')
      ->join("users", 'users.id', '=', 'chat_messages.user_id')
      ->orderBy('chat_messages.id', 'asc')
      ->get();
    return $messages;
  }
  public function LoadPrivateChatMessage($id){
    $messages = PrivateChatMessage::query('user.pseudo', 'private_chat_messages.id', 'private_chat_messages.text')
      ->join("users", 'users.id', '=', 'private_chat_messages.user_id')
      ->where('private_chat_messages.clan_id', $id)
      ->orderBy('private_chat_messages.id', 'asc')
      ->get();
    return $messages;
  }
  public function SendMessageToPublicChat(Request $request){
    try{
      $data = $request->all();
      $data['user_id'] = Auth::guard('appuser')->user()->id;
      $user = User::find($data['user_id']);
      $message = ChatMessage::create($data);
      broadcast(new PublicChat($message, $user->pseudo));
      return $message;
    } catch (\Throwable $th) {
      return $th;
    }
  }
  public function SendMessageToPrivateChat(Request $request){
    try{
      $data = $request->all();
      $data['user_id'] = Auth::guard('appuser')->user()->id;
      $message = PrivateChatMessage::create($data);
      $user = User::find($data['user_id']);
      // $clanUser = ClanUser::where('user_id', $data['user_id'])->first()->user_id;
      // return $clanUser;
      broadcast(new MessageSent($message, $user));
      return $message;
    } catch (\Throwable $th) {
      return $th;
    }
  }

}
  //   $request->validate([
  //     'unite_id' => 'required|integer',
  //     'vitesse' => 'required|integer',
  //     'nom' => 'required|string',
  //     'taux_usure' => 'required|integer',
  //     'prix' => 'required|integer',
  // ]);
