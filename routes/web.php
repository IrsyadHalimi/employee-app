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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/employees', 'App\Http\Controllers\Admin\EmployeeController@index')->name("admin.employee.index");
    Route::get('/employees/data', 'App\Http\Controllers\Admin\EmployeeController@getData')->name('admin.employee.data');
    Route::post('/employees/store', 'App\Http\Controllers\Admin\EmployeeController@store')->name('admin.employee.store');
    Route::post('/employees/update', 'App\Http\Controllers\Admin\EmployeeController@update')->name('admin.employee.update');
    Route::delete('/employees/delete', 'App\Http\Controllers\Admin\EmployeeController@destroy')->name('admin.employee.destroy');

    Route::get('/ranks', 'App\Http\Controllers\Admin\RankController@index')->name("admin.rank.index");
    Route::get('/ranks/data', 'App\Http\Controllers\Admin\RankController@getData')->name('admin.rank.data');
    Route::post('/ranks/store', 'App\Http\Controllers\Admin\RankController@store')->name('admin.rank.store');
    Route::post('/ranks/update', 'App\Http\Controllers\Admin\RankController@update')->name('admin.rank.update');
    Route::delete('/ranks/delete', 'App\Http\Controllers\Admin\RankController@destroy')->name('admin.rank.destroy');

    Route::get('/echelons', 'App\Http\Controllers\Admin\EchelonController@index')->name("admin.echelon.index");
    Route::get('/echelons/data', 'App\Http\Controllers\Admin\EchelonController@getData')->name('admin.echelon.data');
    Route::post('/echelons/store', 'App\Http\Controllers\Admin\EchelonController@store')->name('admin.echelon.store');
    Route::post('/echelons/update', 'App\Http\Controllers\Admin\EchelonController@update')->name('admin.echelon.update');
    Route::delete('/echelons/delete', 'App\Http\Controllers\Admin\EchelonController@destroy')->name('admin.echelon.destroy');

    Route::get('/positions', 'App\Http\Controllers\Admin\PositionController@index')->name("admin.position.index");
    Route::get('/positions/data', 'App\Http\Controllers\Admin\PositionController@getData')->name('admin.position.data');
    Route::post('/positions/store', 'App\Http\Controllers\Admin\PositionController@store')->name('admin.position.store');
    Route::post('/positions/update', 'App\Http\Controllers\Admin\PositionController@update')->name('admin.position.update');
    Route::delete('/positions/delete', 'App\Http\Controllers\Admin\PositionController@destroy')->name('admin.position.destroy');

    Route::get('/work-places', 'App\Http\Controllers\Admin\WorkPlaceController@index')->name("admin.work-place.index");
    Route::get('/work-places/data', 'App\Http\Controllers\Admin\WorkPlaceController@getData')->name('admin.work-place.data');
    Route::post('/work-places/store', 'App\Http\Controllers\Admin\WorkPlaceController@store')->name('admin.work-place.store');
    Route::post('/work-places/update', 'App\Http\Controllers\Admin\WorkPlaceController@update')->name('admin.work-place.update');
    Route::delete('/work-places/delete', 'App\Http\Controllers\Admin\WorkPlaceController@destroy')->name('admin.work-place.destroy');

    Route::get('/religions', 'App\Http\Controllers\Admin\ReligionController@index')->name("admin.religion.index");
    Route::get('/religions/data', 'App\Http\Controllers\Admin\ReligionController@getData')->name('admin.religion.data');
    Route::post('/religions/store', 'App\Http\Controllers\Admin\ReligionController@store')->name('admin.religion.store');
    Route::post('/religions/update', 'App\Http\Controllers\Admin\ReligionController@update')->name('admin.religion.update');
    Route::delete('/religions/delete', 'App\Http\Controllers\Admin\ReligionController@destroy')->name('admin.religion.destroy');

    Route::get('/work-units', 'App\Http\Controllers\Admin\WorkUnitController@index')->name("admin.work-unit.index");
    Route::get('/work-units/data', 'App\Http\Controllers\Admin\WorkUnitController@getData')->name('admin.work-unit.data');
    Route::post('/work-units/store', 'App\Http\Controllers\Admin\WorkUnitController@store')->name('admin.work-unit.store');
    Route::post('/work-units/update', 'App\Http\Controllers\Admin\WorkUnitController@update')->name('admin.work-unit.update');
    Route::delete('/work-units/delete', 'App\Http\Controllers\Admin\WorkUnitController@destroy')->name('admin.work-unit.destroy');
});

Route::prefix('employee')->middleware(['auth', 'employee'])->group(function () {
    Route::get('/', 'App\Http\Controllers\Admin\EmployeeController@index')->name("admin.employee.index");
});
