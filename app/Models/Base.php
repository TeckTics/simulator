<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Base extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nom_base',
        'icon_base',
        'position_x',
        'position_y',
        'description_base',
        'type_base_id',
    ];
    public function typeBase()
    {
        return $this->belongsTo(TypeBase::class);
    }
    public function baseUnite()
    {
        return $this->hasMany(BaseUnite::class);
    }
    public function baseUser()
    {
        return $this->hasMany(BaseUser::class);
    }
}
