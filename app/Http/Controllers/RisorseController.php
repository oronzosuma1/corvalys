<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;

class RisorseController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Risorse — Corvalys');
        SEOTools::setDescription('Guide, template e risorse gratuite su AI per PMI, AI Act e automazione.');

        return view('pages.risorse');
    }
}
