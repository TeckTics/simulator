<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClanUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'clan_id',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function clan()
    {
        return $this->belongsTo(Clan::class);
    }
}
