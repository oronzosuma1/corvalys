<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Artesaos\SEOTools\Facades\SEOTools;

class ConsulenzaController extends Controller
{
    public function index()
    {
        $services = Service::consulenze()->active()->orderBy('sort_order')->get();
        SEOTools::setTitle('Consulting — Custom AI Solutions');
        SEOTools::setDescription('Custom AI consulting for European SMEs: strategy, development, compliance, supply chain.');
        return view('pages.consulenza', compact('services'));
    }
}
