<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Authentication
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [App\Http\Controllers\AuthController::class, 'createUser']);
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);

// Contest
Route::get('/getContests', [App\Http\Controllers\contestController::class, 'getContests']);
Route::post('/createContest', [App\Http\Controllers\contestController::class, 'createContest']);
Route::put('/updateContest/{id}', [App\Http\Controllers\contestController::class, 'updateContest']);
Route::delete('/deleteContest/{id}', [App\Http\Controllers\contestController::class, 'deleteContest']);

// Contestants
Route::get('/getContestants', [App\Http\Controllers\contestantController::class, 'getContestants']);
Route::post('/createContestant', [App\Http\Controllers\contestantController::class, 'createContestant']);
Route::put('/updateContestant/{id}', [App\Http\Controllers\contestantController::class, 'updateContestant']);
Route::delete('/deleteContestant/{id}', [App\Http\Controllers\contestantController::class, 'deleteContestant']);

// Contacts
Route::get('/getContacts', [App\Http\Controllers\contactController::class, 'getContacts']);
Route::post('/createContact', [App\Http\Controllers\contactController::class, 'createContact']);
Route::put('/updateContact/{id}', [App\Http\Controllers\contestantController::class, 'updateContact']);
Route::delete('/deleteContact/{id}', [App\Http\Controllers\contestantController::class, 'deleteContact']);


Route::get('/send',[App\Http\Controllers\userController::class,'getUsers'])->name('simma');

