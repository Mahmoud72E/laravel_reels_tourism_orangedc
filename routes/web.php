<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ReelController;
use App\Http\Controllers\SocialShareController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::get('share/{id}', [SocialShareController::class, 'index'])->name('share.button');
Route::get('comment/{rid}', [CommentController::class, 'index'])->name('comment.index');
Route::post('comment/add', [CommentController::class, 'store'])->name('comment.store');
Route::resource('reel', ReelController::class);
Route::get('place', [ ReelController::class, 'places']);
