<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandeUnite extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'sender_id',
        'user_id',
        'unite_user_id',
        'sender_uniter_id',
        'sender_argent',
        'status'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function uniteUser()
    {
        return $this->belongsTo(UniteUser::class);
    }
}
