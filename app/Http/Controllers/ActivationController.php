<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActivationCode;
use App\Device;
class ActivationController extends Controller
{
    //
    public function getView(){
      return view('activation');
    }

    public function activateDevice(Request $request){
      $code = ActivationCode::where('code', $request->code)->first();
      if ($code != null){
        $device = Device::create([
          'user_id' => $request->user()->id,
          'uuid' => $code->uuid
        ]);
      }
      return redirect('/home');
    }

    public function registerDevice(Request $request){
      $code = ActivationCode::Create([
        'uuid' => $request->uuid,
        'code' => $request->code
      ]);
    }
}
