<?php

use App\Http\Controllers\StatController;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Project\Create;
use App\Http\Livewire\Admin\Project\View;
use App\Http\Livewire\Admin\SoldLand\Delete;
use App\Http\Livewire\Admin\SoldLand\Edit;
use App\Http\Livewire\Admin\SoldLand\Index;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', Dashboard::class)->name('admin.dashboard');
    Route::prefix('projects')->group(function () {
        Route::get('/', \App\Http\Livewire\Admin\Project\Index::class)->name('projects.index');
        Route::get('/create', Create::class)->name('projects.create');
        Route::get('/{project}', View::class)->name('projects.show');
        Route::get('/{project}/edit', \App\Http\Livewire\Admin\Project\Edit::class)->name('projects.edit');
        Route::get('/{project}/delete', \App\Http\Livewire\Admin\Project\Delete::class)->name('projects.delete');
    });
    Route::prefix('plots')->group(function () {
        Route::get('/', \App\Http\Livewire\Admin\Plot\Index::class)->name('plots.index');
        Route::get('/create', \App\Http\Livewire\Admin\Plot\Create::class)->name('plots.create');
        Route::get('/{plot}', \App\Http\Livewire\Admin\Plot\View::class)->name('plots.show');
        Route::get('/{plot}/edit', \App\Http\Livewire\Admin\Plot\Edit::class)->name('plots.edit');
        Route::get('/{plot}/delete', \App\Http\Livewire\Admin\Plot\Delete::class)->name('plots.delete');
    });
    Route::prefix('documents')->group(function () {
        Route::get('/', \App\Http\Livewire\Admin\Document\Index::class)->name('documents.index');
        Route::get('/create', \App\Http\Livewire\Admin\Document\Create::class)->name('documents.create');
        Route::get('{document}', \App\Http\Livewire\Admin\Document\View::class)->name('documents.show');
        Route::get('/{document}/edit', \App\Http\Livewire\Admin\Document\Edit::class)->name('documents.edit');
        Route::get('/{document}/delete', \App\Http\Livewire\Admin\Document\Delete::class)->name('documents.delete');
    });
    Route::prefix('boughtlands')->group(function () {
        Route::get('/', \App\Http\Livewire\Admin\BoughtLand\Index::class)->name('boughtlands.index');
        Route::get('/create', \App\Http\Livewire\Admin\BoughtLand\Create::class)->name('boughtlands.create');
        Route::get('/{bought}', \App\Http\Livewire\Admin\BoughtLand\View::class)->name('boughtlands.show');
        Route::get('/{bought}/edit', \App\Http\Livewire\Admin\BoughtLand\Edit::class)->name('boughtlands.edit');
        Route::get('/{bought}/delete', \App\Http\Livewire\Admin\BoughtLand\Delete::class)->name('boughtlands.delete');
    });
    Route::prefix('soldlands')->group(function () {
        Route::get('/', Index::class)->name('soldlands.index');
        Route::get('/create', \App\Http\Livewire\Admin\SoldLand\Create::class)->name('soldlands.create');
        Route::get('/{sold}', \App\Http\Livewire\Admin\SoldLand\View::class)->name('soldlands.show');
        Route::get('/{sold}/edit', Edit::class)->name('soldlands.edit');
        Route::get('/{sold}/delete', Delete::class)->name('soldlands.delete');
    });

    Route::prefix('invoices')->controller(\App\Http\Controllers\InvoiceController::class)->group(function () {
        Route::get('bought', 'bought')->name('invoices.bought');
    });
});

Route::prefix('stats')->controller(StatController::class)->group(function () {
    Route::get('plots', 'plots');
    Route::get('bar', 'bar');
    Route::get('pie', 'pie');
    Route::get('line', 'line');
    Route::get('year-line', 'year_line');
});

require __DIR__ . '/auth.php';
