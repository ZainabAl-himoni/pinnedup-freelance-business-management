<?php

use App\Auth\RegisterController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('register', [RegisterController::class, 'register'])->name('register');
Route::post('/dashboard/login',[RegisterController::class, 'login'])->name('login');

Route::get('/proposals/{proposal}/pdf', [PdfController::class, 'view'])
    ->name('proposals.view-pdf');
Route::get('proposals/{proposal}/download', [PdfController::class, 'download'])
    ->name('proposals.download');
Route::get('invoices/{invoice}/download', [PdfController::class, 'idownload'])
    ->name('invoices.download');

Route::get('invoices/{invoice}/view', [PdfController::class, 'iview'])
    ->name('invoices.view');
