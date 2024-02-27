<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KlasifikasiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TpsController;
use App\Http\Controllers\UserController;
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
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('home');

    // Penduduk
    Route::get('/penduduk', [PendudukController::class, 'index'])->name('penduduk');
    Route::get('/penduduk/cetak', [PendudukController::class, 'cetakPenduduk'])->name('cetak-penduduk');
    Route::get('/penduduk/cleaning', [PendudukController::class, 'alamatCleaning'])->name('penduduk-cleaning');
    Route::get('/penduduk/convertalamat', [PendudukController::class, 'alamatConvert'])->name('alamat-convert');
    Route::get('/penduduk/tambah', [PendudukController::class, 'create'])->name('create-penduduk');
    Route::post('/penduduk', [PendudukController::class, 'store'])->name('post-penduduk');
    Route::post('/penduduk/tambah', [PendudukController::class, 'storeSingle'])->name('post-penduduk-single');
    Route::get('/penduduk/{id}', [PendudukController::class, 'edit'])->name('edit-penduduk');
    Route::put('/penduduk/{id}', [PendudukController::class, 'update'])->name('update-penduduk');
    Route::delete('/penduduk/{id}', [PendudukController::class, 'delete'])->name('delete-penduduk');

    // Audit Penduduk
    Route::get('/audit/penduduk', [PendudukController::class, 'indexAudit'])->name('audit-penduduk');
    Route::get('/audit/all-penduduk', [PendudukController::class, 'auditAll'])->name('audit-all-penduduk');
    Route::get('/audit/penduduk/{id}', [PendudukController::class, 'auditSingle'])->name('audit-single-penduduk');

    // Audit TPS
    Route::get('/audit/tps', [TpsController::class, 'indexAudit'])->name('audit-tps');
    Route::get('/audit/all-tps', [TpsController::class, 'auditAll'])->name('audit-all-tps');
    Route::get('/audit/tps/{id}', [TpsController::class, 'auditSingle'])->name('audit-single-tps');

    // TPS
    Route::get('/tps', [TpsController::class, 'index'])->name('tps');
    Route::get('/tps/tambah', [TpsController::class, 'create'])->name('create-tps');
    Route::post('/tps', [TpsController::class, 'store'])->name('post-tps');
    Route::get('/tps/{id}', [TpsController::class, 'edit'])->name('edit-tps');
    Route::put('/tps/{id}', [TpsController::class, 'update'])->name('update-tps');
    Route::get('/tps/delete/{id}', [TpsController::class, 'destroy'])->name('delete-tps');

    // Audit TPS
    Route::get('/audit/tps', [TpsController::class, 'indexAudit'])->name('audit-tps');
    Route::get('/audit/all-tps', [TpsController::class, 'auditAll'])->name('audit-all-tps');
    Route::get('/audit/tps/{id}', [TpsController::class, 'auditSingle'])->name('audit-single-tps');

    // Klasifikasi
    Route::get('/klasifikasi', [KlasifikasiController::class, 'index'])->name('klasifikasi');
    Route::get('/klasifikasi/tambah', [KlasifikasiController::class, 'create'])->name('create-klasifikasi');
    Route::post('/klasifikasi', [KlasifikasiController::class, 'store'])->name('post-klasifikasi');
    Route::get('/klasifikasi/{id}', [KlasifikasiController::class, 'detail'])->name('detail-klasifikasi');
    Route::get('/klasifikasi/cetak/{id_proses}', [KlasifikasiController::class, 'cetakKlasifikasi'])->name('cetak-klasifikasi');
    Route::get('/klasifikasi/training/cetak/{id_proses}', [KlasifikasiController::class, 'cetakTraining'])->name('cetak-training');
    Route::post('/klasifikasi/training/{id_proses}', [KlasifikasiController::class, 'storeTraining'])->name('post-training');
    Route::get('/klasifikasi/testing/cetak/{id_proses}', [KlasifikasiController::class, 'cetakTesting'])->name('cetak-testing');
    Route::post('/klasifikasi/testing/{id_proses}', [KlasifikasiController::class, 'storeTesting'])->name('post-testing');
    Route::delete('/klasifikasi/{id}', [KlasifikasiController::class, 'destroy'])->name('delete-klasifikasi');
    Route::delete('/klasifikasi/training/{id}', [KlasifikasiController::class, 'destroyTraining'])->name('delete-training');
    Route::delete('/klasifikasi/testing/{id}', [KlasifikasiController::class, 'destroyTesting'])->name('delete-testing');
    Route::get('/audit/all-klasifikasi/{id_proses}', [KlasifikasiController::class, 'auditAll'])->name('audit-all-klasifikasi');
    Route::get('/audit/klasifikasi/{id}', [KlasifikasiController::class, 'detailAudit'])->name('detail-audit-klasifikasi');
    Route::get('/audit/penduduk/{id}/{prediksi}', [KlasifikasiController::class, 'auditSingle'])->name('audit-prediksi-penduduk');

    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/users/tambah', [UserController::class, 'create'])->name('create-users');
    Route::post('/users', [UserController::class, 'store'])->name('post-users');
    Route::get('/users/{id}', [UserController::class, 'edit'])->name('edit-users');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('update-users');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('delete-users');


    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('post-register');
    // Klasifikasi Prediksi
    Route::post('/klasifikasi/prediksi/{id_proses}', [KlasifikasiController::class, 'prediksi'])->name('post-prediksi');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});


Route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('post-login');

    // Register


    Route::get('/test', [TestController::class, 'index'])->name('test');

});

