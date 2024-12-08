<?php

namespace App\Http\Controllers\Web;

use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LocationController
{
    public function index()
    {
        return view("local");
    }

    public function save(Request $request)
    {
        Log::debug($request);
        $locationService = new LocationService();
        $locationService->handleInformationAndSave($request);

        return response()->json(["msg" => "Sucesso"]);
    }
}