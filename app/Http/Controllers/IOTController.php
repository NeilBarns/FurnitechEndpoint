<?php

namespace App\Http\Controllers;

use DB;
use App\Models\User_Devices;
use Illuminate\Http\Request;


class IOTController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function getIOTDeviceDetails($deviceID)
    {
        return $results = DB::table('user_device')
                ->select('user_device.deviceFirebaseAddress')
                ->where('user_device.deviceID', '=', $deviceID)
                ->get();
    }
    
}
