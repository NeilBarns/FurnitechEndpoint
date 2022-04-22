<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix' => 'devices'], function($router){

    $router->get('getAll', 'DeviceController@getAll');

    $router->get('deviceID/{deviceID}', 'DeviceController@getDevice');

    $router->get('deviceIP/{deviceIP}/roomID/{roomID}', 'DeviceController@getDeviceByIP');

    $router->get('roomID/{roomID}', 'DeviceController@getCategoryByRoom');

    $router->get('firebasedetails/roomID/{roomID}/categoryid/{categoryID}', 'DeviceController@getDeviceFirebaseDetails');
});

$router->group(['prefix' => 'devicesprovision'], function($router){
    
    $router->get('userid/{userID}/deviceid/{deviceID}/roomid/{roomID}/firebaseaddress/{firebasePath}', 'DeviceProvisionController@setUserDevice');

    $router->get('userid/{userID}/categoryid/{categoryID}/roomid/{roomID}', 'DeviceProvisionController@setUserDeviceCategory');
});

$router->group(['prefix' => 'iot'], function($router){
    
    $router->get('deviceID/{deviceID}', 'IOTController@getIOTDeviceDetails');

});

