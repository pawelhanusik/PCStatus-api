<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::prefix('user')->group(function () {
    Route::get('/', [UserController::class, 'show'])->middleware('auth:sanctum')->name('user.show');
    Route::post('/register', [UserController::class, 'register'])->name('user.register');
    Route::post('/login', [UserController::class, 'login'])->name('user.login');
    Route::post('/refresh', [UserController::class, 'refresh'])->middleware('auth:sanctum')->name('user.refresh');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('computer')->group(function () {
        Route::get('/', [ComputerController::class, 'index']);
        Route::get('/{computerId}', [ComputerController::class, 'show']);
        Route::post('/', [ComputerController::class, 'store']);
        Route::post('/{computerId}', [ComputerController::class, 'update']);
        Route::delete('/{computerId}', [ComputerController::class, 'destroy']);
    });
});
