<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Authentication\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LanguageController;

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

Route::get('/', function () {
    return view('content');
})->name('dashboard')->middleware('login');


//Chức năng đăng nhập, đăng xuất
Route::get('login', [AuthController::class, 'index']);
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'admin'], function () {
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/create', [UserController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/delete/{id}', [UserController::class, 'destroy'])->name('users.delete');
    Route::delete('users/bulk-delete', [UserController::class, 'bulkDelete'])->name('users.bulkDelete');

    Route::get('language', [LanguageController::class, 'index'])->name('language.index');
    Route::get('language/create', [LanguageController::class, 'create'])->name('language.create');
    Route::post('language/create', [LanguageController::class, 'store'])->name('language.store');
    Route::get('language/edit/{id}', [LanguageController::class, 'edit'])->name('language.edit');
    Route::put('language/update/{id}', [LanguageController::class, 'update'])->name('language.update');
    Route::delete('language/delete/{id}', [LanguageController::class, 'destroy'])->name('language.delete');
    Route::delete('language/bulk-delete', [LanguageController::class, 'bulkDelete'])->name('language.bulkDelete');
});
