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

Route::group(['middleware'    => 'auth'], function () {

    Route::group(['middleware' => 'userRole'], function () {
        Route::get('/admin', function () {
            return redirect('/admin/dashboard');
        });
        Route::prefix('/admin')->name('admin.')->group(function () {
            Route::get('karyawan/create-admin', 'KaryawanController@createAdmin')->name('karyawan.create-admin');
            Route::get('persebaranPelanggan', 'AdminDashboard@persebaranPelanggan');
            Route::resource('dashboard', 'AdminDashboard');
            Route::resource('wilayah', 'WilayahController');
            Route::resource('karyawan', 'KaryawanController');
            Route::resource('pelanggan', 'PelangganController');
            Route::get('/pelanggan/grafikAngkaMeter/{id}', 'PelangganController@grafikAngkaMeter');
            Route::post('wilayah/filter', 'WilayahController@filter')->name('wilayah.filter');
            Route::post('wilayah/kelurahanCek', 'KaryawanController@kelurahanCek');
        });
    });

    Route::get('/', function () {
        return redirect('/karyawan');
    });

    Route::get('/karyawan', function () {
        return redirect('/karyawan/catat-meter/create');
    });
    Route::prefix('/karyawan')->name('karyawan.')->group(function () {
        Route::resource('catat-meter', 'CatatMeterKaryawan');
        Route::resource('pelanggan', 'PelangganKaryawanController');
        Route::resource('setting', 'SettingKaryawanController');
        Route::get('/pelanggan/grafikAngkaMeter/{id}', 'PelangganKaryawanController@grafikAngkaMeter');
    });
});

Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
