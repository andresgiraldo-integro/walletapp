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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'auth',
], function () {

	//Route::post('refresh', 'AuthController@refresh');//refresh token
    //Route::post('register', 'APIRegisterController@register');//Register
    Route::post('login', 'APILoginController@login');//Login
    //Route::post('logout', 'AuthController@logout')->middleware('jwt.auth');//Logout



    //Route::get('/content/{post}', 'ContentController@show');


});


Route::group([
    'middleware' => [
        'jwt.verify'
    ],
    'prefix' => 'auth',
], 
function () {
    Route::get('user', 'UserController@index');
});