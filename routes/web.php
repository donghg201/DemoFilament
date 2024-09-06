<?php

use App\Actions\UpdatePassword;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    UpdatePassword::run(User::find(1), 'admin123');
    return view('welcome');
});

Route::get('user/profile', [UserController::class, 'showProfile']);
// Route::post('user/profile', [UserController::class, 'updateProfile'])->name('update.profile');
Route::post('user/profile', UpdatePassword::class)->name('update.profile');


Route::get('export/array', [ExportController::class, 'array'])->name('export.array');
Route::get('export/excel', [ExportController::class, 'excel'])->name('export.excel');
Route::get('export/spatie', [ExportController::class, 'spatie'])->name('export.spatie');
Route::get('export/fast-excel', [ExportController::class, 'fastExcel'])->name('export.fast-excel');
