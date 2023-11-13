<?php

use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('invoices', InvoiceController::class);

    Route::get('/items/{id}', [ItemController::class, 'index'])->name('items.index');
    Route::get('/items/{id}/show', [ItemController::class, 'show'])->name('items.show');
    Route::get('/items/{id}/create', [ItemController::class, 'create'])->name('items.create');
    Route::post('/items/store', [ItemController::class, 'store'])->name('items.store');
    Route::delete('/items/{id}/destroy', [ItemController::class, 'destroy'])->name('items.destroy');

    Route::get('/payments/{id}', [PaymentController::class, 'index'])->name('payments.index');
    Route::get('/payments/{id}/show', [PaymentController::class, 'show'])->name('payments.show');
    Route::get('/payments/{id}/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::post('/payments/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::delete('/payments/{id}/destroy', [PaymentController::class, 'destroy'])->name('payments.destroy');
});
