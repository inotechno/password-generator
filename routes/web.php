<?php

use App\Http\Controllers\PasswordController;
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
    return view('index');
});

Route::get('/generate-password', [PasswordController::class, 'index'])->name('generate');
Route::get('/search-password', [PasswordController::class, 'search'])->name('search');

Route::post('/save-password', [PasswordController::class, 'store'])->name('save');
Route::post('/search-password', [PasswordController::class, 'search_process'])->name('search.process');
