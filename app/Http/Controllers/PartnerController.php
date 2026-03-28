<?php

namespace App\Http\Controllers;

use App\Mail\NuovoLeadMail;
use App\Models\PartnerRequest;
use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PartnerController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Programma Partner — Corvalys');
        SEOTools::setDescription('Diventa partner Corvalys: 20% MRR, dashboard dedicata, formazione e supporto.');

        return view('pages.partner');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'studio_name' => 'required|string|max:150',
            'clients_count' => 'nullable|integer|min:1',
            'message' => 'nullable|string|max:1000',
        ]);

        PartnerRequest::create($validated);

        return redirect()->route('partner')
            ->with('success', 'Grazie! Ti contatteremo presto per i dettagli del programma.');
    }
}
