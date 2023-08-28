<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InventoryItemController;
use App\Http\Controllers\PreferencesController;
use App\Http\Controllers\AccountController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::controller(InventoryController::class)->group(function () {
    Route::get('/inventory', 'index')->middleware('auth')->name('inventory');
});

Route::controller(InventoryItemController::class)->group(function () {
    Route::get('/inventory/items/create', 'create')->middleware('auth')->name('inventory.items.create');
    Route::get('/inventory/items/{id}', 'show')->middleware('auth')->name('inventory.items.show');
    Route::get('/inventory/items/{id}/edit', 'edit')->middleware('auth')->name('inventory.items.edit');
});

Route::get('/preferences', [PreferencesController::class, 'index'])->middleware('auth')->name('preferences');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');
});

require __DIR__.'/auth.php';
