<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class equipement extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'type_unite_id',
        'nom_equipement',
        'description_equipement',
        'prix_equipement'
    ];
    public function TypeUnite()
    {
        return $this->belongsTo(TypeUnite::class);
    }
    public function EquipementUser()
    {
        return $this->hasMany(equipementUser::class);
    }
}
