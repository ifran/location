<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    public function getAllLocations($address, $nome)
    {
        $location = Location::whereRaw("1=1");
        if ($address !== null) {
            $location->whereRaw("location_address like '%" . $address . "%'");
        }

        if ($nome !== null) {
            $location->whereRaw("location_name like '%" . $nome . "%'");
        }

        return $location->get();
    }
}
