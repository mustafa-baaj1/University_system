<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\DepController;
use App\Http\Controllers\Api\SchemaController;
use App\Http\Middleware\myMiddleware;
use Illuminate\Support\Facades\Route;

// Schema API endpoint for React app
Route::get('/schema', [SchemaController::class, 'index']);

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);


Route::middleware("auth:api")->group(function(){

 Route::get("department/{dep}",[DepController::class,"view"]);
  Route::get("department/edit/{dep}",[DepController::class,"edit"]);

  Route::post('logout',[AuthController::class,'logout']);

});


