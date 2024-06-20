<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\VehicleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/import-drivers', function () {
    return view('import-drivers');
});
Route::post('/import-drivers',[DriverController::class, 'import']);

// Route::get('/import-vehicles', function () {
//     return view('import-drivers');
// });

// Route::post('/import-vehicles',[VehicleController::class, 'import']);

Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
