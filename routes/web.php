<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Admin\AirlineController;
use App\Http\Controllers\Admin\FlightController;
use App\Models\Flight;
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
    return view('welcome');
});

Route::resource('cars', CarController::class);
Route::resource('devices', DeviceController::class);
Route::resource('products', ProductController::class);
Route::resource('students', StudentController::class);

Route::prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('airlines/create', [AirlineController::class, 'create'])->name('airlines.create');
        Route::post('airlines/store', [AirlineController::class, 'store'])->name('airlines.store');
        Route::get('airlines/{airline}', [AirlineController::class, 'show'])->name('airlines.show');
        Route::get('airlines/{id}/edit', [AirlineController::class, 'edit'])->name('airlines.edit');
        Route::put('airlines/{id}', [AirlineController::class, 'update'])->name('airlines.update');
        Route::delete('airlines/{id}', [AirlineController::class, 'delete'])->name('airlines.delete');
        Route::post('airlines/deleteMany', [AirlineController::class, 'deleteMany'])->name('airlines.deleteMany');
        Route::get('airlines/{airline}/edit', [AirlineController::class, 'edit'])->name('airlines.edit');
        Route::put('airlines/{airline}', [AirlineController::class, 'update'])->name('airlines.update');
        Route::delete('airlines/{airline}', [AirlineController::class, 'delete'])->name('airlines.delete');

        Route::resource('flights', FlightController::class);
    });

