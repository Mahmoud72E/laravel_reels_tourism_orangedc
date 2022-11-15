<?php

use App\Http\Controllers\Api\ReelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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


    Route::middleware(['jwt-verify'])->group(function(){
        Route::post('reels', [ReelController::class, 'index']);
        Route::get('reel/{id}', [ReelController::class, 'show']);
        Route::post('StoreReel', [ReelController::class, 'store']);
        Route::get('places', [ReelController::class, 'places']);
        Route::post('comment', [ReelController::class, 'storeComment']);
        Route::post('comments', [ReelController::class, 'comments']);
    });
});


