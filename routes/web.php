<?php

use App\Http\Controllers\MediaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', function () {
//     return view('welcome');
// })->name('home');
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/media/create', [MediaController::class, 'create'])->name('create');
Route::post('/media/store', [MediaController::class, 'store'])->name('mediacreate');

Route::get('/invoice', [InvoiceController::class, 'index'])->name('invoice');
Route::get('/invoice/create', [InvoiceController::class, 'create'])->name('invoicecreate');
Route::post('/invoice/store', [InvoiceController::class, 'store'])->name('invoicestore');