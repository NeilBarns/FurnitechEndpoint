<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Devices;
use Illuminate\Http\Request;


class DeviceController extends Controller
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

    public function getAll()
    {
        return response()->json(Devices::all());
    }

    public function getDevice($deviceID)
    {
        return response()->json(Devices::select('macAddress','ipAddress')->where('deviceID', $deviceID)->get());
    }

    public function getDeviceByIP($deviceIP, $roomID)
    {
        // return $results = DB::table('devices')
        // ->join('category', 'devices.categoryID', '=', 'category.categoryID')
        // ->select('devices.deviceID',
        //          'devices.firebaseName', 
        //          'devices.firebaseJSON', 
        //          'devices.itemName',
        //          'category.categoryName',
        //          'category.categoryImage')
        // ->where('devices.ipAddress', '=', $deviceIP)
        // ->get();

        return $results = DB::select("SELECT devices.deviceID,
                                             devices.firebaseName, 
                                             devices.firebaseJSON, 
                                             devices.itemName,
                                             category.categoryID,
                                             category.categoryName,
                                             category.categoryImage,
                                             (SELECT IFNULL((SELECT categoryID 
                                                             FROM `user_room_category` 
                                                             WHERE roomID = $roomID 
                                                                AND category.categoryID = user_room_category.categoryID), 0)) as categoryExistence
                                      FROM devices JOIN
                                             category
                                      WHERE devices.ipAddress = $deviceIP");
    }

    public function getCategoryByRoom($roomID)
    {
        return $results = DB::select("SELECT CAT.categoryID,
                                             CAT.categoryName,
                                             CAT.categoryImage,
                                             rooms.roomName,
                                             (SELECT COUNT(*) FROM user_device WHERE roomID = $roomID) AS device_count
                                      FROM `user_room_category` AS USR
                                      JOIN `category` AS CAT 
                                      ON USR.categoryID = CAT.categoryID
                                      JOIN `rooms`
                                      ON USR.roomID = rooms.roomID
                                      WHERE USR.roomID = $roomID;");
    }

    public function getDeviceFirebaseDetails($roomID, $categoryID)
    {
        return $results = DB::table('user_device')
                ->join('devices', 'user_device.deviceID', '=', 'devices.deviceID')
                ->select('devices.deviceID',
                        'devices.firebaseName')
                ->where('user_device.roomID', '=', $roomID)
                ->where('devices.categoryID', '=', $categoryID)
                ->get();
    }
    
}
