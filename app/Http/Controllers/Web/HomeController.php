<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;

class HomeController extends Controller
{
    public function index()
    {
        $locationRepository = new LocationRepository();
        $locations = $locationRepository->getAllLocations();

        return view('home')
            ->with('hasLocation', count($locations) > 0)
            ->with('locations', $locations);
    }
}
