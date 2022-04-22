<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Devices;
use Illuminate\Http\Request;


class DeviceProvisionController extends Controller
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

    public function setUserDevice($userID, $deviceID, $roomID, $firebasePath)
    {
        return $results = DB::table('user_device')
        ->insert(['userID' => $userID, 
                  'deviceID' => $deviceID,
                  'roomID' => $roomID,
                  'deviceFirebaseAddress' => $firebasePath]
        );
    }

    public function setUserDeviceCategory($userID, $categoryID, $roomID)
    {
        return $results = DB::table('user_room_category')
        ->insert(['userID' => $userID, 
                  'categoryID' => $categoryID,
                  'roomID' => $roomID]
        );
    }
    
}
