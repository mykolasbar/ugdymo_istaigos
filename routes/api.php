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

Route::get('/pupil/{userid}', [requestsController::class, 'showPupil']);

Route::delete('/deletepupil/{userid}', [requestsController::class, 'deletePupil']);

Route::put('/editpupil/{id}', [requestsController::class, 'editPupil']);

Route::get('/schools', [schoolsController::class, 'showAllSchools']);

Route::delete('/deleteschool/{id}', [schoolsController::class, 'deleteSchool']);

Route::get('/school/{id}', [schoolsController::class, 'showSingleSchool']);

Route::put('/school/{id}', [schoolsController::class, 'updateSchool']);

Route::put('/addschool', [schoolsController::class, 'newSchool']);

Route::get('/showallrequests', [requestsController::class, 'showAllRequests']);

Route::get('/userpupils/{userid}', [requestsController::class, 'showUserPupils']);

Route::get('/userorders/{userid}', [requestsController::class, 'showUserRequests']);

Route::put('/confirmrequest/{id}', [requestsController::class, 'confirmRequest']);

Route::put('/makeviewed/{userid}', [requestsController::class, 'makeViewed']);

Route::get('/search', [schoolsController::class, 'searchSchools']);



Route::post('/register', [authorizationController::class, 'register']);

Route::post('/login', [authorizationController::class, 'login']);

Route::post('/logout', [authorizationController::class, 'logout'])->middleware('auth:sanctum', 'abilities:user-abilities');



Route::get('/forgot-password', function () {return view('auth.forgot-password');})->middleware('guest')->name('password.request');


