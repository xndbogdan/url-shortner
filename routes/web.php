<?php

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
Auth::routes();
Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/url/{url}', [\App\Http\Controllers\UrlController::class, 'show'])->name('url.show');
Route::post('/url', [\App\Http\Controllers\UrlController::class, 'store'])->name('url.store');
Route::get('/url/{url}/edit', [\App\Http\Controllers\UrlController::class, 'edit'])->name('url.edit');
Route::put('/url/{url}', [\App\Http\Controllers\UrlController::class, 'update'])->name('url.update');
Route::delete('/url/{url}', [\App\Http\Controllers\UrlController::class, 'destroy'])->name('url.destroy');

