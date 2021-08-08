<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
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

Route::resource('bills', BillController::class);
Route::resource('categories', CategoryController::class);

Route::resource('incomes', IncomeController::class);
Route::group(['as' => 'incomes.', 'prefix' => 'incomes'], function () {
    Route::put('/{income}/done', [IncomeController::class, 'updateStatus'])->name('done');
});

Route::resource('expenses', ExpenseController::class);
Route::group(['as' => 'expenses.', 'prefix' => 'expenses'], function () {
    Route::put('/{expense}/done', [ExpenseController::class, 'updateStatus'])->name('done');
});

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

require __DIR__.'/auth.php';
