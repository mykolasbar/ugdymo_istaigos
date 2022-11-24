<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\schoolsController;
use App\Http\Controllers\requestsController;
use App\Http\Controllers\authorizationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/schools', [schoolsController::class, 'showAllSchools']);

Route::post('/newpupil', [requestsController::class, 'newPupil']);

Route::post('/newrequest', [requestsController::class, 'addRequest']);

Route::get('/pupils/{userid}', [requestsController::class, 'showUserPupils']);


Route::post('/register', [authorizationController::class, 'register']);

Route::post('/login', [authorizationController::class, 'login']);

Route::post('/logout', [authorizationController::class, 'logout'])->middleware('auth:sanctum', 'abilities:user-abilities');




// Route::get('/countries/{id}', [countriesController::class, 'showSingleCountry']);

