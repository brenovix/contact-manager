<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
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
    return redirect('/contacts');
});

Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::get('/contacts/{id?}', [ContactController::class, 'details'])->name('contact.details')->where('id', '\d');

Route::middleware('auth')->group(function () {
    Route::prefix('/contacts')->group(function () {
        Route::post('/', [ContactController::class, 'save'])->name('contact.save');
        Route::get('/add', [ContactController::class, 'add'])->name('contact.add');
        Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('contact.edit');
        Route::put('/{id}', [ContactController::class, 'update'])->name('contact.update');
        Route::delete('/{id}', [ContactController::class, 'delete'])->name('contact.delete');
    });
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
