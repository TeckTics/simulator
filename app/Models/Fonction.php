<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Fonction extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'libelle_fonction',
        'description_fonction',
        'code',
        'niveau',
        'fonction_requise',
        'published',
    ];

    protected function casts(): array
    {
        return [
            'published' => 'boolean',
        ];
    }

    // public function personnelFormation()
    // {
    //     return $this->hasMany(Personnel_formation::class);
    // }
}
