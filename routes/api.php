<?php

use App\Http\Controllers\NfeController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    try{
        return $request->user();
    }catch(Exception $e) {
        return response()->json([
            'message' => 'Internal error',
            'error' => $e->getMessage()
        ], 500);
    }
});

Route::controller(UserController::class)->group(function () {
    Route::post('/auth/register', 'createUser');
    Route::post('/auth/login', 'loginUser');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::resource('nfe', NfeController::class);
});

