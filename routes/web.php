<?php

use App\Http\Controllers\DashboardController;
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
Route::get('/', [DashboardController::class,'index'])->name('home');

// Penduduk
Route::get('/penduduk', [PendudukController::class,'index'])->name('penduduk');
Route::get('/penduduk/tambah', [PendudukController::class,'create'])->name('create-penduduk');
Route::post('/penduduk', [PendudukController::class,'store'])->name('post-penduduk');
Route::post('/penduduk/tambah', [PendudukController::class, 'storeSingle'])->name('post-penduduk-single');
Route::get('/penduduk/{id}', [PendudukController::class, 'edit'])->name('edit-penduduk');
Route::put('/penduduk/{id}', [PendudukController::class, 'update'])->name('update-penduduk');
Route::delete('/penduduk/{id}', [PendudukController::class, 'delete'])->name('delete-penduduk');

// TPS
Route::get('/tps', [TpsController::class, 'index'])->name('tps');


// Login
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('post-login');

// Register
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('post-register');

Route::get('/test', [TestController::class, 'index'])->name('test');

