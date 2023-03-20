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

Route::group(["prefix"=>"v1"],function(){
    Route::match(['get','post'],"/notebook/store",[NotebookController::class,"store"]);
    Route::match(['get','post'],"/notebook/gets",[NotebookController::class,"gets"]);
    Route::match(['get','post'],"/notebook/{id}",[NotebookController::class,"get"]);
    Route::delete("/delete/{id}",[NotebookController::class,"delete"]);
});
