<?php

namespace App\Repositories;

use App\Models\Location;

class LocationRepository
{
    public function getAllLocations()
    {
        return Location::get();
    }
}
