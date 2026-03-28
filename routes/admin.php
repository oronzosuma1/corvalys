<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\QuotazioneController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\PartnerRequestController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\CashFlowController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\DisplayPartnerController;
use Illuminate\Support\Facades\Route;

// Admin auth routes (no auth middleware)
Route::middleware('web')->prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

// Protected admin routes
Route::middleware(['web', 'auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('leads', LeadController::class)->only(['index', 'show', 'update']);
    Route::post('leads/{lead}/nota', [LeadController::class, 'addNota'])->name('leads.nota');
    Route::post('leads/{lead}/proposal', [LeadController::class, 'sendProposal'])->name('leads.proposal');
    Route::post('leads/{lead}/auto-assess', [LeadController::class, 'autoAssess'])->name('leads.auto-assess');
    Route::get('quotazione', [QuotazioneController::class, 'index'])->name('quotazione.index');
    Route::post('quotazione', [QuotazioneController::class, 'generateStandalone'])->name('quotazione.generate-standalone');
    Route::get('quotazione/{lead}', [QuotazioneController::class, 'show'])->name('quotazione.show');
    Route::post('quotazione/{lead}', [QuotazioneController::class, 'generate'])->name('quotazione.generate');
    Route::resource('articles', ArticleController::class);
    Route::patch('articles/{article}/toggle', [ArticleController::class, 'toggle'])->name('articles.toggle');
    Route::get('partners', [PartnerRequestController::class, 'index'])->name('partners.index');
    Route::patch('partners/{partner}/status', [PartnerRequestController::class, 'updateStatus'])->name('partners.status');

    Route::get('services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('services/create', [ServiceController::class, 'create'])->name('services.create');
    Route::post('services', [ServiceController::class, 'store'])->name('services.store');
    Route::get('services/{service}/edit', [ServiceController::class, 'edit'])->name('services.edit');
    Route::put('services/{service}', [ServiceController::class, 'update'])->name('services.update');
    Route::delete('services/{service}', [ServiceController::class, 'destroy'])->name('services.destroy');

    Route::resource('pages', PageController::class);
    Route::patch('pages/{page}/toggle', [PageController::class, 'toggle'])->name('pages.toggle');
    Route::resource('team-members', TeamMemberController::class);
    Route::resource('display-partners', DisplayPartnerController::class);

    Route::resource('invoices', InvoiceController::class);
    Route::get('cash-flow', [CashFlowController::class, 'index'])->name('cashflow.index');
    Route::get('cash-flow/detail', [CashFlowController::class, 'detail'])->name('cashflow.detail');
    Route::post('cash-flow', [CashFlowController::class, 'store'])->name('cashflow.store');
    Route::delete('cash-flow/{entry}', [CashFlowController::class, 'destroy'])->name('cashflow.destroy');
});
