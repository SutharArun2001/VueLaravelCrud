<?php

use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('login',[UserController::class,'login']);

Route::post('user/create',[UserController::class,'create'])->name('user.create');
Route::get('user/edit/{id}',[UserController::class,'edit']);
Route::post('user/update/{id}',[UserController::class,'update']);
Route::get('user/delete/{id}',[UserController::class,'delete']);
Route::get('user/index',[UserController::class,'index']);
