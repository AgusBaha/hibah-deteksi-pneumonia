<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/templates', function () {
    return view('posts.index');
});

Auth::routes([
    'register' => false,
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Gejala
Route::get('/data/gejala', [App\Http\Controllers\Peneumonia\GejalaController::class, 'index'])->name('gejala.index');
Route::get('/data/gejala/create', [App\Http\Controllers\Peneumonia\GejalaController::class, 'create'])->name('gejala.create');
Route::post('/data/gejala/store', [App\Http\Controllers\Peneumonia\GejalaController::class, 'store'])->name('gejala.store');
Route::get('/data/edit/{id}', [App\Http\Controllers\Peneumonia\GejalaController::class, 'edit'])->name('gejala.edit');
Route::put('/data/update/{id}', [App\Http\Controllers\Peneumonia\GejalaController::class, 'update'])->name('gejala.update');
Route::delete('/data/delete/{id}', [App\Http\Controllers\Peneumonia\GejalaController::class, 'destroy'])->name('gejala.delete');
