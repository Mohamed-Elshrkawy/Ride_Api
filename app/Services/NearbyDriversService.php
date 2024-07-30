<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class NearbyDriversService
{
    /**
     * Get nearby drivers based on location.
     *
     * @param  float  $latitude
     * @param  float  $longitude
     * @param  int  $radius
     * @return \Illuminate\Support\Collection
     */
    public function getNearbyDrivers($latitude, $longitude, $radius = 10)
    {
        return User::select('users.*', DB::raw("(6371 * acos(cos(radians($latitude))
                * cos(radians(JSON_EXTRACT(users.location, '$.latitude')))
                * cos(radians(JSON_EXTRACT(users.location, '$.longitude')) - radians($longitude))
                + sin(radians($latitude))
                * sin(radians(JSON_EXTRACT(users.location, '$.latitude'))))) AS distance"))
            ->join('drivers', 'users.id', '=', 'drivers.user_id')
            ->where('users.user_type', 'driver')
            ->where('drivers.status', 'active')
            ->having('distance', '<', $radius)
            ->orderBy('distance')
            ->get();
    }

}
