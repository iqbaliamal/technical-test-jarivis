<?php

use App\Http\Controllers\AlokasiWaktuController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JadwalPendidikController;
use App\Http\Controllers\JenisMataPelajaranController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KompetensiDasarController;
use App\Http\Controllers\KompetensiDasarDetailController;
use App\Http\Controllers\KompetensiDasarPointController;
use App\Http\Controllers\MataPelajaranController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenilaianSilabusController;
use App\Http\Controllers\PertemuanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RppController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SilabusController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::get('/user-profile', [AuthController::class, 'userProfile'])->name('user-profile');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'user'
], function ($router) {
    Route::get('/list', [UserController::class, 'list'])->name('list-user');
    Route::get('/detail/{id}', [UserController::class, 'detail'])->name('detail-user');
    Route::post('/store', [UserController::class, 'store'])->name('store-user');
    Route::put('/update/{id}', [UserController::class, 'update'])->name('update-user');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete-user');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'role'
], function ($router) {
    Route::get('/list', [RoleController::class, 'list'])->name('list-role');
    Route::get('/detail/{id}', [RoleController::class, 'detail'])->name('detail-role');
    Route::post('/store', [RoleController::class, 'store'])->name('store-role');
    Route::put('/update/{id}', [RoleController::class, 'update'])->name('update-role');
    Route::delete('/delete/{id}', [RoleController::class, 'destroy'])->name('delete-role');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'data-user'
], function ($router) {
    Route::get('/list', [DataUserController::class, 'list'])->name('list-data-user');
    Route::get('/detail/{id}', [DataUserController::class, 'detail'])->name('detail-data-user');
    Route::post('/store', [DataUserController::class, 'store'])->name('store-data-user');
    Route::put('/update/{id}', [DataUserController::class, 'update'])->name('update-data-user');
    Route::delete('/delete/{id}', [DataUserController::class, 'destroy'])->name('delete-data-user');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'sekolah'
], function ($router) {
    Route::get('/list', [SekolahController::class, 'list'])->name('list-sekolah');
    Route::get('/detail/{id}', [SekolahController::class, 'detail'])->name('detail-sekolah');
    Route::post('/store', [SekolahController::class, 'store'])->name('store-sekolah');
    Route::put('/update/{id}', [SekolahController::class, 'update'])->name('update-sekolah');
    Route::delete('/delete/{id}', [SekolahController::class, 'destroy'])->name('delete-sekolah');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'jenis-mata-pelajaran'
], function ($router) {
    Route::get('/list', [JenisMataPelajaranController::class, 'list'])->name('list-jenis-mata-pelajaran');
    Route::get('/detail/{id}', [JenisMataPelajaranController::class, 'detail'])->name('detail-jenis-mata-pelajaran');
    Route::post('/store', [JenisMataPelajaranController::class, 'store'])->name('store-jenis-mata-pelajaran');
    Route::put('/update/{id}', [JenisMataPelajaranController::class, 'update'])->name('update-jenis-mata-pelajaran');
    Route::delete('/delete/{id}', [JenisMataPelajaranController::class, 'destroy'])->name('delete-jenis-mata-pelajaran');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'mata-pelajaran'
], function ($router) {
    Route::get('/list', [MataPelajaranController::class, 'list'])->name('list-mata-pelajaran');
    Route::get('/detail/{id}', [MataPelajaranController::class, 'detail'])->name('detail-mata-pelajaran');
    Route::post('/store', [MataPelajaranController::class, 'store'])->name('store-de-mata-pelajaran');
    Route::put('/update/{id}', [MataPelajaranController::class, 'update'])->name('update-mata-pelajaran');
    Route::delete('/delete/{id}', [MataPelajaranController::class, 'destroy'])->name('delete-mata-pelajaran');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'kelas'
], function ($router) {
    Route::get('/list', [KelasController::class, 'list'])->name('list-kelas');
    Route::get('/detail/{id}', [KelasController::class, 'detail'])->name('detail-kelas');
    Route::post('/store', [KelasController::class, 'store'])->name('store-kelas');
    Route::put('/update/{id}', [KelasController::class, 'update'])->name('update-kelas');
    Route::delete('/delete/{id}', [KelasController::class, 'destroy'])->name('delete-kelas');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'pertemuan'
], function ($router) {
    Route::get('/list', [PertemuanController::class, 'list'])->name('list-pertemuan');
    Route::get('/detail/{id}', [PertemuanController::class, 'detail'])->name('detail-pertemuan');
    Route::post('/store', [PertemuanController::class, 'store'])->name('store-pertemuan');
    Route::put('/update/{id}', [PertemuanController::class, 'update'])->name('update-pertemuan');
    Route::delete('/delete/{id}', [PertemuanController::class, 'destroy'])->name('delete-pertemuan');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'alokasi-waktu'
], function ($router) {
    Route::get('/list', [AlokasiWaktuController::class, 'list'])->name('list-alokasi-waktu');
    Route::get('/detail/{id}', [AlokasiWaktuController::class, 'detail'])->name('detail-alokasi-waktu');
    Route::post('/store', [AlokasiWaktuController::class, 'store'])->name('store-alokasi-waktu');
    Route::put('/update/{id}', [AlokasiWaktuController::class, 'update'])->name('update-alokasi-waktu');
    Route::delete('/delete/{id}', [AlokasiWaktuController::class, 'destroy'])->name('delete-alokasi-waktu');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'penilaian'
], function ($router) {
    Route::get('/list', [PenilaianController::class, 'list'])->name('list-penilaian');
    Route::get('/detail/{id}', [PenilaianController::class, 'detail'])->name('detail-penilaian');
    Route::post('/store', [PenilaianController::class, 'store'])->name('store-penilaian');
    Route::put('/update/{id}', [PenilaianController::class, 'update'])->name('update-penilaian');
    Route::delete('/delete/{id}', [PenilaianController::class, 'destroy'])->name('delete-penilaian');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'rpp'
], function ($router) {
    Route::get('/list', [RppController::class, 'list'])->name('list-rpp');
    Route::get('/detail/{id}', [RppController::class, 'detail'])->name('detail-rpp');
    Route::post('/store', [RppController::class, 'store'])->name('store-rpp');
    Route::put('/update/{id}', [RppController::class, 'update'])->name('update-rpp');
    Route::delete('/delete/{id}', [RppController::class, 'destroy'])->name('delete-rpp');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'jadwal-pendidik'
], function ($router) {
    Route::get('/list', [JadwalPendidikController::class, 'list'])->name('list-jadwal-pendidik');
    Route::get('/detail/{id}', [JadwalPendidikController::class, 'detail'])->name('detail-jadwal-pendidik');
    Route::post('/store', [JadwalPendidikController::class, 'store'])->name('store-jadwal-pendidik');
    Route::put('/update/{id}', [JadwalPendidikController::class, 'update'])->name('update-jadwal-pendidik');
    Route::delete('/delete/{id}', [JadwalPendidikController::class, 'destroy'])->name('delete-jadwal-pendidik');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'silabus'
], function ($router) {
    Route::get('/list', [SilabusController::class, 'list'])->name('list-silabus');
    Route::get('/detail/{id}', [SilabusController::class, 'detail'])->name('detail-silabus');
    Route::post('/store', [SilabusController::class, 'store'])->name('store-silabus');
    Route::put('/update/{id}', [SilabusController::class, 'update'])->name('update-silabus');
    Route::delete('/delete/{id}', [SilabusController::class, 'destroy'])->name('delete-silabus');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'kompetensi-dasar'
], function ($router) {
    Route::get('/list', [KompetensiDasarController::class, 'list'])->name('list-kompetensi-dasar');
    Route::get('/detail/{id}', [KompetensiDasarController::class, 'detail'])->name('detail-kompetensi-dasar');
    Route::post('/store', [KompetensiDasarController::class, 'store'])->name('store-kompetensi-dasar');
    Route::put('/update/{id}', [KompetensiDasarController::class, 'update'])->name('update-kompetensi-dasar');
    Route::delete('/delete/{id}', [KompetensiDasarController::class, 'destroy'])->name('delete-kompetensi-dasar');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'kompetensi-dasar-detail'
], function ($router) {
    Route::get('/list', [KompetensiDasarDetailController::class, 'list'])->name('list-kompetensi-dasar-detail');
    Route::get('/detail/{id}', [KompetensiDasarDetailController::class, 'detail'])->name('detail-kompetensi-dasar-detail');
    Route::post('/store', [KompetensiDasarDetailController::class, 'store'])->name('store-kompetensi-dasar-detail');
    Route::put('/update/{id}', [KompetensiDasarDetailController::class, 'update'])->name('update-kompetensi-dasar-detail');
    Route::delete('/delete/{id}', [KompetensiDasarDetailController::class, 'destroy'])->name('delete-kompetensi-dasar-detail');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'kompetensi-dasar-point'
], function ($router) {
    Route::get('/list', [KompetensiDasarPointController::class, 'list'])->name('list-kompetensi-dasar-point');
    Route::get('/detail/{id}', [KompetensiDasarPointController::class, 'detail'])->name('detail-kompetensi-dasar-point');
    Route::post('/store', [KompetensiDasarPointController::class, 'store'])->name('store-kompetensi-dasar-point');
    Route::put('/update/{id}', [KompetensiDasarPointController::class, 'update'])->name('update-kompetensi-dasar-point');
    Route::delete('/delete/{id}', [KompetensiDasarPointController::class, 'destroy'])->name('delete-kompetensi-dasar-point');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'penilaian-silabus'
], function ($router) {
    Route::get('/list', [PenilaianSilabusController::class, 'list'])->name('list-penilaian-silabus');
    Route::get('/detail/{id}', [PenilaianSilabusController::class, 'detail'])->name('detail-penilaian-silabus');
    Route::post('/store', [PenilaianSilabusController::class, 'store'])->name('store-penilaian-silabus');
    Route::put('/update/{id}', [PenilaianSilabusController::class, 'update'])->name('update-penilaian-silabus');
    Route::delete('/delete/{id}', [PenilaianSilabusController::class, 'destroy'])->name('delete-penilaian-silabus');
});

Route::middleware('auth:api')
    ->get('/murid-terbanyak', [HomeController::class, 'muridTerbanyak'])
    ->name('murid-terbanyak');

Route::middleware('auth:api')
    ->get('/jadwal-pendidik-terbanyak', [HomeController::class, 'jadwalPendidikTerbanyak'])
    ->name('jadwal-pendidik-terbanyak');
