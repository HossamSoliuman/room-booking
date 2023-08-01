<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;

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
//public routes
Route::post('login',[AuthenticationController::class,'login']);
Route::post('register',[AuthenticationController::class,'register']);


//auth routes
Route::middleware(['auth:sanctum'])->group(function(){
    
});

//admin routes
Route::middleware(['auth:sanctum','admin'])->group(function(){
    
});