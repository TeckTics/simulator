<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Clan extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'nom_clan',
        'chef_id',
        'description_clan',
        'banner',
        'experience',
        'niveau',
        'max',
        'tag_clan'
    ];
    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function clanUser()
    {
        return $this->belongsTo(ClanUser::class);
    }
}
