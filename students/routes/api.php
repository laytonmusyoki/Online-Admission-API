<?php

use App\Http\Controllers\StudentsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/students',[StudentsController::class,'students']);
Route::post('/add',[StudentsController::class,'add']);
Route::get('/student/{id}',[StudentsController::class,'student']);
Route::get('/edit/{id}',[StudentsController::class,'edit']);
Route::put('/update/{id}',[StudentsController::class,'update']);
Route::delete('/delete/{id}',[StudentsController::class,'delete']);