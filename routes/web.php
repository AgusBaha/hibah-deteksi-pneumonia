<?php

use App\Exports\UserResponsesExport;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\Kanker\adminSide\CategoryController;
use App\Http\Controllers\Kanker\adminSide\ChartController;
use App\Http\Controllers\Kanker\adminSide\MainQuestionController;
use App\Http\Controllers\Kanker\adminSide\SpecificQuestionController;
use App\Http\Controllers\Kanker\userSide\UserController;
use App\Http\Controllers\User\DetectionController;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;


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


Auth::routes([
    'register' => false
]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Route Gejala
Route::get('/data/gejala', [App\Http\Controllers\Peneumonia\GejalaController::class, 'index'])->name('gejala.index');
Route::get('/data/gejala/create', [App\Http\Controllers\Peneumonia\GejalaController::class, 'create'])->name('gejala.create');
Route::post('/data/gejala/store', [App\Http\Controllers\Peneumonia\GejalaController::class, 'store'])->name('gejala.store');
Route::get('/data/edit/{id}', [App\Http\Controllers\Peneumonia\GejalaController::class, 'edit'])->name('gejala.edit');
Route::put('/data/update/{id}', [App\Http\Controllers\Peneumonia\GejalaController::class, 'update'])->name('gejala.update');
Route::delete('/data/delete/{id}', [App\Http\Controllers\Peneumonia\GejalaController::class, 'destroy'])->name('gejala.delete');
Route::get('/konsultasi', [App\Http\Controllers\Peneumonia\GejalaController::class, 'konsultasi'])->name('basiskasus.konsultasi');
Route::post('/process-selection', [App\Http\Controllers\Peneumonia\GejalaController::class, 'calculateSimilarity'])->name('similarity');

// Route Basis Kasus
Route::get('/data/basis-kasus', [App\Http\Controllers\Pneumonia\BasisKasusController::class, 'index'])->name('basiskasus.index');
Route::get('/data/basiskasus/create', [App\Http\Controllers\Pneumonia\BasisKasusController::class, 'create'])->name('basiskasus.create');
Route::post('/data/basiskasus/store', [App\Http\Controllers\Pneumonia\BasisKasusController::class, 'store'])->name('basiskasus.store');
Route::get('/generate-id-basis', [App\Http\Controllers\Pneumonia\BasisKasusController::class, 'generateId'])->name('generate.basiskasus.create');
Route::get('/basiskasus/{id}/edit', [App\Http\Controllers\Pneumonia\BasisKasusController::class, 'edit'])->name('basiskasus.edit');
Route::put('/basiskasus/{id}', [App\Http\Controllers\Pneumonia\BasisKasusController::class, 'update'])->name('basiskasus.update');
Route::delete('/basiskasus/{id}', [App\Http\Controllers\Pneumonia\BasisKasusController::class, 'destroy'])->name('basiskasus.destroy');

Route::resource('/question', QuestionController::class);
// Route::get('/deteksi/kanker', [App\Http\Controllers\User\DetectionController::class, 'start'])->name('question.start');

// Route untuk user memulai deteksi tanpa login
Route::get('/', [DetectionController::class, 'start'])->name('user.detection.start');
Route::post('/detection/answer/{question}', [DetectionController::class, 'answer'])->name('user.detection.answer');

// Deteksi kanker
Route::prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class);
    Route::resource('main-questions', MainQuestionController::class);
    Route::resource('specific-questions', SpecificQuestionController::class);
    Route::get('/charts', [ChartController::class, 'index'])->name('charts');
});

Route::get('/export-excel', function () {
    return Excel::download(new UserResponsesExport, 'user_responses.xlsx');
});

Route::get('/deteksi-kanker', [UserController::class, 'index'])->name('deteksi.index');
Route::post('/deteksi-kanker', [UserController::class, 'store'])->name('deteksi.store');
Route::post('/deteksi-kanker/proses', [UserController::class, 'processQuestion'])->name('deteksi.process');

// Route::get('/deteksi-kanker', [UserController::class, 'start'])->name('user.start');
Route::post('/answer', [UserController::class, 'answer'])->name('user.answer');
Route::get('/summary', [UserController::class, 'summary'])->name('user.summary');
