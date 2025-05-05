<?php

namespace App\Services;

use App\Models\BaseUser;
use App\Models\Hopital;

class HopitalService
{
    public function getCloserToBase(BaseUser $baseUser, int $nomber = 3)
    {
        $hopitaux = Hopital::all();
        $missionLat = $baseUser->position_x;
        $missionLon = $baseUser->position_y;
        
        foreach ($hopitaux as $hopital) {
            $hopital->distance = $this->calculateDistance(
                $missionLat,
                $missionLon,
                $hopital->position_x, // latitude
                $hopital->position_y  // longitude
            );
        }    
        return $hopitaux->sortBy('distance')->take($nomber)->values()->toArray();
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // Rayon de la Terre en km

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        $a = sin($deltaLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($deltaLon / 2) ** 2;
        $c = 2 * asin(sqrt($a));

        return $earthRadius * $c;
    }
}
