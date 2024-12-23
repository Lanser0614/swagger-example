<?php

use App\DTOs\User\ResponseUserDto;
use App\DTOs\User\StoreUserDto;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
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

Route::get('/', function () {

    $reflectionDto = new ReflectionClass(StoreUserDto::class);
    $reflectionRequest = new ReflectionClass(StoreUserRequest::class);
    $reflectionResource = new ReflectionClass(UserResource::class);
    $reflectionResourceDto = new ReflectionClass(ResponseUserDto::class);
    dd($reflectionRequest->newInstanceWithoutConstructor()->rules(), $reflectionResource->newInstanceWithoutConstructor(), $reflectionResourceDto->getProperties());

    return view('welcome');
});
