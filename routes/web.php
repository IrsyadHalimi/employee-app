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

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/employees', 'App\Http\Controllers\Admin\EmployeeController@index')->name("admin.employee.index");
    Route::get('/employees/data', 'App\Http\Controllers\Admin\EmployeeController@getData')->name('admin.employee.data');
    Route::post('/employees/store', 'App\Http\Controllers\Admin\EmployeeController@store')->name('admin.employee.store');

    Route::get('/ranks', 'App\Http\Controllers\Admin\RankController@index')->name("admin.rank.index");
    
    Route::get('/echelons', 'App\Http\Controllers\Admin\EchelonController@index')->name("admin.echelon.index");
    
    Route::get('/positions', 'App\Http\Controllers\Admin\PositionController@index')->name("admin.position.index");
    
    Route::get('/work-places', 'App\Http\Controllers\Admin\WorkPlaceController@index')->name("admin.work-place.index");
    
    Route::get('/religions', 'App\Http\Controllers\Admin\ReligionController@index')->name("admin.religion.index");
    
    Route::get('/work-units', 'App\Http\Controllers\Admin\WorkUnitController@index')->name("admin.work-unit.index");
});

Route::prefix('employee')->middleware(['auth', 'employee'])->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin\EmployeeController@index')->name("admin.employee.index");
});