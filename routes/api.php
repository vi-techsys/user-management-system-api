<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RegisterController;
use App\Http\Controllers\Api\UserController;

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
Route::group(['prefix' => 'v1'],function(){
    Route::middleware('throttle:5,1')->group( function () {
        Route::post('/register', [RegisterController::class, 'register']);
        Route::post('/login', [RegisterController::class, 'login']);
    });
    Route::middleware('auth:api', 'throttle:50,1')->group( function () {
        
        //general routes
        Route::post('/logout', [RegisterController::class, 'logout']);
        Route::post('/change-password', [UserController::class, 'changePassword']);

        //admin routes
        Route::middleware('role:admin')->group( function () {

            Route::get('/list-users',[UserController::class,'listUsers']);
            Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser']);

        });

        //user routes
        Route::middleware('role:user')->group( function () {

            Route::get('/user-profile', [UserController::class, 'profile']);
            Route::patch('/edit-profile', [UserController::class, 'editProfile']);

        });
    });
});
