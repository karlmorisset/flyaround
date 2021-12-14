<?php

namespace App\Service;

class GeoService
{
    public function calcDistance(
        float $latitudeOrigin, 
        float $longitudeOrigin,
        float $latitudeDestination, 
        float $longitudeDestination) : float
    {
        $r = 6371;
        $lao = deg2rad($latitudeOrigin);
        $lad = deg2rad($latitudeDestination);
        $lgo = deg2rad($longitudeOrigin);
        $lgd = deg2rad($longitudeDestination);
        
        $d = $r*acos(sin($lao)*sin($lad)+cos($lao)*cos($lad)*cos($lgo-$lgd));
        
        return $d;
    }
}
