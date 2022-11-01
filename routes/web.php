<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\KontakController;
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

//get
Route::middleware('auth')->group(function() {
    Route::get('/', function () {return view('admin.app');});  
    Route::get('/admin', [DashboardController::class, 'index']);
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('mastersiswa/{id_siswa}/hapus',[SiswaController::class, 'hapus'])->name('mastersiswa.hapus');
    Route::resource('/mastersiswa', SiswaController::class);
    Route::resource('/masterkontak', KontakController::class);
    Route::resource('/masterproject', ProjectController::class);
});

//guest
Route::middleware('guest')->group(function() {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate']);
});






// Route::get('/dashboard', function () {
//     return view('admin.dashboard');
// });

// Route::get('/head', function () {
//     return view('admin.head');
// });

// Route::get('/footer', function () {
//     return view('admin.footer');
// });

// Route::get('/mastersiswa', function () {
//     return view('admin.MasterSiswa');
// });

// Route::get('/masterproject', function () {
//     return view('admin.MasterProject');
// });

// Route::get('/masterkontak', function () {
//     return view('admin.MasterKontak');
// });

// Route::get('/sidebar', function () {
//     return view('admin.sidebar');
// });

// Route::get('/topbar', function () {
//     return view('admin.topbar');
// });
?>