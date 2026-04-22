<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\kompasTVController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\MitraController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\RABController;
use App\Http\Controllers\RecommendController;
use App\Http\Controllers\SocialController;
use Illuminate\Support\Facades\Route;

Route::prefix('/')->group(function (){
    Route::get('/', [PageController::class, 'beranda'])->name('rumahgue');
    Route::get('/jasa-kami', [PageController::class, 'jasa'])->name('jasa');
    Route::get('/jasa-kami/{id}', [PageController::class, 'jasaDetail'])->name('jasa-detail');

    Route::get('/hasil', [PageController::class, 'hasil'])->name('hasil-rekomendasi');
    Route::post('/send-rab', [EmailController::class, 'send'])->name('send-rab');
    Route::post('/getRecommend', [RecommendController::class, 'getRecommend'])->name('get-recommend');
    Route::post('/getRab', [RABController::class, 'getRAB'])->name('get-rab');
    Route::post('/preview-rab', [EmailController::class,'previewPDF'])->name('preview-rab');

    Route::get('/pengaturan-user', [PageController::class, 'pengaturan'])->name('pengaturan');
    Route::post('/update-user', [PageController::class, 'pengaturanUpdate'])->name('pengaturan-update');
    Route::post('/verif-user', [PageController::class, 'pengaturanVerif'])->name('pengaturan-verif');
    Route::get('/notifikasi', [MitraController::class, 'notifikasi'])->name('notifikasi');
    Route::post('/notif-read', [MitraController::class, 'notifRead'])->name('notifikasi-read');
    Route::post('/notif-create', [MitraController::class, 'notifCreate'])->name('notifikasi-create');

    Route::get('/berita-gue', [kompasTVController::class, 'index'])->name('berita-gue');
    Route::get('/api/wilayah/{level}/{code?}', [AdminController::class, 'getWilayah'])->name('api-wilayah');
});
Route::get('/pengaturan', [PageController::class, 'mitraSettings'])->name('mitra-settings');

Route::prefix('mitra')->group(function(){
    Route::get('/', [PageController::class, 'mitraHome'])->name('mitra-home');
    Route::post('/change-password', [MitraController::class, 'changePassword'])->name('mitra-change-password');
    Route::post('/new-password', [MitraController::class, 'newPassword'])->name('mitra-new-password');
    Route::put('/update-profile', [MitraController::class, 'updateMitra'])->name('mitra-update-profile');
    Route::get('/portofolio', [PageController::class, 'mitraPortfolio'])->name('mitra-portfolio');
    Route::post('/add-portofolio', [MitraController::class, 'add'])->name('mitra-add-portfolio');
    Route::put('/edit-portofolio', [MitraController::class, 'edit'])->name('mitra-edit-portfolio');
    Route::delete('/delete-portofolio', [MitraController::class, 'delete'])->name('mitra-delete-portfolio');

    Route::resource('/promo', PromoController::class);
});

Route::prefix('admin')->middleware(['auth'])->group(function(){
    Route::get('/', [PageController::class, 'adminUser'])->name('admin-user');
    Route::put('/edit-user/{id}', [AdminController::class, 'editUser'])->name('admin-edit-user');
    Route::delete('/hapus-user/{id}', [AdminController::class, 'hapusUser'])->name('admin-hapus-user');
    Route::post('/tambah-user', [AdminController::class, 'tambahUser'])->name('admin-tambah-user');
    Route::get('/admin-mitra', [PageController::class, 'adminMitra'])->name('admin-mitra');
    Route::post('/tambah-mitra', [AdminController::class, 'tambahMitra'])->name('admin-tambah-mitra');
    Route::put('/edit-mitra/{id}', [AdminController::class, 'editMitra'])->name('admin-edit-mitra');
    Route::delete('/hapus-mitra/{id}', [AdminController::class, 'hapusMitra'])->name('admin-hapus-mitra');

    Route::get('/material', [MaterialController::class, 'index'])->name('admin-material');
    Route::put('/update-material/{id}', [MaterialController::class, 'update'])->name('admin-update-material');
});

Route::prefix('login')->group(function (){
    Route::get('/', [AuthController::class, 'loginPage'])->name('login');
    Route::post('/verify', [AuthController::class, 'login'])->name('verify');
    Route::post('/request-otp', [AuthController::class, 'requestOTP'])->name('request-otp');
    Route::post('/verify-otp', [AuthController::class, 'verifyRegister'])->name('verify-otp');
    Route::get('/auth/google', [SocialController::class, 'redirect'])->name('redirect');
    });
Route::get('/api/login/handle/google', [SocialController::class, 'callback'])->name('callback');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
