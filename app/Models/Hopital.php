<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Hopital extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nom_hopital',
        'capacite_hopital',
        'position_x',
        'position_y',
        'icon_hopital',
        'image_hopital'
    ];
   
}
