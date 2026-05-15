<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SoldierController;
use App\Http\Controllers\ArmyCorpController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\QuaterController;
use App\Http\Controllers\CompanyController;

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
Route::apiResource('soldiers', SoldierController::class);
Route::apiResource('army_corp', ArmyCorpController::class);
Route::apiResource('service', ServiceController::class);
Route::apiResource('quater', QuaterController::class);
Route::apiResource('company', CompanyController::class);
