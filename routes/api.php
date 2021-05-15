<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StaffController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/staffs', [StaffController::class, 'index']);
Route::get('/staff/{id}', [StaffController::class, 'getById']);
Route::post('/staff', [StaffController::class, 'store']);
Route::put('/staff/{id}', [StaffController::class, 'update']);
Route::delete('/staff/{id}', [StaffController::class, 'destroy']);
