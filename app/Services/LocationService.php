<?php

namespace App\Services;

use App\Models\Location;

class LocationService
{
    public function handleInformationAndSave($request)
    {
        $request->validate([
            'imagem' => 'mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $extension = $request->file('imagem')->getClientOriginalExtension();
        $filename = uniqid() . '.' . $extension;
        $request->file('imagem')->storeAs('images', $filename, 'public');

        $location = $request->all();

        $local = new Location();
        $local->location_name = $location['nome'];
        $local->location_address = $location['estado'] . " " . $location['cidade'] . " " . $location['bairro'] . " " . $location['endereco'] . " " . $location['numero'];
        $local->location_desc = $location['descricao'];
        $local->location_lat = $location['lat'];
        $local->location_long = $location['lng'];
        $local->location_img = $filename;
        $local->user_id = session()->get("userId");
        $local->save();
    }
}
