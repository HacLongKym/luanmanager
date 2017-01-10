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
use App\User;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



/**
 * Route of role Chef
 */
Route::post('/chef/{id}', [
    'uses' => 'ChefController@complete',
    'role' => User::ROLE_ADMIN + User::ROLE_MANAGER + User::ROLE_CHEF,
]);