<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeController;
use App\Livewire\Chat\Chat;
use App\Livewire\Chat\Index;
use App\Livewire\Users;
use App\Models\ClassRoom;
use Illuminate\Support\Facades\Route;
use RealRashid\SweetAlert\Facades\Alert;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $previousUrl= url()->previous();
    if (str_contains($previousUrl, "/login")) {
        Alert::toast('Logged in  successfully', 'success');
    }
    if (str_contains($previousUrl, "/register")) {
        Alert::toast('Account created successfully', 'success');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function(){
    Route::get('/chat', Index::class)->name('chat.index');
    Route::get('/chat/{query}',Chat::class)->name('chat');    
    Route::get('/users',Users::class)->name('users');
    Route::get('/classroom', [PageController::class, 'classroom'])->name('classroom');
    Route::get('/classchat/{query}', [PageController::class, 'classchat'])->name('classchat');
    Route::get('/marketplace/dashboard', [PageController::class, 'marketplaceDashboard'])->name('marketplace.dashboard');
    Route::get('/marketplace/shop', [PageController::class, 'marketplaceShop'])->name('marketplace.shop');
    Route::delete('books/{id}/delete', [PageController::class, 'destroy'])->name('books.destroy');
    Route::get('books/{id}/edit', [PageController::class, 'edit'])->name('books.edit');
    Route::put('books/{id}/update', [PageController::class, 'update'])->name('books.update');
    Route::get('search', [PageController::class, 'search'])->name('search.page');
    Route::get('watch', [PageController::class, 'watch'])->name('watch');
    Route::post('stripe', [StripeController::class, 'stripe'])->name('stripe');
    Route::get('success', [StripeController::class, 'success'])->name('success');
    Route::get('cancel', [StripeController::class, 'cancel'])->name('cancel');
    Route::get('/download/book/{id}', [StripeController::class, 'download'])->name('download.book');


});