<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;

class PrezziController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Prezzi — Corvalys');
        SEOTools::setDescription('Piani flessibili per PMI europee. Consulenza e strumenti AI su misura.');

        return view('pages.prezzi', ['prezzi' => config('corvalys.prezzi')]);
    }
}
