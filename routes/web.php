<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TpsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

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

//pages

// dashboard
Route::get('/', [DashboardController::class, 'index'])->name('home');

// Penduduk
Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk');
Route::get('/penduduk/cleaning', [PendudukController::class, 'alamatCleaning'])->name('penduduk-cleaning');
Route::get('/penduduk/convertalamat', [PendudukController::class, 'alamatConvert'])->name('alamat-convert');
Route::get('/penduduk/tambah', [PendudukController::class, 'create'])->name('create-penduduk');
Route::post('/penduduk', [PendudukController::class, 'store'])->name('post-penduduk');
Route::post('/penduduk/tambah', [PendudukController::class, 'storeSingle'])->name('post-penduduk-single');
Route::get('/penduduk/{id}', [PendudukController::class, 'edit'])->name('edit-penduduk');
Route::put('/penduduk/{id}', [PendudukController::class, 'update'])->name('update-penduduk');
Route::delete('/penduduk/{id}', [PendudukController::class, 'delete'])->name('delete-penduduk');

// TPS
Route::get('/tps', [TpsController::class, 'index'])->name('tps');
Route::get('/tps/tambah', [TpsController::class, 'create'])->name('create-tps');
Route::post('/tps', [TpsController::class, 'store'])->name('post-tps');
Route::get('/tps/{id}', [TpsController::class, 'edit'])->name('edit-tps');
Route::put('/tps/{id}', [TpsController::class, 'update'])->name('update-tps');
Route::get('/tps/delete/{id}', [TpsController::class, 'destroy'])->name('delete-tps');


// Klasifikasi
Route::get('/klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi');
Route::get('/klasifikasi/tambah', [KlasifikasiController::class, 'create'])->name('create-klasifikasi');
Route::post('/klasifikasi', [KlasifikasiController::class, 'store'])->name('post-klasifikasi');
Route::get('/klasifikasi/{id}', [KlasifikasiController::class, 'detail'])->name('detail-klasifikasi');
Route::post('/klasifikasi/training/{id_proses}', [KlasifikasiController::class, 'storeTraining'])->name('post-training');
Route::post('/klasifikasi/testing/{id_proses}', [KlasifikasiController::class, 'storeTesting'])->name('post-testing');
Route::delete('/klasifikasi/{id}', [KlasifikasiController::class, 'destroy'])->name('delete-klasifikasi');
Route::delete('/klasifikasi/training/{id}', [KlasifikasiController::class, 'destroyTraining'])->name('delete-training');
Route::delete('/klasifikasi/testing/{id}', [KlasifikasiController::class, 'destroyTesting'])->name('delete-testing');

// Klasifikasi Prediksi
Route::post('/klasifikasi/prediksi/{id_proses}', [KlasifikasiController::class, 'prediksi'])->name('post-prediksi');

// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('post-login');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('post-register');

Route::get('/test', [TestController::class, 'index'])->name('test');

