<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\ClanUser;
use App\Models\DemandeUnite;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\Formation;
use App\Models\ParametreJeu;
use App\Models\Personnel;
use App\Models\Personnel_formation;
use App\Models\Personnel_user;
use App\Models\TypeUnite;
use App\Models\Unite;
use App\Models\UniteUser;
use App\Models\User;
use DateTime;
use DateTimeImmutable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    //
    public function index()
    {
        $dateNow = new DateTimeImmutable();
        $dateTime = date_format($dateNow, 'Y-m-d H:i:s');
        $dateNow2 = date_format($dateNow, 'Y-m-d');
        $eventsUser = DB::select("SELECT events.*, event_users.etat AS etat FROM events, users, event_users WHERE users.id = event_users.user_id AND event_users.event_id = events.id AND  users.id = " . Auth::guard('appuser')->user()->id . " AND published = 1 AND events.date_fin > '" . $dateNow2 . "' ;");
        $events = Event::query()->where('date_fin', '>=', $dateTime)
            ->where('published', '1')
            ->get();
        $unites = UniteUser::query()->select('unites.*', 'type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite')->join('unites', 'unites.id', '=', 'unite_users.unite_id')->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')
            ->get();
        return view('dashboard.index', compact('events', 'dateTime', 'eventsUser', 'unites'));
    }
    public function marketUniteView()
    {
        $typeUnites = TypeUnite::all();
        $unites = Unite::query()->select('unites.*', 'type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite')->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')->get();
        return view('dashboard.boutiques.unites', compact('unites', 'typeUnites'));
    }
    public function marketPersonnelView()
    {
        $personnels = Personnel::where("published" , 1)->get();
        // $typeUnites = TypeUnite::all();
        // $unites = Unite::query()->select('unites.*', 'type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite')->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')->get();
        return view('dashboard.boutiques.personnels', compact('personnels'));
    }

    public function addUniteToBase(Request $request){
        return $request->id;
        $uniteUser = UniteUser::find($request->id);
        return"good";
        if($uniteUser){
            $uniteUser->update(['base_id' =>  $request->base_id]);
            return response()->json(['response' => true, "message" => "Envoi d'unité!"], 200);
        }
        return  response()->json(['response' => false, "message" => "Cette unité n'existe pas!"], 404);
    }
    public function marketView()
    {
        $typeUnites = TypeUnite::all();
        $unites = Unite::query()->select('unites.*', 'type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite')->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')->get();
        $personnels = Personnel::where("published" , 1)->get();
        return view('dashboard.boutique', compact('typeUnites', 'unites', 'personnels'));
    }
    public function elementView()
    {
        $unites = UniteUser::query()->select('type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite',  'unite_users.*', 'unites.image')->join('unites', 'unites.id', '=', 'unite_users.unite_id')
            ->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')->where('unite_users.user_id', Auth::guard('appuser')->user()->id)
            ->get();
        $personnels  = Personnel_user::query()->select('personnels.titre_personnel',  'personnels.image',  'personnel_users.*')->join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')->where('personnel_users.user_id', Auth::guard('appuser')->user()->id)
            ->get();
        return view('dashboard.element', compact('unites', 'personnels'));
    }


    public function updateUniteUser(Request $request)
    {
        $data = $request->all();
        // return response()->json(['message' =>  $data] );
        UniteUser::find(intval($data['id']))->update(['nom' => $data['nom']]);
        return redirect('/dashboard/element/'. $request->id);
    }

    public function elementItemView($id)
    {
        $unite = UniteUser::query()->select('type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite',  'unite_users.*', 'unites.image', 'unites.nom_unite', 'unites.capacite_unite')->join('unites', 'unites.id', '=', 'unite_users.unite_id')
            ->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')
            ->where('unite_users.id', $id)
            ->first();
        return view('dashboard.unite', compact('unite'));
    }

    public function addClan(Request $request){
        $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
        $data = $request->all();
        // return response()->json(['message' =>  $data] );
        if ($rest >= 0) {
            $data['user_id'] = Auth::guard('appuser')->user()->id;
            User::find(Auth::guard('appuser')->user()->id)->update(['argent' => $rest]);
        
            $data['chef_id'] = Auth::guard('appuser')->user()->id;
            $clan = Clan::create($data);

          
            ClanUser::create(['clan_id' => $clan->id, 'user_id' => Auth::guard('appuser')->user()->id]);
            return redirect('/dashboard/alliances')
                   ->with(['status' => 'Felicitation vous venez de créer votre clan ', 'color' => 'green']);
        }else{
            return redirect('/dashboard/alliances')
                   ->with(['status' => 'Pas vous n\'avez pas assez de pieces pour effectuer cette achat', 'color' => 'yellow']);
        }
    }

    public function updateClan(Request $request){
       
        $data = $request->all();
        
        $clanuser = Clan::find($data['id']);
       
        $clanUpdate = $clanuser->update(['banner' => $data['banner'], 'nom_clan' => $data['nom_clan'], 'description_clan' => $data['description_clan']]);
        if($clanUpdate){
            return redirect('/dashboard/alliance/' . $data['id'])
            ->with(['status' => 'Clan modifié', 'color' => 'green']);
        }
        return redirect('/dashboard/alliance/' . $data['id'])
               ->with(['status' => "Les modifications n'ont pas été prise en compte!", 'color' => 'yellow']);
    }
    public function searchClan(Request $request){
        $search = $request->input('clan_search');
        $settingsGame = ParametreJeu::find(1);
        $clan = Clan::query()->where('chef_id', Auth::guard('appuser')->user()->id)->first();
        $clans = DB::select('SELECT COUNT(clan_users.id) as count_user, clans.id as id, clans.nom_clan, clans.niveau, clans.max, clans.banner   FROM  clans LEFT JOIN clan_users ON clan_users.clan_id = clans.id WHERE deleted_at IS NULL AND nom_clan LIKE  "%' . $search . '%" GROUP BY clans.id, clans.nom_clan, clans.niveau, clans.max, clans.banner ;');
        $prix = $settingsGame->prix_clan;
        return view('dashboard.clans', compact('clans', 'prix', 'clan', 'search'));
      
    }
    public function upgradeClan(Request $request){
        $data = $request->all(); 
        $clanuser = Clan::find($data['id']);
        if($clanuser->niveau == 5) {
            return redirect('/dashboard/alliance/' . $data['id'])
            ->with(['status' => "Les modifications n'ont pas été prise en compte!", 'color' => 'yellow']);
        } else {
            $clanUpdate = $clanuser->update(['niveau' => intval($clanuser->niveau) + 1, 'max' => 30, 'experience' => intval($data['experience']) + 1000]);
            if($clanUpdate){
                return redirect('/dashboard/alliance/' . $data['id'])
                ->with(['status' => 'Votre alliance est desormais de niveau ' . intval($clanuser->niveau) + 1 , 'color' => 'green']);
            }
        }
        return redirect('/dashboard/alliance/' . $data['id'])
               ->with(['status' => "Les modifications n'ont pas été prise en compte!", 'color' => 'yellow']);
    } 

    public function rejectDemande($id) {
        DemandeUnite::find($id)->update(['status' => "rejected"]);
        return response()->json(['message' =>  "Demande est rejetée"] );
    }

    public function deleteDemande($id) {
        $demande = DemandeUnite::find($id);
        if($demande){
            DemandeUnite::destroy($id);
            return redirect('/dashboard/profil/echange-unite')
            ->with(['status' =>  "Demande supprimer" , 'color' => 'stone']);
        }else{
            return redirect('/dashboard/profil/echange-unite')
            ->with(['status' =>  "Erreur dans l'initiation de la demande." , 'color' => 'red']);
        }
    }

    public function initUniteExchange(Request $request) {
        $data = $request->all();
       
        $demande = DemandeUnite::create([
            'sender_id' => Auth::guard('appuser')->user()->id,
            'user_id' => $data['user_id'], 
            'unite_user_id' => $data['unite_user_id'],
            'sender_uniter_id' => $data['sender_uniter_id'],
            'sender_argent' => 0, 'status' => "pending"]);
        // return response()->json(['message' => $data] );
        if($demande){
            // $unite->update(['user_id' => $data['new_user_id']]);
            return redirect('/dashboard/profil/echange-unite')
            ->with(['status' =>  "Demande envoyé" , 'color' => 'green']);
            // return response()->json
        }
        return redirect('/dashboard/echange/' . $data['user_id'])
        ->with(['status' =>  "Erreur dans l'initiation de la demande." , 'color' => 'yellow']);
        // return response()->json(['message' =>  "Echec d'initiation de la demande", 'color' => 'yellow'] );
    }

    public function viewDemandeUnite() {
        $demandeUniteSender = DB::table('demande_unites')
                              ->join('users', 'demande_unites.user_id', '=', 'users.id')
                              ->join('unite_users', 'demande_unites.unite_user_id', '=', 'unite_users.id')
                              ->where('demande_unites.sender_id', Auth::guard('appuser')->user()->id)
                              ->simplePaginate(2);
        // query()->->where('sender_id', Auth::guard('appuser')->user()->id)->get();
        $demandeUnite =  DB::table('demande_unites')
                            ->join('users', 'demande_unites.user_id', '=', 'users.id')
                            ->join('unite_users', 'demande_unites.unite_user_id', '=', 'unite_users.id')
                            ->where('demande_unites.user_id', Auth::guard('appuser')->user()->id)
                            ->simplePaginate(2); 
        // DemandeUnite::query()->where('user_id', Auth::guard('appuser')->user()->id)->get();
        return view('dashboard.profile.echange', compact('demandeUniteSender', 'demandeUnite'));
    }

    public function viewProfile() {
        $user = User::find(Auth::guard('appuser')->user()->id);
        return view('dashboard.profile.index', compact('user'));
    }
    

    public function acceptUniteExchange($id){
        $demande = DemandeUnite::find($id);
        if($demande){
            $demande->update(['status' => "accept"]);
            $userUnite = UniteUser::find($demande->unite_user_id);
            if($userUnite){
                $userUnite->update(['user_id' => $demande->sender_id]);
                $SenderuserUnite = UniteUser::find($demande->sender_uniter_id);
                if($SenderuserUnite){
                    $SenderuserUnite->update(['user_id' => $demande->user_id]);
                    return response()->json(['message' =>  "Completed"] );
                }
            }
            return response()->json(['message' =>  "Failed"] );
        }else{
            return response()->json(['message' =>  "Failed"] );
        }
    }

    public function destroyAlliance($id){
        Clan::destroy($id);
        return redirect('/dashboard/alliances/');
        // return view('dashboard.clans', compact('clans', 'prix'));
    }

    public function allianceView($id)
    {
        // $settingsGame = ParametreJeu::find(1);
        // $clans = Clan::all();
        // $prix = $settingsGame->prix_clan;
        $clanUser = Clan::find($id);
        if($clanUser){
            $prix =  100000;
              $clanUsers = DB::select('SELECT users.pseudo, users.id, users.experience, users.online FROM clan_users  INNER JOIN users ON clan_users.user_id = users.id WHERE clan_users.clan_id = ' . $clanUser->id);
              //   return response()->json(['response' => $clanUser->id], 200);
              return view('dashboard.clan', compact('clanUser', 'clanUsers', 'prix'));
        }
    }

    public function alliancesView(){
        $settingsGame = ParametreJeu::find(1);
        $clan = Clan::query()->where('chef_id', Auth::guard('appuser')->user()->id)->first();
        $clans = DB::select('SELECT COUNT(clan_users.id) as count_user, clans.id as id, clans.nom_clan, clans.niveau, clans.max, clans.banner   FROM  clans LEFT JOIN clan_users ON clan_users.clan_id = clans.id WHERE deleted_at IS NULL GROUP BY clans.id,  clans.nom_clan, clans.niveau, clans.max, clans.banner ;');
        $prix = $settingsGame->prix_clan;
        $search = null;
        return view('dashboard.clans', compact('clans', 'prix', 'clan', 'search'));
    }

    public function exchangeUniteView($id){
        // $settingsGame = ParametreJeu::find(1);
        $unites = UniteUser::query()->select('type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite',  'unite_users.*', 'unites.image')->join('unites', 'unites.id', '=', 'unite_users.unite_id')
        ->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')
        ->where('unite_users.user_id', '=', $id )
        ->get();
        $myUnites = UniteUser::query()->select('type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite',  'unite_users.*', 'unites.image')->join('unites', 'unites.id', '=', 'unite_users.unite_id')
        ->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')
        ->where('unite_users.user_id', '=', Auth::guard('appuser')->user()->id)
        ->get();
        $myClan = ClanUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
        $user = User::find($id);
        return view('dashboard.echange', compact('myUnites', 'unites', 'user', 'myClan'));
    }
   
    public function elementItemPersonnelView($id)
    {
        $personnel = Personnel_user::query()->select('personnels.titre_personnel',  'personnels.image',  'personnel_users.*')->join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')
                                        ->where("personnel_users.id", $id)
                                        ->first();
        $dateNow = new DateTimeImmutable();
        $dateNow = date_format($dateNow, 'Y-m-d H:i:s');
        $formations = DB::select("	SELECT formations.id AS formations_id, formations.libelle_formation, formations.prix_formation, formations.image_formation, formations.recompense_formation, formations.temps_formation, personnel_formations.id AS personnel_formations_id, personnel_formations.date_fin_formation  FROM formations  LEFT JOIN personnel_formations ON formations.id = personnel_formations.formation_id ");
        return view('dashboard.personnel', compact('personnel', 'formations', 'dateNow'));
    }
   
    public function addPersonnelFormation(Request $request) {
            $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix_formation);
            $data = $request->all();
        // return response()->json(['message' => intval(Auth::guard('appuser')->user()->argent - $request->prix). 'argent: ' . Auth::guard('appuser')->user()->argent . '-' . ' prix:'.  $request->prix],  );
        if ($rest >= 0) {   
                $personnelUser = Personnel_user::find($data['personnel_user_id']);
                $personnelUser->update(['etat_formation_personnel' => 'en formation', 'niveau' => $personnelUser->niveau + 1]);
                $dateNowInit = new DateTimeImmutable();
                $dateNow = date_format($dateNowInit, 'H:i:s');
                $dateNow2 = date_format($dateNowInit, 'Y-m-d');
                $dateFinal = new DateTimeImmutable($dateNow2. ' '. $this->AddingTime( $dateNow, $data['temps_formation']));
                $data['date_fin_formation'] = date_format($dateFinal, 'Y-m-d H:i:s');
                $user = User::find(Auth::guard('appuser')->user()->id);
                $user->update(['experience' => (intval($data["recompense_formation"]) + intval($user->experience  )), 'argent' => $rest]);
                //  return response()->json(['message' =>  $user->experience] );
                $personnelFormation = Personnel_formation::where("formation_id", "=", $data['formation_id'])->where('personnel_user_id', '=', $data['personnel_user_id'])->first();
                if (!$personnelFormation) {
                    if(isset($data['next_formation'])){
                        Personnel_formation::create(['formation_id' => $data['formation_id'], 'personnel_user_id' => $data['personnel_user_id'], 'date_fin_formation' =>  $data['date_fin_formation'], 'next_formation' => $data['next_formation']]);
                    }else{
                        Personnel_formation::create(['formation_id' => $data['formation_id'], 'personnel_user_id' => $data['personnel_user_id'], 'date_fin_formation' =>  $data['date_fin_formation']]);
                    }
                    return redirect('/dashboard/elements/personnel/'. $data['personnel_user_id'])->with(['status' => 'Votre personnel participe desormais à une formation ', 'color' => 'green']);
                }else{
                    return redirect('/dashboard/elements/personnel/'. $data['personnel_user_id'])->with(['status' => "Une erreur s'est produit, veuillez recommencer", 'color' => 'yellow']);
                }
                return redirect('/dashboard/elements/personnel/'. $data['personnel_user_id'])->with(['status' => "Une erreur s'est produit, veuillez recommencer", 'color' => 'red']);
            } else {
                return redirect('/dashboard/elements/personnel/'. $data['personnel_user_id'])->with(['status' => 'Pas vous n\'avez pas assez de pieces pour effectuer cette achat', 'color' => 'yellow']);
            }
    }

    public function viewClassement()
    {  
       
        $users = DB::select("SELECT users.id AS users_id, users.pseudo, users.experience, users.performance,  COUNT(mission_users.id) as count_mission FROM users  LEFT JOIN mission_users ON users.id = mission_users.user_id GROUP BY users.id,  users.pseudo, users.experience, users.performance, mission_users.id ORDER BY users.performance, users.pseudo, users.experience  ASC");
        return view('dashboard.classement', compact('users'));
    }

    public function viewClassementAlliance()
    {  
       
        $clans = DB::select("SELECT COUNT(clan_users.id) as count_user, clans.id as id, clans.nom_clan, clans.niveau, clans.experience, clans.niveau, clans.tag_clan, clans.max, clans.banner   FROM  clans LEFT JOIN clan_users ON clan_users.clan_id = clans.id WHERE deleted_at IS NULL GROUP BY clans.id,  clans.nom_clan, clans.niveau, clans.max, clans.banner ;");
        return view('dashboard.classement-clan', compact('clans'));
    }

    private function AddingTime($time1,$time2)
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



    public function addEventUser(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::guard('appuser')->user()->id;
        $data['etat'] = 'en cours';
        EventUser::create($data);
        return redirect('/')->with('status', 'Vous participez desormais à un événement!');
    }

    public function addUniteUser(Request $request)
    {
        $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
        // return response()->json(['message' => intval(Auth::guard('appuser')->user()->argent - $request->prix). 'argent: ' . Auth::guard('appuser')->user()->argent . '-' . ' prix:'.  $request->prix],  );
        if ($rest >= 0) {
            $data = $request->all();
            $data['user_id'] = Auth::guard('appuser')->user()->id;
            User::find(Auth::guard('appuser')->user()->id)->update(['argent' => $rest]);
            // $uniteUser = UniteUser::where("user_id", "=", Auth::guard('appuser')->user()->id)->where('unite_id', '=', $data['unite_id'])->first();
            // $quantite = intval($uniteUser->quantity) + 1;
            UniteUser::create($data);
            return redirect('/dashboard/boutique/unites')->with(['status' => 'Félicitation vous avez obtenue ' . $data['nom'], 'color' => 'green']);
        } else {
            return redirect('/dashboard/boutique/unites')->with(['status' => 'Pas vous n\'avez pas assez de pieces pour effectuer cette achat', 'color' => 'yellow']);
        }
    }

    public function addPersonnelUser(Request $request)
    {
        $rest = intval(Auth::guard('appuser')->user()->argent - $request->prix);
        // return response()->json(['message' => intval(Auth::guard('appuser')->user()->argent - $request->prix). 'argent: ' . Auth::guard('appuser')->user()->argent . '-' . ' prix:'.  $request->prix],  );
        if ($rest >= 0) {
            $data = $request->all();
            $data['user_id'] = Auth::guard('appuser')->user()->id;
            User::find(Auth::guard('appuser')->user()->id)->update(['argent' => $rest]);
            $personnelUser = Personnel_user::where("user_id", "=", Auth::guard('appuser')->user()->id)->where('personnel_id', '=', $data['personnel_id'])->first();
            if (!$personnelUser) {
               
                Personnel_user::create(['user_id' => $data['user_id'], 'personnel_id' => $data['personnel_id']]);
            }else{
                $quantite = intval($personnelUser->quantite_personnel) + 1;
                $personnelUser->update(["quantite_personnel" => $quantite]);
            }
            return redirect('/dashboard/boutique/personnels')->with(['status' => 'Félicitation vous avez obtenue ' . $data['titre_personnel'], 'color' => 'green']);
        } else {
            return redirect('/dashboard/boutique/personnels')->with(['status' => 'Pas vous n\'avez pas assez de pieces pour effectuer cette achat', 'color' => 'yellow']);
        }
    }
}
