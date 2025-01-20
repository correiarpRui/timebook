<?php

use App\Http\Controllers\RecordController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MonthCalendarController;
use App\Http\Controllers\PlannerController;
use App\Http\Controllers\SchedulePlannerController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsSuperAdmin;

Route::get('/', [AuthController::class, 'show'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('authenticate');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware'=>'auth'], function(){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

// Route::group(['middleware'=>'auth'], function(){
    
//     Route::patch('/profile/{id}', [ProfileController::class, 'patch'])->name('profile.patch');
//     Route::patch('/profile/password/{id}', [ProfileController::class, 'patch_password'])->name('profile.patch.password');
// });

// Route::group(['middleware'=>'auth'], function(){
    // Route::get('/users', [UserController::class, 'index'])->name('users');
    // Route::get('/user/create', [UserController::class, 'create'])->name('user.create');    
    // Route::post('/user', [UserController::class, 'store'])->name('user.store');
    // Route::get('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    // Route::patch('/user/{id}', [UserController::class, 'patch'])->name('user.patch');
    // Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
// });

// Route::group(['middleware'=>'auth'], function(){
//     Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules');
//     Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
//     Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
//     Route::get('/schedule/update/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
//     Route::patch('/schedule/{id}', [ScheduleController::class, 'patch'])->name('schedule.patch');
//     Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
// });

// Route::group(['middleware'=>'auth'], function(){
//     Route::get('/schedule/planner/{year}/{month}', [SchedulePlannerController::class, 'index'])->name('schedule.planner');
//     Route::post('/schedule/planner', [PlannerController::class, 'store'])->name('schedule.planner.store');
// });

Route::group(['middleware'=>'auth'], function(){
    // Route::get('/record', [RecordController::class, 'index'])->name('records');
    // Route::get('/record/create', [RecordController::class, 'create'])->name('record.create');
    Route::post('/record', [RecordController::class, 'store']);
    Route::get('/record/update/{id}', [RecordController::class, 'update'])->name('record.update');
    Route::patch('/record/{id}', [RecordController::class, 'patch'])->name('record.patch');
    Route::delete('/record/{id}', [RecordController::class, 'destroy'])->name('record.destroy');
    Route::get('/record/show/{id}', [RecordController::class, 'show'])->name('record.show');
    Route::post('/record/upload/{id}', [RecordController::class, 'store_file'])->name('record.store.file');
    Route::post('record/notes/{id}', [RecordController::class, 'store_notes'])->name('record.store.notes');
});

Route::group(['middleware'=>'auth'], function(){
    // Route::get('/calendar/{year}', [CalendarController::class, 'index'])->name('calendar.year');
    // Route::post('/calendar/{year}', [CalendarController::class, 'store'])->name('calendar.store');
    Route::get('/calendar/{year}/generate_holiday', [CalendarController::class, 'generate_holiday'])->name('calendar.generate');
});

// Route::group(['middleware'=>'auth'], function(){
//     Route::get('/calendar/{year}/month/{month}', [MonthCalendarController::class, 'index'])->name('calendar.month');
// });

// Route::group(['middleware'=>'auth'], function(){
//     Route::get('/calendar/vacation/{year}', [EventController::class, 'index'])->name('calendar.vacation');
//     Route::patch('/calendar/vacation/approve/{event}', [EventController::class, 'approve'])->name('calendar.vacation.approve');
//     Route::delete('/calendar/vacation/{event}', [EventController::class, 'destroy'])->name('calendar.vacation.destroy');
//     Route::get('/calendar/vacation/update/{event}', [EventController::class, 'update'])->name('calendar.vacation.update');
//     Route::patch('/calendar/vacation/{event}', [EventController::class, 'patch'])->name('calendar.vacation.patch');
// });



// new layout routes
Route::middleware(['auth', IsAdmin::class])->group(function(){
    Route::get('/record', [RecordController::class, 'index'])->name('records');
    Route::get('/record/create', [RecordController::class, 'create'])->name('record.create');
    Route::post('/record', [RecordController::class, 'store'])->name('record.store');
});

Route::middleware(['auth', IsAdmin::class])->group(function(){
    Route::get('/calendar/{year}', [CalendarController::class, 'index'])->name('calendar.year');
    Route::post('/calendar/{year}', [CalendarController::class, 'store'])->name('calendar.store');
});

Route::middleware(['auth', IsAdmin::class])->group(function(){
    Route::get('/calendar/{year}/month/{month}', [MonthCalendarController::class, 'index'])->name('calendar.month');
});

Route::middleware(['auth', IsAdmin::class])->group(function(){
    Route::get('/calendar/vacation/{year}', [EventController::class, 'index'])->name('calendar.vacation');
    Route::patch('/calendar/vacation/approve/{event}', [EventController::class, 'approve'])->name('calendar.vacation.approve');
    Route::get('/calendar/vacation/update/{event}', [EventController::class, 'update'])->name('calendar.vacation.update');
    Route::patch('/calendar/vacation/{event}', [EventController::class, 'patch'])->name('calendar.vacation.patch');
    Route::delete('/calendar/vacation/{event}', [EventController::class, 'destroy'])->name('calendar.vacation.destroy');
});

Route::middleware(['auth', IsAdmin::class])->group(function(){
    Route::get('/calendar/holidays/{year}', [CalendarController::class, 'index_holidays'])->name('calendar.holidays');
    Route::post('/calendar/holidays', [CalendarController::class, 'store_holidays'])->name('store.holidays');
    Route::delete('/calendar/holidays/{id}', [CalendarController::class, 'delete_holidays'])->name('delete.holidays');
});

Route::middleware(['auth', IsAdmin::class])->group(function(){
    Route::get('/schedule/planner/{year}/{month}', [PlannerController::class, 'index'])->name('schedule.planner');
    Route::post('/schedule/planner', [PlannerController::class, 'store'])->name('schedule.planner.store');
});

Route::middleware(['auth', IsAdmin::class])->group(function(){
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules');
    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/update/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::patch('/schedule/{id}', [ScheduleController::class, 'patch'])->name('schedule.patch');
    Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');
});

Route::middleware(['auth', IsAdmin::class])->group(function(){
    Route::get('/users', [UserController::class, 'testindex'])->name('users');
    Route::get('/user/create', [UserController::class, 'testcreate'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');   
});

Route::middleware(['auth', IsSuperAdmin::class])->group(function(){
    Route::get('/user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::patch('/user/{id}', [UserController::class, 'patch'])->name('user.patch');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});

Route::middleware('auth')->group(function(){
    Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
    Route::patch('/profile/{id}', [ProfileController::class, 'patch'])->name('profile.patch');
    Route::patch('/profile/password/{id}', [ProfileController::class, 'patch_password'])->name('profile.patch.password');
});

Route::get('/testlogin' , function (){
    return view('testlogin');
});

