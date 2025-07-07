<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FaqSuggestionController;

Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/make', [NewsController::class, 'create'])->name('news.make'); // News make route moet VOOR de {news} route staan
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth'])->group(function () {
    // Admin-only routes for News and FAQ Management
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::put('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    Route::get('/admin/contact/messages', [ContactController::class, 'index'])->name('contact.messages');

    Route::get('/faq/manage', [FaqController::class, 'manage'])->name('faq.manage');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq', [FaqController::class, 'store'])->name('faq.store');
    Route::get('/faq/{faq}/edit', [FaqController::class, 'edit'])->name('faq.edit');
    Route::put('/faq/{faq}', [FaqController::class, 'update'])->name('faq.update');
    Route::delete('/faq/{faq}', [FaqController::class, 'destroy'])->name('faq.destroy');

    // Route for deleting FAQ categories
    Route::delete('/faq/category/{category}', [FaqController::class, 'destroyCategory'])->name('faq.category.destroy');

    Route::post('/faq-suggestions', [FaqSuggestionController::class, 'store'])->name('faq-suggestions.store');
    Route::get('/admin/faq-suggestions', [FaqSuggestionController::class, 'index'])->name('faq-suggestions.index');
    Route::post('/admin/faq-suggestions/{suggestion}/approve', [FaqSuggestionController::class, 'approve'])->name('faq-suggestions.approve');
    Route::delete('/admin/faq-suggestions/{suggestion}', [FaqSuggestionController::class, 'destroy'])->name('faq-suggestions.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Temporarily allow all authenticated users to edit news
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login']);
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', fn() => view('admin.dashboard'))->middleware('auth');

    // Admin User Management Routes
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('auth');
});

// Tijdelijke debug route om de gebruiker rol te controleren
Route::get('/debug-role', function () {
    return auth()->check() ? auth()->user()->role : 'niet ingelogd';
});

Route::post('/news/{news}/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->middleware('auth')->name('comments.destroy');
