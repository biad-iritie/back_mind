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

/* Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
}); */

/* AUTHENTIFICATION */
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login');
//Route::post('check', 'AuthController@getAuthUser');

Route::apiResource('type_user', 'Type_userController');
Route::apiResource('type_event', 'Type_eventController');

/* EVENEMENT */
Route::get('evenement','EvenementController@index');

Route::group(['middleware' => ['jwt.verify']], function () {
    
    Route::post('evenement','EvenementController@store');
    Route::apiResource('achat', 'AchatController');
    Route::apiResource('ticket', 'TicketController');
    
    
});
