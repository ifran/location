<?php

namespace App\Http\Controllers\Web;

use App\Models\Location;
use App\Services\LocationService;
use Illuminate\Http\Request;

class LocationController
{
    public function index(Request $request)
    {
        $location = null;
        if ($request->get("id") !== null) {
            $location = Location::find($request->get("id"));
        }

        return view("local")
            ->with("location", $location);
    }

    public function save(Request $request)
    {
        $locationService = new LocationService();
        $locationService->handleInformationAndSave($request);

        return response()->json(["msg" => "Sucesso"]);
    }
}
