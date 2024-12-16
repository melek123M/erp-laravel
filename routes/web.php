<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('clients', ClientController::class)->except(['show']);
Route::get('/clients/data', [ClientController::class, 'data'])->name('clients.data');
Route::get('clients/{id}/details', [ClientController::class, 'details'])->name('clients.details');
Route::get('factures/{clientId}', [InvoiceController::class, 'index'])->name('factures.data');
Route::post('factures/{clientId}', [InvoiceController::class, 'store'])->name('factures.store');
Route::get('factures/{factureId}/edit', [InvoiceController::class, 'edit'])->name('factures.edit');
Route::put('factures/{factureId}', [InvoiceController::class, 'update'])->name('factures.update');
Route::delete('factures/{factureId}', [InvoiceController::class, 'destroy'])->name('factures.destroy');
Route::get('factures/{clientId}/unpaid', [InvoiceController::class, 'getUnpaidInvoices'])->name('factures.unpaid');
Route::get('factures/{clientId}/totalUnpaid', [InvoiceController::class, 'getTotalUnpaidInvoices'])->name('factures.totalUnpaid');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
