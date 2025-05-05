<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Personnel extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       // 'titre_personnel',
        'description_personnel',
        'prix_personnel',
        'image',
        'published',
        'niveau',
        'fonction_code',
        'information',
    ];

    protected function casts(): array
    {
        return [
            'published' => 'boolean',
            'information' => 'array',
        ];
    }

    // public function typeUnite()
    // {
    //     return $this->belongsTo(TypeUnite::class);
    // }

    public function fonction()
    {
        return $this->belongsTo(Fonction::class, 'fonction_code', 'code');
    }

    public function personnelUser()
    {
        return $this->hasMany(Personnel_user::class);
    }

    public function personnelFormation()
    {
        return $this->hasMany(Personnel_formation::class);
    }

    public function informations()
    {
        return $this->hasMany(PersonnelInformation::class);
    }

    /**
     * Retrieve all published personnel records with their associated function.
     *
     * This method fetches personnel records that are marked as published,
     * eager loads their associated 'fonction', and maps the 'libelle_fonction'
     * from the 'fonction' model to the 'titre_personnel' attribute.
     *
     * @return \Illuminate\Support\Collection A collection of published personnel records with their title set.
     */
    public static function getPublished()
    {
        return self::where('published', 1)
            ->orderBy('niveau', 'asc')
            ->with('fonction')
            ->get()
            ->map(function ($personnel) {
                $personnel->titre_personnel = optional($personnel->fonction)->libelle_fonction ?? '';
                return $personnel;
            });
    }


    /**
     * Get the niveau attribute.
     *
     * @return int
     */
    public static function getNiveauById($personnel_id)
    {
        $personnel = Personnel::find($personnel_id);
        $niveau = 0;
        if (isset($personnel->niveau)) {
            $niveau = $personnel->niveau;
        }

        return $niveau;
    }
}
