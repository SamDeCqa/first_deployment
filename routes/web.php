<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\LoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing');
})->middleware('guest')->name('home');

Route::get('login',[LoginController::class, 'index'])->name('login');
Route::post('login/auth',[LoginController::class, 'login'])->middleware(LoginMiddleware::class)->name('login/auth');
Route::get('logout',[LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function(){
    Route::get('userDashboard',[UserController::class, 'index'])->name('userDashboard');
    Route::get('userProjects',[UserController::class, 'getProjects'])->name('userProjects');
    Route::get('userSettings',[SettingsController::class, 'index'])->name('userSettings');
    Route::post('updateCredentials',[SettingsController::class, 'update'])->name('updateCredentials');
    Route::post('project/create',[UserController::class, 'save'])->name('create-project');
    Route::post('project/edit',[UserController::class, 'edit'])->name('edit-project'); 
    Route::post('project/delete',[UserController::class, 'delete'])->name('delete-project');    

    Route::get('adminDashboard',[AdminController::class, 'index'])->name('adminDashboard');
});