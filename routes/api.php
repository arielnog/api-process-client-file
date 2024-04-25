<?php

use App\Http\Controllers\FileControlController;
use App\Http\Controllers\HealthController;
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

Route::get('/health', [HealthController::class, 'index']);

Route::middleware(['validate.key'])->group(function () {
    Route::prefix('file')->group(function (){
        Route::get('/', [FileControlController::class,'get']);
        Route::post('/save', [FileControlController::class, 'save']);
    });
});
