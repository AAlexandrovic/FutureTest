<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotebookController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::group(["prefix"=>"v1"],function(){
    Route::post("/v1/notebook/store",[\App\Http\Controllers\NotebookController::class,"store"]);
    Route::get("/v1/notebook/gets",[\App\Http\Controllers\NotebookController::class,"gets"]);
    Route::get("/v1/notebook/{id}",[\App\Http\Controllers\NotebookController::class,"get"]);
    Route::delete("/v1//delete/{id}",[NotebookController::class,"delete"]);
//});
