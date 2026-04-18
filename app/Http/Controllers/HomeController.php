<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use App\Models\Service;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $stats = [
            'sme' => '26.1M',
            'ore' => '9.85',
            'pct' => '52%',
            'miliardi' => '100B',
            'giorni' => max(0, (int) now()->diffInDays(\Carbon\Carbon::parse('2026-08-02'), false)),
        ];

        $products = Service::prodotti()->active()->orderBy('sort_order')->take(3)->get();

        return view('pages.home', compact('stats', 'products'));
    }

    public function newsletter(Request $request)
    {
        $request->validate(['email' => 'required|email|max:255']);
        NewsletterSubscriber::firstOrCreate(
            ['email' => $request->email],
            ['source' => 'website']
        );
        return back()->with('newsletter_success', true);
    }
}
