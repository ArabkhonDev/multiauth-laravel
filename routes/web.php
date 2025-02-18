<?php

use App\Http\Controllers\Admin\AdminMainController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\TeacherMainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', "rolemanager:user"])->name('dashboard');

Route::middleware(['auth', 'verified', "rolemanager:teacher"])->group(function(){
    Route::controller(TeacherMainController::class)->group(function () {
        Route::prefix('teacher', function(){
            Route::get('/dashboard', 'main')->name('dashboard');
        });
    });
});


Route::middleware(['auth', 'verified', "rolemanager:admin"])->group(function(){
    Route::controller(AdminMainController::class)->group(function () {
        Route::prefix('admin', function(){
            Route::get('/dashboard', 'index')->name('dashboard');
        });
    });
});


Route::get('/admin/dashboard', function () {
    return view('admin.admin');
})->middleware(['auth', 'verified', "rolemanager:admin"])->name('admin');

Route::get('/user/dashboard', function () {
    return view('user');
})->middleware(['auth', 'verified', "rolemanager:user"])->name('user');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
