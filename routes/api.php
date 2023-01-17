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

Route::post('/newpupil', [requestsController::class, 'newPupil'])->middleware('auth:sanctum', 'abilities:user-abilities,admin-abilities');

Route::post('/newrequest', [requestsController::class, 'addRequest'])->middleware('auth:sanctum', 'abilities:user-abilities,admin-abilities');

Route::get('/pupils/{userid}', [requestsController::class, 'showUserPupils'])->middleware('auth:sanctum', 'abilities:user-abilities,admin-abilities');

Route::get('/pupil/{userid}', [requestsController::class, 'showPupil'])->middleware('auth:sanctum', 'abilities:user-abilities,admin-abilities');

Route::delete('/deletepupil/{userid}', [requestsController::class, 'deletePupil'])->middleware('auth:sanctum', 'abilities:user-abilities,admin-abilities');

Route::put('/editpupil/{id}', [requestsController::class, 'editPupil'])->middleware('auth:sanctum', 'abilities:user-abilities,admin-abilities');

Route::delete('/deleteschool/{id}', [schoolsController::class, 'deleteSchool'])->middleware('auth:sanctum', 'abilities:admin-abilities');

Route::get('/school/{id}', [schoolsController::class, 'showSingleSchool']);

Route::put('/school/{id}', [schoolsController::class, 'updateSchool'])->middleware('auth:sanctum', 'abilities:admin-abilities');

Route::put('/addschool', [schoolsController::class, 'newSchool'])->middleware('auth:sanctum', 'abilities:admin-abilities');

Route::get('/showallrequests', [requestsController::class, 'showAllRequests']);

Route::get('/userpupils/{userid}', [requestsController::class, 'showUserPupils'])->middleware('auth:sanctum');

Route::get('/userorders/{userid}', [requestsController::class, 'showUserRequests'])->middleware('auth:sanctum');

Route::put('/confirmrequest/{id}', [requestsController::class, 'confirmRequest'])->middleware('auth:sanctum', 'abilities:admin-abilities');

Route::put('/makeviewed/{userid}', [requestsController::class, 'makeViewed'])->middleware('auth:sanctum', 'abilities:admin-abilities');

Route::get('/search', [schoolsController::class, 'searchSchools']);



Route::post('/register', [authorizationController::class, 'register']);

Route::post('/login', [authorizationController::class, 'login']);

Route::post('/logout', [authorizationController::class, 'logout'])->middleware('auth:sanctum', 'abilities:user-abilities');



Route::get('/forgot-password', function () {return view('auth.forgot-password');})->middleware('guest')->name('password.request');


