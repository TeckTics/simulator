<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParametreGeneral extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom_app',
        'title_header_home_page',
    ];
  
}
