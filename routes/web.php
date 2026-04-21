<?php

use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('form');
});


Route::post('/formSubmit', [RegistrationController::class, 'save']);

Route::get('/admin', [UserController::class, 'index']);
Route::get('/admin/edit/{id}', [UserController::class, 'getUser']);
Route::post('/EditformSubmit', [UserController::class, 'editUser']);

Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

Route::get('/users/export', [UserController::class, 'export'])->name('users.export');