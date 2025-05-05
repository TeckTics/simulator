<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelInformation extends Model
{
    use HasFactory;
    protected $table = 'personnel_informations';

    protected $fillable = [
        'personnel_id',
        'information',
    ];

    public function personnel()
    {
        return $this->belongsTo(Personnel::class);
    }
}
