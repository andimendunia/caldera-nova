<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\InvItemController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\PrefController;


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

// Route::resource('inv_items', InvItemController::class)->only([
//     'create', 'show', 'edit'
// ]);

Route::controller(InvItemController::class)->group(function () {
    Route::get('/inventory/items/create', 'create')->middleware('auth')->name('inventory.items.create');
    Route::get('/inventory/items/{id}', 'show')->middleware('auth')->name('inventory.items.show');
    Route::get('/inventory/items/{id}/edit', 'edit')->middleware('auth')->name('inventory.items.edit');
});

Route::controller(PrefController::class)->group(function () {
    Route::patch('/prefs/lang', 'updateLang')->middleware('auth')->name('prefs.update.lang');
    Route::patch('/prefs/theme', 'updateTheme')->middleware('auth')->name('prefs.update.theme');
    Route::get('/prefs','index')->middleware('auth')->name('prefs');
});

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');
});

require __DIR__.'/auth.php';
