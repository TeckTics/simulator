<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class BaseUnite extends Model
{

    use HasFactory;

    protected $fillable = [
        'nom_base',
        'icon_base',
        'position_x',
        'position_y',
        'description_base',
        'type_base_id',
        'base_id',
        'unite_id',
    ];
    public function base()
    {
        return $this->belongsTo(Base::class);
    }
    public function unite()
    {
        return $this->belongsTo(Unite::class);
    }
}
