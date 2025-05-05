<?php

namespace App\Services;

use App\Models\Mission;
use App\Models\User;

class MissionService
{
    public function create()
    {
       $mission = new Mission();
       $mission->nom_mission = 'mission';
       $mission->description_mission = 'description';
       $mission->recompense = 1000;
       $mission->save();
       return $mission;
    }
}
