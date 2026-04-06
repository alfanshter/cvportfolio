<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

// ─────────────────────────────────────────────
// PUBLIC routes — no login required
// ─────────────────────────────────────────────
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ─────────────────────────────────────────────
// ADMIN routes — login required
// ─────────────────────────────────────────────
Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile', [Admin\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [Admin\ProfileController::class, 'update'])->name('profile.update');

    // Skills
    Route::resource('skills', Admin\SkillController::class);

    // Experiences
    Route::resource('experiences', Admin\ExperienceController::class);

    // Educations
    Route::resource('educations', Admin\EducationController::class);

    // Portfolios
    Route::resource('portfolios', Admin\PortfolioController::class);

    // Certificates
    Route::resource('certificates', Admin\CertificateController::class);

    // Contact messages
    Route::get('/contacts', [Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [Admin\ContactController::class, 'destroy'])->name('contacts.destroy');
});

// Laravel Breeze profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
