<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unite extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'vitesse_unite',
        'nom_unite',
        'capacite_unite',
        'etat_mouvement_unite',
        'etat_unite',
        'taux_usure',
        'prix_unite',
        'type_unite_id',
        'image',
    ];

    public function typeUnite()
    {
        return $this->belongsTo(TypeUnite::class);
    }
    public function uniteUser()
    {
        return $this->hasMany(UniteUser::class);
    }
}
