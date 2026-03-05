<?php

use App\Livewire\WorkshopList;
use App\Livewire\WorkshopRegistration;
use Illuminate\Support\Facades\Route;

Route::get('/', WorkshopList::class)->name('home');
Route::get('/workshop/{workshop}/register', WorkshopRegistration::class)->name('workshop.register');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', \App\Livewire\Admin\Dashboard::class)->name('dashboard');
    
    Route::prefix('admin/workshops')->name('admin.workshops.')->group(function () {
        Route::get('/', \App\Livewire\Admin\Workshop\Index::class)->name('index');
        Route::get('/create', \App\Livewire\Admin\Workshop\Form::class)->name('create');
        Route::get('/{workshop}/edit', \App\Livewire\Admin\Workshop\Form::class)->name('edit');
        Route::get('/{workshop}/registrants', \App\Livewire\Admin\Workshop\Registrants::class)->name('registrants');
    });
});

require __DIR__.'/settings.php';
