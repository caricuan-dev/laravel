<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPermissionController;
use App\Http\Controllers\Admin\AdminRolesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogoutController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\SistemInfoController;
use App\Http\Controllers\Admin\StatusController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserPermissionsController;
use App\Http\Controllers\Admin\UserRolesController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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
    return view('welcome');
});

Auth::routes(['verify' => true]);

Route::prefix('user')->name('user.')->group(function () {
    Route::middleware(['auth', 'verified'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'user'])->name('dashboard');
    });
});


Route::middleware(['guest:admin'])->group(function () {
    Route::get('/bitverse/admin123', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/bitverse/admin123', [LoginController::class, 'check'])->name('admin.check');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/dashboard', [HomeController::class, 'admin'])->name('dashboard');

        Route::get('/sistem/status', [StatusController::class, 'index'])->name('status.index');
        Route::post('/sistem/status/store', [StatusController::class, 'store'])->name('status.store');
        Route::get('/sistem/status/{id}/edit', [StatusController::class, 'edit'])->name('status.edit');
        Route::post('/sistem/status/update/{id}', [StatusController::class, 'update'])->name('status.update');
        Route::post('/sistem/status/destroy/{id}', [StatusController::class, 'destroy'])->name('status.destroy');

        Route::get('/navigasi', [MenuController::class, 'index'])->name('navigasi.index');
        Route::post('/navigasi/store', [MenuController::class, 'store'])->name('navigasi.store');
        Route::get('/navigasi/{id}/edit', [MenuController::class, 'edit'])->name('navigasi.edit');
        Route::post('/navigasi/update/{id}', [MenuController::class, 'update'])->name('navigasi.update');
        Route::post('/navigasi/destroy/{id}', [MenuController::class, 'destroy'])->name('navigasi.destroy');
        Route::resource('/sistem/info', SistemInfoController::class);
        Route::resource('/admin/admin-list', AdminController::class);
        Route::resource('/admin/admin-role', AdminRolesController::class);
        Route::resource('/admin/admin-permission', AdminPermissionController::class);
        Route::resource('/user/user-list', UserController::class);
        Route::resource('/user/user-role', UserRolesController::class);
        Route::resource('/user/user-permission', UserPermissionsController::class);
        Route::get('/sistem/wilayah/kecamatan', [AdminController::class, 'index'])->name('wilayah.kecamatan.index');

        Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');


    });
});