<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdottiController;
use App\Http\Controllers\PrezziController;
use App\Http\Controllers\ConsulenzaController;
use App\Http\Controllers\ChiSiamoController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ContattoController;
use App\Http\Controllers\RisorseController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\BusinessSurveyController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/prodotti', [ProdottiController::class, 'index'])->name('prodotti');
Route::get('/prodotti/{service:slug}', [ProdottiController::class, 'show'])->name('prodotti.show');
Route::get('/prezzi', [PrezziController::class, 'index'])->name('prezzi');
Route::get('/consulenza', [ConsulenzaController::class, 'index'])->name('consulenza');
Route::get('/chi-siamo', [ChiSiamoController::class, 'index'])->name('chi-siamo');
Route::get('/chi-siamo/missione', [ChiSiamoController::class, 'missione'])->name('chi-siamo.missione');
Route::get('/chi-siamo/cosafacciamo', [ChiSiamoController::class, 'cosaFacciamo'])->name('chi-siamo.cosa-facciamo');
Route::get('/chi-siamo/valori', [ChiSiamoController::class, 'valori'])->name('chi-siamo.valori');
Route::get('/chi-siamo/team', [ChiSiamoController::class, 'team'])->name('chi-siamo.team');
Route::get('/chi-siamo/partners', [ChiSiamoController::class, 'partners'])->name('chi-siamo.partners');
Route::get('/partner', [PartnerController::class, 'index'])->name('partner');
Route::post('/partner', [PartnerController::class, 'store'])->name('partner.store');
Route::get('/contatto', [ContattoController::class, 'index'])->name('contatto');
Route::post('/contatto', [ContattoController::class, 'store'])->name('contatto.store');
Route::post('/newsletter', [HomeController::class, 'newsletter'])->name('newsletter');
Route::get('/risorse', [RisorseController::class, 'index'])->name('risorse');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{article:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/legal/privacy', fn() => view('pages.legal.privacy'))->name('privacy');
Route::get('/legal/termini', fn() => view('pages.legal.termini'))->name('termini');
Route::get('/legal/cookie', fn() => view('pages.legal.cookie'))->name('cookie');
Route::get('/ai-readiness', [SurveyController::class, 'index'])->name('survey');
Route::post('/ai-readiness', [SurveyController::class, 'store'])->name('survey.store');
Route::get('/survey', [BusinessSurveyController::class, 'index'])->name('business-survey');
Route::post('/survey', [BusinessSurveyController::class, 'store'])->name('business-survey.store');
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');

// GDPR cookie consent logging (session + CSRF)
Route::post('/api/consent', [\App\Http\Controllers\Api\ConsentController::class, 'store'])
    ->middleware(['throttle:30,1'])
    ->name('consent.store');

Route::post('/api/cookie-consent', [\App\Http\Controllers\Api\ConsentController::class, 'store'])
    ->middleware(['throttle:30,1'])
    ->name('cookie-consent.store');
