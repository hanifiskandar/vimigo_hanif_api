<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserPlaylistController;
use App\Http\Controllers\UserSubscriptionController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//profile
Route::get('profile/{id}',[UserProfileController::class, 'show']);
Route::get('lookup',[UserProfileController::class, 'lookup']);
Route::post('update-profile/{id}', [UserProfileController::class, 'update']);

//music-playlist
Route::get('playlist/{id}',[UserPlaylistController::class, 'show']);

//subscription
Route::post('update-subscription/{id}', [UserSubscriptionController::class, 'update']);

