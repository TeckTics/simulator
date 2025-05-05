<?php

namespace App\Models;

// use Faker\Provider\ar_EG\Person;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel_formation extends Model
{
    use HasFactory;

    protected $fillable = [
        'personnel_user_id',
        'date_fin_formation',
        'date_debut_formation',
        'formation_id',
        'next_formation'
    ];

    public function formation()
    {
        return $this->belongsTo(Formation::class);
    }

    public function personnel()
    {
        return $this->belongsTo(Personnel_user::class);
    }

    public static function getByFormationAndPersonnel($formationId, $personnelUserId)
    {
        return self::where('formation_id', $formationId)
            ->where('personnel_user_id', $personnelUserId)
            ->first();
    }

    public static function onPurchasePersonnel($personnelUserId, $niveau)
    {
        $formations = Formation::where('niveau', '<', $niveau)->get();
        $personnelUser = Personnel_user::find($personnelUserId);
        // dd($formations);
        if ($personnelUser) {
            foreach ($formations as $formation) {
                $defaultFormation = new Personnel_formation();
                $defaultFormation->personnel_user_id = $personnelUserId;
                $defaultFormation->formation_id = $formation->id;
                $defaultFormation->date_fin_formation = now(); // duration to past formation
                $defaultFormation->save();
            }
        }
    }
}
