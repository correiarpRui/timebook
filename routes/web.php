<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;


Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('auth.authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile/{id}', [ProfileController::class, 'patch'])->name('profile.patch');
    Route::patch('/profile/password/{id}', [ProfileController::class, 'patch_password'])->name('profile.patch.password');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/users', [UserController::class, 'index'])->name('users');
    Route::get('/user/create', [UserController::class, 'create']);
    Route::post('/user', [UserController::class, 'store']);
    Route::get('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::patch('/user/{id}', [UserController::class, 'patch'])->name('user.patch');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');
    Route::get('/schedule/create', [ScheduleController::class, 'create']);
    Route::post('/schedule', [ScheduleController::class, 'store']);
    Route::get('/schedule/update/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::patch('/schedule/{id}', [ScheduleController::class, 'patch'])->name('schedule.patch');
    Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/record', [RecordController::class, 'index'])->name('records');
    Route::get('/record/create', [RecordController::class, 'create']);
    Route::post('/record', [RecordController::class, 'store']);
    Route::get('/record/update/{id}', [RecordController::class, 'update'])->name('record.update');
    Route::patch('/record/{id}', [RecordController::class, 'patch'])->name('record.patch');
    Route::delete('/record/{id}', [RecordController::class, 'destroy'])->name('record.destroy');
    Route::get('/record/show/{id}', [RecordController::class, 'show'])->name('record.show');
    Route::post('/record/upload/{id}', [RecordController::class, 'store_file'])->name('record.store.file');
    Route::post('record/notes/{id}', [RecordController::class, 'store_notes'])->name('record.store.notes');
});

Route::group(['middleware'=>'auth'], function(){
    Route::get('/calendar/{year}', [CalendarController::class, 'index'])->name('calendar');
});
