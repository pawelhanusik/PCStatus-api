<?php

use App\Http\Controllers\ComputerController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

static $statusesModelsControllers = [
    'notification' => NotificationController::class,
    'progress' => ProgressController::class,
    'task' => TaskController::class,
];
foreach ($statusesModelsControllers as $name => $controllerClass) {
    Route::middleware('auth:sanctum')->group(function () use ($name, $controllerClass) {
        Route::prefix($name)->group(function () use ($controllerClass) {
            Route::get('/', [$controllerClass, 'index']);
            Route::get('/{modelId}', [$controllerClass, 'show']);
            Route::post('/', [$controllerClass, 'store']);
            Route::post('/{modelId}', [$controllerClass, 'update']);
            Route::delete('/{modelId}', [$controllerClass, 'destroy']);
        });
    });
}
