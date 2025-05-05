<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Mission extends Model
{
    // , SoftDeletes;
    use HasFactory;

    protected $table = 'missions';

    protected $fillable = [
        'nom_mission',
        'description_mission',
        'duree',
        'published',
        'type_unite_id',
        'personnel_id',
        'recompense',
        'image'
    ];
    
    public function missionUser()
    {
        return $this->hasMany(MissionUser::class);
    }

    public function typeunite()
    {
        // return $this->belongsTo(TypeUnite::class);
        return $this->belongsTo(TypeUnite::class, 'type_unite_id', 'id');
    }
}
