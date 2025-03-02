<?php

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('superadmin')->middleware(['auth', 'superadmin'])->group(function () {
    Route::get('/employees', 'App\Http\Controllers\SuperAdmin\EmployeeController@index')->name("superadmin.employee.index");
    Route::get('/employees/data', 'App\Http\Controllers\SuperAdmin\EmployeeController@getData')->name('superadmin.employee.data');
    Route::post('/employees/store', 'App\Http\Controllers\SuperAdmin\EmployeeController@store')->name('superadmin.employee.store');

    Route::get('/ranks', 'App\Http\Controllers\SuperAdmin\RankController@index')->name("superadmin.rank.index");
    
    Route::get('/echelons', 'App\Http\Controllers\SuperAdmin\EchelonController@index')->name("superadmin.echelon.index");
    
    Route::get('/positions', 'App\Http\Controllers\SuperAdmin\PositionController@index')->name("superadmin.position.index");
    
    Route::get('/work-places', 'App\Http\Controllers\SuperAdmin\WorkPlaceController@index')->name("superadmin.work-place.index");
    
    Route::get('/religions', 'App\Http\Controllers\SuperAdmin\ReligionController@index')->name("superadmin.religion.index");
    
    Route::get('/work-units', 'App\Http\Controllers\SuperAdmin\WorkUnitController@index')->name("superadmin.work-unit.index");
});

Route::prefix('employee')->middleware(['auth', 'employee'])->group(function () {
    Route::get('/', 'App\Http\Controllers\SuperAdmin\EmployeeController@index')->name("superadmin.employee.index");
});