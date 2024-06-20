<?php

use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\KeyController;
use App\Http\Controllers\ReconcileController;
use App\Http\Controllers\SitesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleMovementLogsController;
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

Route::post('/get_user', [UserController::class, 'user_login']);
Route::post('/reconcile-documents', [ReconcileController::class, 'reconcileDocuments']);
Route::post('/unmatched-entries', [ReconcileController::class, 'unmatchedEntries']);