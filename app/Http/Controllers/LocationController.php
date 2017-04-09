<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Device;
class LocationController extends Controller
{
    //

    public function startGps(){

    }

    public function stopGps(){

    }

    public function store(Request $request){
      $device = Device::where('uuid', $request->uuid)->first();
      $location = Location::Create([
        'long' => $request->long,
        'lat' => $request->lat,
        'device_id' => $device->id
      ]);
      event(new \App\Events\LocationCreated($location));
    }
}
