<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KpiController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrefController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\InsightController;
use App\Http\Controllers\InvCircController;
use App\Http\Controllers\InvItemController;
use App\Http\Controllers\KpiScoreController;
use App\Http\Controllers\InventoryController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::controller(InventoryController::class)->group(function () {
    Route::get('/inventory', 'index')->middleware('auth')->name('inventory');
});

Route::controller(InvItemController::class)->group(function () {
    Route::get('/inventory/items/create', 'create')->middleware('auth')->name('inventory.items.create');
    Route::get('/inventory/items/{id}', 'show')->middleware('auth')->name('inventory.items.show');
    Route::get('/inventory/items/{id}/edit', 'edit')->middleware('auth')->name('inventory.items.edit');
    Route::patch('/inventory/items/', 'update')->middleware('auth')->name('inventory.items.update');
});

Route::controller(InvCircController::class)->group(function () {
    Route::post('/inventory/circs/create', 'create')->middleware('auth')->name('inventory.circs.create');
    Route::get('/inventory/circs/print', 'print')->middleware('auth')->name('inventory.circs.print');
    Route::post('/inventory/circs/', 'update')->middleware('auth')->name('inventory.circs.update');
});

Route::controller(PrefController::class)->group(function () {
    Route::patch('/prefs/lang', 'updateLang')->middleware('auth')->name('prefs.update.lang');
    Route::patch('/prefs/theme', 'updateTheme')->middleware('auth')->name('prefs.update.theme');
    Route::get('/prefs','index')->middleware('auth')->name('prefs');
});

Route::controller(InsightController::class)->group(function () {
    Route::get('/insight', 'index')->name('insight');
});

Route::controller(KpiController::class)->group(function () {
    Route::get('/kpi', 'index')->middleware('auth')->name('kpi');
});

Route::controller(KpiScoreController::class)->group(function () {
    Route::get('/kpi/scores/create', 'create')->middleware('auth')->name('kpi.scores.create');
    Route::get('/kpi/scores/{id}', 'show')->middleware('auth')->name('kpi.scores.show');
    Route::get('/kpi/scores/{id}/edit', 'edit')->middleware('auth')->name('kpi.scores.edit');
    Route::patch('/kpi/scores/', 'update')->middleware('auth')->name('kpi.items.update');
});

Route::controller(HelpController::class)->group(function () {
    Route::get('/help', 'index')->name('help');
});

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');
});

require __DIR__.'/auth.php';
