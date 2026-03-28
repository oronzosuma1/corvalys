<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Artesaos\SEOTools\Facades\SEOTools;

class ProdottiController extends Controller
{
    public function index()
    {
        $products = Service::prodotti()->active()->orderBy('sort_order')->get();
        SEOTools::setTitle('Products — Corvalys AI Suite');
        SEOTools::setDescription('AI tools for invoice management, approvals, and compliance for European SMEs.');
        return view('pages.prodotti', compact('products'));
    }

    public function show(Service $service)
    {
        if ($service->type !== 'prodotto' || !$service->is_active) {
            abort(404);
        }
        SEOTools::setTitle($service->name . ' — Corvalys');
        SEOTools::setDescription($service->short_description);
        return view('pages.prodotti.show', compact('service'));
    }
}
