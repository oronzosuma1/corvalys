<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\TeamMember;
use App\Models\Partner;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\JsonLd;

class ChiSiamoController extends Controller
{
    public function index()
    {
        $page = Page::findBySlug('chi-siamo');

        SEOTools::setTitle('About Us — Corvalys');
        SEOTools::setDescription($page?->meta_description ?? 'An AI-first company helping European SMEs modernize with pragmatism and strategic vision.');
        JsonLd::setType('Organization');
        JsonLd::addValue('name', 'Corvalys');

        return view('pages.chi-siamo.index', compact('page'));
    }

    public function missione()
    {
        $page = Page::findBySlug('missione');

        SEOTools::setTitle('Our Mission — Corvalys');
        SEOTools::setDescription($page?->meta_description ?? 'Making AI accessible, practical, and compliant for European SMEs.');
        JsonLd::setType('Organization');
        JsonLd::addValue('name', 'Corvalys');

        return view('pages.chi-siamo.missione', compact('page'));
    }

    public function cosaFacciamo()
    {
        $page = Page::findBySlug('cosa-facciamo');

        SEOTools::setTitle('What We Do — Corvalys');
        SEOTools::setDescription($page?->meta_description ?? 'AI Suite, custom consulting, and training for European SMEs.');
        JsonLd::setType('Organization');
        JsonLd::addValue('name', 'Corvalys');

        return view('pages.chi-siamo.cosa-facciamo', compact('page'));
    }

    public function valori()
    {
        $page = Page::findBySlug('valori');

        SEOTools::setTitle('Our Values — Corvalys');
        SEOTools::setDescription($page?->meta_description ?? 'Clarity, measurable impact, data ethics, and partnership.');
        JsonLd::setType('Organization');
        JsonLd::addValue('name', 'Corvalys');

        return view('pages.chi-siamo.valori', compact('page'));
    }

    public function team()
    {
        $members = TeamMember::active()->get();

        SEOTools::setTitle('Our Team — Corvalys');
        SEOTools::setDescription('Meet the team behind Corvalys — AI engineers and consultants helping European SMEs.');
        JsonLd::setType('Organization');
        JsonLd::addValue('name', 'Corvalys');

        return view('pages.chi-siamo.team', compact('members'));
    }

    public function partners()
    {
        $partners = Partner::active()->get();

        SEOTools::setTitle('Partners — Corvalys');
        SEOTools::setDescription('Our trusted partners and collaborators in the AI and SME ecosystem.');
        JsonLd::setType('Organization');
        JsonLd::addValue('name', 'Corvalys');

        return view('pages.chi-siamo.partners', compact('partners'));
    }
}
