<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class MissionUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mission_id',
        'position_x',
        'position_y',
        'etat',
        'icon',
        'is_completed',
        'fin_mission',
        'base_id',
        'hopital_id',
        'unit_ids',
        'reponse_correcte'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    public function hopital()
    {
        return $this->belongsTo(Hopital::class);
    }

    public static function getMyMissions()
    {
        return MissionUser::where('user_id', Auth::guard('appuser')->user()->id)
            ->whereIn('etat', ['PENDING', 'IN PROGRESS'])
            ->limit(1)
            ->get();
    }

    public static function getPendingMissions()
    {
        return MissionUser::where('user_id', Auth::guard('appuser')->user()->id)
            ->where('etat', 'PENDING')
            ->get();
    }

    public static function updatePendingMissionOnLogout()
    {
        $pendingMissions = self::getPendingMissions();
        foreach ($pendingMissions as $mission) {
            $mission->update(['etat' => 'COMPLETED']);
            // $mission->delete();
        }
    }
}
