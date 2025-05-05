<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Formation extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        // 'libelle_formation',
        'fonction_id',
        'prix_formation',
        'temps_formation',
        'image_formation',
        'published',
        'recompense_formation',
        'description_formation',
        'niveau',
    ];

    protected function casts(): array
    {
        return [
            'published' => 'boolean',
        ];
    }

    public function fonction()
    {
        return $this->belongsTo(Fonction::class);
    }

    // public function typeUnite()
    // {
    //     return $this->belongsTo(TypeUnite::class);
    // }

    public function personnelFormation()
    {
        return $this->hasMany(Personnel_formation::class);
    }

    
    public static function getFormations()
    {
        // $personnelUser
        return self::where('published', 1)
            // ->where('personnel_id', $personnelUser->personnel_id)
            ->orderBy('niveau', 'asc')
            ->get();
    }
    
}
