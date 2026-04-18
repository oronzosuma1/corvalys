<?php

namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function privacy() { return view('pages.legal.privacy'); }
    public function cookie() { return view('pages.legal.cookie'); }
    public function terms() { return view('pages.legal.termini'); }
}
