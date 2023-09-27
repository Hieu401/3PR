<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoalController;
use App\Http\Controllers\ProgressionSetPlanController;
use App\Http\Middleware\Authorize;

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
Route::middleware([Authorize::class])->group(function () {

    Route::controller(GoalController::class)->group(function () {
        Route::post('/goals', 'create');
        Route::post('/goals/{uuid}', 'edit');
        Route::get('/goals', 'overview');
        Route::get('/goals/{uuid}', 'details');
        Route::delete('/goals/{uuid}', 'delete');
    });
    
    Route::controller(ProgressionSetPlanController::class)->group(function () {
        Route::post('/progressionplan', 'create');
        Route::post('/progressionplan/{uuid}', 'edit');
        Route::get('/progressionplan/{goal_uuid}', 'overview');
        Route::delete('/progressionplan/{uuid}', 'delete');
    });

});

