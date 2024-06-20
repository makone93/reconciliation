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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/get_user', [UserController::class, 'user_login']);
Route::post('/reconcile-documents', [ReconcileController::class, 'reconcileDocuments']);
Route::post('/unmatched-entries', [ReconcileController::class, 'unmatchedEntries']);
// Route::get('/getBookingsPage', [BookingsController::class, 'paginatedResult']);
// Route::post('/vehicle-movememt-logs', [VehicleMovementLogsController::class, 'totalRecords']);
// Route::get('/peek-vehicle-movement', [VehicleMovementLogsController::class, 'totalRecords']);
// Route::post('/get-vehicle', [VehicleController::class, 'getVehicle']);
// Route::post('/get-driver', [DriverController::class, 'getDriver']);
// Route::get('/all-sites', [SitesController::class, 'allSites']);
// Route::put('/vehicle-movement-log/:movement_id', [VehicleMovementLogsController::class, 'update']);

// Route::post('/import-drivers', [DriverController::class, 'import']);
// Route::post('/import-vehicles', [VehicleController::class, 'import']);
// Route::post('/import-keys', [KeyController::class, 'import']);


// Route::resources(
//     [
//         'sites' => SitesController::class,
//         'departments' => DepartmentsController::class,
//         'vehicle' => VehicleController::class,
//         'driver' => DriverController::class,
//         'vehicle-movement-log' => VehicleMovementLogsController::class,
//     ],
// );
