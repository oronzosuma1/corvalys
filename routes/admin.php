<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\QuotazioneController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\PartnerRequestController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\DisplayPartnerController;
use App\Http\Controllers\Admin\ProposalController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\SurveyAdminController;
use App\Http\Controllers\Admin\BusinessSurveyAdminController;
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
    Route::post('leads/{lead}/proposal/generate', [ProposalController::class, 'generate'])->name('leads.proposal.generate');
    Route::get('leads/{lead}/proposal/download', [ProposalController::class, 'download'])->name('leads.proposal.download');
    Route::post('leads/{lead}/proposal/approve', [ProposalController::class, 'approve'])->name('leads.proposal.approve');
    Route::post('leads/{lead}/proposal/send', [ProposalController::class, 'send'])->name('leads.proposal.send');
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

    // Survey / AI Readiness
    Route::get('survey', [SurveyAdminController::class, 'index'])->name('survey.index');
    Route::get('survey/analytics', [SurveyAdminController::class, 'analytics'])->name('survey.analytics');
    Route::get('survey/export', [SurveyAdminController::class, 'export'])->name('survey.export');
    Route::get('survey/{survey}', [SurveyAdminController::class, 'show'])->name('survey.show');

    // Business Survey
    Route::get('business-survey', [BusinessSurveyAdminController::class, 'index'])->name('business-survey.index');
    Route::get('business-survey/analytics', [BusinessSurveyAdminController::class, 'analytics'])->name('business-survey.analytics');
    Route::get('business-survey/export', [BusinessSurveyAdminController::class, 'export'])->name('business-survey.export');
    Route::get('business-survey/{survey}', [BusinessSurveyAdminController::class, 'show'])->name('business-survey.show');

    // Settings
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings/password', [SettingsController::class, 'changePassword'])->name('settings.password');
    Route::post('settings/users', [SettingsController::class, 'storeUser'])->name('settings.users.store');
    Route::delete('settings/users/{user}', [SettingsController::class, 'destroyUser'])->name('settings.users.destroy');
    Route::post('settings/2fa', [SettingsController::class, 'toggle2fa'])->name('settings.2fa.toggle');
    Route::post('settings/2fa/confirm', [SettingsController::class, 'confirm2fa'])->name('settings.2fa.confirm');
    Route::post('settings/config', [SettingsController::class, 'updateConfig'])->name('settings.config');
});
