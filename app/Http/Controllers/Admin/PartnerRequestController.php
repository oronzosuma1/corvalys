<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PartnerRequest;
use Illuminate\Http\Request;

class PartnerRequestController extends Controller
{
    public function index()
    {
        $partners = PartnerRequest::latest()->paginate(20);
        return view('admin.partners.index', compact('partners'));
    }

    public function updateStatus(Request $request, PartnerRequest $partner)
    {
        $request->validate(['status' => 'required|in:new,approved,rejected']);
        $partner->update(['status' => $request->status]);

        return redirect()->route('admin.partners.index')->with('success', 'Stato aggiornato.');
    }
}
