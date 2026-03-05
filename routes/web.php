<?php

use App\Livewire\WorkshopList;
use App\Livewire\WorkshopRegistration;
use Illuminate\Support\Facades\Route;

Route::get('/', WorkshopList::class)->name('home');
Route::get('/workshop/{workshop}/register', WorkshopRegistration::class)->name('workshop.register');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
