<?php

use App\Http\Controllers\ApiNewUserController;
use App\Http\Controllers\ApiUserController;
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


Route::post('/register', [ApiUserController::class, 'register']);
Route::post('/register', [ApiUserController::class, 'register']);
Route::post('/register-new', [ApiNewUserController::class, 'register']);
Route::post('/login-new', [ApiNewUserController::class, 'login']);
Route::get('/users', [ApiNewUserController::class, 'index']);
