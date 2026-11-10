<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\ModelShowroomController;
use Illuminate\Support\Facades\Route;

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

// ─── Customer Routes ─────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');

// ─── Admin Authentication ────────────────────────────────────────
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);
Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

// ─── Admin Protected Routes ─────────────────────────────────────
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [ModelShowroomController::class, 'dashboard'])->name('dashboard');

    // Model Showroom CRUD
    Route::resource('models', ModelShowroomController::class)->except(['show'])->parameters([
        'models' => 'model',
    ]);
});
