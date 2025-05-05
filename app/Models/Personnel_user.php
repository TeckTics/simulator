<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Personnel_user extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'personnel_id',
        'etat_mouvement_personnel',
        'nom_personnel',
        // 'etat_formation_personnel', // enum => 'en formation', 'libre', 'en mission', 'base'
        'quantite_personnel',
        'is_busy',
        'niveau',
        'user_id',
        'total_used',
        'prenom_personnel',
        'base_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }

    /**
     * Retourne le type de personnel parmis les valeurs 
     * 'en formation','libre','en mission','base' 
     * en fonction de son etat actuel.
     *
     * @return string
     */
    public function getTypePersonnel()
    {
        if ($this->etat_formation_personnel == 'en_formation') {
            return 'en formation';
        }

        if ($this->etat_mouvement_personnel == 'en_mission') {
            return 'en mission';
        }

        if ($this->base_id) {
            return 'base';
        }

        return 'libre';
    }

    /**
     * Retourne les personnels qui sont en base.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function getPersonnelsInBase($base_id)
    {
        $personnelIdsInFormation = Personnel_formation::where('date_fin_formation', '>', now())
            ->pluck('personnel_user_id')
            ->toArray();

        return self::query()
            ->select('personnels.fonction_code', 'personnels.image', 'personnel_users.*')
            ->join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')
            ->whereNotIn('personnel_users.id', $personnelIdsInFormation)
            ->where("personnel_users.base_id", $base_id)
            ->with('personnel.fonction')
            ->get()
            ->map(function ($personnelUser) {
                return self::fillPersonnelData($personnelUser);
            });

        // return self::query()
        //     ->select('personnels.fonction_code',  'personnels.image',  'personnel_users.*')
        //     ->join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')
        //     ->where("personnel_users.etat_formation_personnel", 'base')
        //     ->with('personnel.fonction')
        //     ->get()
        //     ->map(function ($personnelUser) {             
        //         return self::fillPersonnelData($personnelUser);
        //     });
    }

    /**
     * Retourne la liste des personnels affects une base.
     *
     * @param int $base_id Identifiant de la base.
     * @return \Illuminate\Support\Collection
     */
    public static function getPersonnelsByBaseId($base_id)
    {
        return self::query()
            ->select('personnels.fonction_code', 'personnels.image', 'personnel_users.*')
            ->join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')
            ->where("personnel_users.base_id", $base_id)
            ->with('personnel.fonction')
            ->get()
            ->map(function ($personnelUser) {
                return self::fillPersonnelData($personnelUser);
            });
    }

    /**
     * Retourne la liste des personnels de l'utilisateur connect ,
     * avec leurs informations de fonction et d'image.
     *
     * @return \Illuminate\Support\Collection
     */
    public static function getPersonnels()
    {
        return self::select(['personnel_users.*', 'personnels.image', 'personnels.fonction_code'])
            ->join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')
            ->where('personnel_users.user_id', Auth::guard('appuser')->id())
            ->with('personnel.fonction')
            ->get()
            ->map(function ($personnelUser) {
                return self::fillPersonnelData($personnelUser);
            });
    }

    /**
     * Ajoute les informations du personnel, 
     * telles que son libell , son tat d'occupation et son tat de formation,
     *  un objet personnel_user.
     *
     * @param Model $personnelUser L'objet personnel_user.
     * @return Model L'objet personnel_user avec les informations du personnel.
     */
    public static function fillPersonnelData($personnelUser)
    {
        $personnel = $personnelUser;
        if (isset($personnel)) {
            $personnel->titre_personnel             = optional($personnelUser->personnel)->fonction->libelle_fonction ?? '';
            $personnel->is_busy                     = self::is_busy($personnelUser->id);
            $personnel->etat_formation_personnel    = self::etat_personnel($personnelUser->id);
        }
        return $personnel;
    }

    public static function is_busy($personnel_id)
    {
        $is_busy =  false;
        $in_training = Personnel_formation::where('personnel_user_id', $personnel_id)->first();

        if ($in_training && $in_training->date_fin_formation > now()) {
            $is_busy = true;
        }
        return $is_busy;
    }

    public static function etat_personnel($personnel_id)
    {
        // enum => 'en formation', 'libre', 'en mission', 'base'
        $etat_personnel =  'base';
        $in_training = Personnel_formation::where('personnel_user_id', $personnel_id)->first();
        // $in_mission = MissionUser::where('personnel_user_id', $personnel_id)->first();

        if ($in_training && $in_training->date_fin_formation > now()) {
            $etat_personnel = 'en formation';
        }
        return $etat_personnel;
    }


    /**
     * Retourne la liste des personnages du film Matrix.
     *
     * @return array
     */
    public static function getArrayNames()
    {
        return ['Neo', 'Morpheus', 'Trinity', 'Cypher', 'Tank'];
    }
}
