<?php

use App\Http\Controllers\DebiturController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LapcallController;
use App\Http\Controllers\UserController;
use Illuminate\Contracts\Auth\UserProvider;



Route::get('/', [HomeController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/filter', [HomeController::class,'filter'])->name('filter');
// Route::get('/debitur', [DebiturController::class,'index'])->name('debitur.index');
// Route::get('/debitur/create', [DebiturController::class,'create'])->name('debitur.create');
// Route::get('debitur/destroy', 'DebiturController@destroy')->name('debitur.destroy');

Route::resource('debitur',DebiturController::class);
Route::get('debitur/formatdebitur', 'DebiturController@formatdebitur')->name('formatdebitur');

Route::resource('user',UserController::class);
Route::resource('lapcall',LapcallController::class);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
