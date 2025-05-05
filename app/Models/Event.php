<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Event extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nom_event',
        'description_event',
        'type_event',
        'date_fin',
        'published',
        'recompense',
        'admin_id',
        'image',
    ];
    public function eventUser()
    {
        return $this->hasMany(EventUser::class);
    }
}
