<?php

namespace App\Models;


use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Fortify\TwoFactorAuthenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasProfilePhoto, SoftDeletes;


    protected $fillable = [
        'pseudo',
        'nom',
        'prenom',
        'profile',
        'email',
        'password',
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
        ];
    }

    public function typeBase()
    {
        return $this->hasMany(TypeBase::class);

    }
}
