<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ReelController;
use App\Http\Controllers\SocialiteController;

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
Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('logout', 'logout');
        Route::post('refresh', 'refresh');
        Route::get('me', 'me');
        Route::post('/signpgoogle', 'registerbygoogle');
        Route::post('/loginbygoogle', 'loginbygoogle');
    });
    Route::post('/login/callback', [SocialiteController::class, 'handleProviderCallback']);
   // Route::resource('reel', ReelController::class);
    Route::post('reel', [ReelController::class, 'store']);
});


