<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class equipementUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipement_id',
        'user_id',
        'sante',
        'quantite_equipement',
    ];

    public function TypeUnite()
    {
        return $this->belongsTo(TypeUnite::class);
    }
    public function Equipement()
    {
        return $this->belongsTo(equipement::class);
    }
    
}
