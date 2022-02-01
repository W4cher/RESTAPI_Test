<?php

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;

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

Route::name('tasks.')->prefix('tasks')->group(function() {
    Route::get("/", [TaskController::class, 'index']);
    Route::get("/{id}", [TaskController::class, 'show']);
    Route::post("/", [TaskController::class, 'create']);
    Route::put("/update/{id}", [TaskController::class, 'update']);
    Route::delete("/delete/{id}", [TaskController::class, 'delete']);
});

Route::name('multiuploads.')->prefix('multiuploads')->group(function() {
    Route::get('/', 'UploadController@uploadForm');
    Route::post('/', 'UploadController@uploadSubmit');
});
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


