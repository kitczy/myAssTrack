<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InquiryController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/home', function () {
    return redirect('/dashboard');
});

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::post('/contact/send', [InquiryController::class, 'store'])
    ->name('contact.send');

Auth::routes();

Route::middleware(['auth'])->group(function ()  {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/users', [DashboardController::class, 'users'])
        ->name('users');

    Route::post('/users/store', [UserController::class, 'store'])
        ->name('users.store');

    Route::put('/users/update/{id}', [UserController::class, 'update'])
        ->name('users.update');

    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    Route::get('/assignments', [AssignmentController::class, 'index'])
        ->name('assignments');

    Route::post('/assignments', [AssignmentController::class, 'store'])
        ->name('assignments.store');

    Route::put('/assignments/{id}', [AssignmentController::class, 'update'])
        ->name('assignments.update');

    Route::delete('/assignments/{id}', [AssignmentController::class, 'destroy'])
        ->name('assignments.destroy');

    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::post('/profile/update', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::post('/profile/photo', [ProfileController::class, 'uploadPhoto'])
        ->name('profile.photo');
});