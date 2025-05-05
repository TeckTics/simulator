<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametreJeu extends Model
{
    use HasFactory;
    protected $fillable = [
        'message_regulation',
        'distance_generation_mission',
        'message_fin_mission',
        'nom_alliance',
        'prix_clan',
        'updated_at',
        'intervale_mission_a',
        'intervale_mission_b',
    ];
}
