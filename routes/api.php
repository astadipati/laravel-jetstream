<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\FormController;
use App\Http\Controllers\API\ScoreController;
use App\Http\Controllers\API\UploadController;
use Illuminate\Http\Request;
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
// basicnya seperti ini tapi kalau kita group jadi seperti dibawah
// Route::middleware('auth:sanctum')->get('/form',[FormController::class,'index'], function (Request $request) {
    // return $request->user();
// });

Route::group(['middleware' => 'auth:sanctum'],function(){
    // crud student
    Route::post('/create',[FormController::class, 'create']);
    Route::get('/show',[FormController::class, 'show']);
    Route::get('/edit/{id}',[FormController::class, 'edit']); // show detil
    Route::post('/edit/{id}',[FormController::class, 'update']); //update detil
    Route::get('/delete/{id}',[FormController::class, 'delete']); //delete
    // multiple relation 
    Route::post('/create-score-student',[ScoreController::class, 'create']);
    Route::get('/data-student/{id}',[ScoreController::class, 'getStudent']); //get student by id
    Route::post('/data-student/{id}',[ScoreController::class, 'update']); //get student by id

    Route::get('/logout',[AuthController::class, 'logout']);
});

Route::post('/login',[AuthController::class,'login']);
// upload gambar
Route::post('/upload',[UploadController::class,'upload']); 