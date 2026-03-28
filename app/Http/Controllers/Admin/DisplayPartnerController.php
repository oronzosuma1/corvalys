<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class DisplayPartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::orderBy('sort_order')->paginate(20);
        return view('admin.display-partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.display-partners.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/partners'), $filename);
            $validated['logo'] = 'uploads/partners/' . $filename;
        }

        Partner::create($validated);

        return redirect()->route('admin.display-partners.index')->with('success', 'Partner creato.');
    }

    public function edit(Partner $display_partner)
    {
        return view('admin.display-partners.edit', ['partner' => $display_partner]);
    }

    public function update(Request $request, Partner $display_partner)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|max:2048',
            'website_url' => 'nullable|url|max:255',
            'description' => 'nullable|string',
            'sort_order' => 'integer',
            'is_active' => 'boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        if ($request->hasFile('logo')) {
            if ($display_partner->logo && file_exists(public_path($display_partner->logo))) {
                unlink(public_path($display_partner->logo));
            }
            $file = $request->file('logo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/partners'), $filename);
            $validated['logo'] = 'uploads/partners/' . $filename;
        }

        $display_partner->update($validated);

        return redirect()->route('admin.display-partners.index')->with('success', 'Partner aggiornato.');
    }

    public function destroy(Partner $display_partner)
    {
        if ($display_partner->logo && file_exists(public_path($display_partner->logo))) {
            unlink(public_path($display_partner->logo));
        }

        $display_partner->delete();
        return redirect()->route('admin.display-partners.index')->with('success', 'Partner eliminato.');
    }
}
