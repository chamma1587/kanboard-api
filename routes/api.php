<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


$api = app('Dingo\Api\Routing\Router');


$api->version('v1', function ($api) { 
    #post
    $api->post('board/add', 'App\Http\Controllers\BoardController@addBoard');  
    $api->post('board/add-item/{uuid}', 'App\Http\Controllers\BoardController@addBoardItem');  

    #get
    $api->get('board/list', 'App\Http\Controllers\BoardController@getBoards'); 
    $api->get('board/dump', 'App\Http\Controllers\BoardController@downloadDbDump');   

    #put
    $api->put('board/update', 'App\Http\Controllers\BoardController@updateBoardData'); 
    $api->put('board/update-item/{uuid}', 'App\Http\Controllers\BoardController@updateBoardItem');   

    #delete
    $api->delete('board/delete/{uuid}', 'App\Http\Controllers\BoardController@deleteBoard');   
    $api->delete('board/delete-item/{uuid}', 'App\Http\Controllers\BoardController@deleteBoardItem'); 

   
});




   