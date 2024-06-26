<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');


Route::get('/send',[App\Http\Controllers\userController::class,'getUsers'])->name('simma');
Route::get('/test',[App\Http\Controllers\userController::class,'testing'])->name('test');



Route::post('/createUser',[App\Http\Controllers\AuthController::class,'createUser'])->name('createUser');

