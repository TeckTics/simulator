<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UniteUser extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vitesse',
        'nom',
        'places_disponible',
        'etat_mouvement_unite',
        'etat_unite',
        'taux_usure',
        'quantity',
        'sante',
        'icon',
        'capacites',
        'unite_id',
        'user_id',
        'base_id'
    ];

    protected $cast = ['capacites' => 'array'];

    public function demandeUnite()
    {
        return $this->hasMany(DemandeUnite::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }

    public static function getUnitFromMission($ids)
    {
        $units = [];
        try {
            foreach (explode(",", $ids) as $id) {
                $unitUser = UniteUser::where('id', $id)->first();
                if ($unitUser === null) {
                    continue;
                }

                $unit = Unite::where('id', $unitUser->unite_id)->first();
                if ($unit === null) {
                    continue;
                }

                $type = TypeUnite::where('id', $unit->type_unite_id)->first();
                if ($type === null) {
                    continue;
                }

                $unit->type = $type;
                $units[] = $unit;
            }
            return $units;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
