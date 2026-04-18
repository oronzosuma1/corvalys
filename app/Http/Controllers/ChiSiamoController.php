<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TeamMember;
use App\Models\Partner;

class ChiSiamoController extends Controller
{
    public function index()
    {
        $page = Page::findBySlug('chi-siamo');

        return view('pages.chi-siamo.index', compact('page'));
    }

    public function missione()
    {
        $page = Page::findBySlug('missione');

        return view('pages.chi-siamo.missione', compact('page'));
    }

    public function cosaFacciamo()
    {
        $page = Page::findBySlug('cosa-facciamo');

        return view('pages.chi-siamo.cosa-facciamo', compact('page'));
    }

    public function valori()
    {
        $page = Page::findBySlug('valori');

        return view('pages.chi-siamo.valori', compact('page'));
    }

    public function team()
    {
        $members = TeamMember::active()->get();

        return view('pages.chi-siamo.team', compact('members'));
    }

    public function partners()
    {
        $partners = Partner::active()->get();

        return view('pages.chi-siamo.partners', compact('partners'));
    }
}
