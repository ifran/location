<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Repositories\LocationRepository;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $address = $filters["endereco"] ?? null;
            $nome = $filters["nome"] ?? null;
            if (!empty($filters)) {
                $filters["endereco"];
                $filters["nome"];
            }

            $locationRepository = new LocationRepository();
            $locations = $locationRepository->getAllLocations($address, $nome);

            return view('home')
                ->with('hasLocation', count($locations) > 0)
                ->with('locations', $locations);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
