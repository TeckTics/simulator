<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeUnite extends Model
{
    use HasFactory, SoftDeletes, HasFactory;
    
    protected $fillable = [
        'nom_type_unite',
        'description_type_unite',
        'image',
    ];

    public function unite()
    {
        return $this->hasMany(Unite::class);
    }
}
