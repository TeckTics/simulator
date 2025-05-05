<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, CanResetPassword;


    protected $fillable = [
        'pseudo',
        'nom',
        'prenom',
        'niveau',
        'experience',
        'profile',
        'argent',
        'performance',
        'isblocked',
        'email',
        'password',
        'online',
        'ville',
        'lat',
        'lgt',
        'intervention_total',
        'last_login',
        'last_alliance_created_at',
        'last_alliance_belong_date',
        'last_alliance_id'
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'online' => 'boolean'
        ];
    }
    public function demandeUnite()
    {
        return $this->hasMany(DemandeUnite::class);
    }
    public function chatMessage()
    {
        return $this->hasMany(ChatMessage::class);
    }
    public function privateChatMessage()
    {
        return $this->hasMany(PrivateChatMessage::class);
    }
    public function missionUser()
    {
        return $this->hasMany(MissionUser::class);
    }
    public function eventUser()
    {
        return $this->hasMany(EventUser::class);
    }
    public function uniteUser()
    {
        return $this->hasMany(UniteUser::class);
    }
    public function clanUser()
    {
        return $this->hasMany(ClanUser::class);
    }
    public function baseUser()
    {
        return $this->hasMany(BaseUser::class);
    }
    
    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }



}
