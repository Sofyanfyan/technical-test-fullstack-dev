<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UpdateController;
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

    return view('dashboard');
});
Route::resource('position',PositionController::class);
Route::resource('employee',EmployeeController::class);
Route::put('/update/employee/{id}', [UpdateController::class, 'put'])->name('employee.update.field');