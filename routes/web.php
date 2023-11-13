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

Route::get('/login', [\App\Http\Controllers\AuthController::class, 'index'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'authenticate'])->name('login');

Route::group(['middleware' => 'jwt.validate'], function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('home');
    Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

    Route::group(['prefix' => 'karyawan'], function () {
        Route::get('/', [\App\Http\Controllers\KaryawanController::class, 'index'])->name('karyawan.index');
        Route::get('new', [\App\Http\Controllers\KaryawanController::class, 'new'])->name('karyawan.new');
        Route::get('edit/{nik}', [\App\Http\Controllers\KaryawanController::class, 'edit'])->name('karyawan.edit');
        
        Route::post('create', [\App\Http\Controllers\KaryawanController::class, 'create'])->name('karyawan.create');
        Route::post('update', [\App\Http\Controllers\KaryawanController::class, 'update'])->name('karyawan.update');
        Route::delete('delete', [\App\Http\Controllers\KaryawanController::class, 'delete'])->name('karyawan.delete');
        
        Route::get('{nik}/view/{kode}', [\App\Http\Controllers\BerkasKaryawanController::class, 'view'])->name('berkas_karyawan.view');
        
        Route::group(['prefix' => 'berkas'], function () {
            Route::get('/', [\App\Http\Controllers\BerkasKaryawanController::class, 'index'])->name('berkas_karyawan.index');
        });
    });

});
