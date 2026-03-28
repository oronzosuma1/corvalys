<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;

class PrezziController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Prezzi — Corvalys AI Desk');
        SEOTools::setDescription('Piani flessibili per PMI. Inizia gratis per 3 mesi.');

        return view('pages.prezzi', ['prezzi' => config('corvalys.prezzi')]);
    }
}
