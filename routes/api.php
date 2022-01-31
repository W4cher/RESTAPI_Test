<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\tasksControl;
use App\Http\Controllers\tasksController;

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


Route::get("list", [tasksControl::class, 'list']);
Route::post("add", [tasksController::class, 'add']);
Route::put("update", [tasksController::class, 'update']);
Route::delete("delete/{id}", [tasksController::class, 'delete']);



// Route::get('/', function () {
//     return 'ola';
// });

// Route::get('/users', function () {

//     $users = User::all();

//     return $users;
// });

// Route::get('/users/{userId}', function ($userId) {
 
//     $user = User::findOrFail($userId);

//     return $user;
// });


