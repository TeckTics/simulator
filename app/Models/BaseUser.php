<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseUser extends Model
{

    
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'nom_base',
        'icon_base',
        'position_x',
        'position_y',
        'description_base',
        'type_base_id',
        'user_id',
        'lieu'
    ];
    public function base()
    {
        return $this->belongsTo(TypeBase::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
