<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $services = Service::query()
            ->when($request->type, fn($q, $t) => $q->where('type', $t))
            ->orderBy('type')->orderBy('sort_order')
            ->paginate(20);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:prodotto,consulenza',
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string',
            'price_from' => 'nullable|numeric|min:0',
            'price_to' => 'nullable|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        Service::create($validated);
        return redirect()->route('admin.services.index')->with('success', 'Servizio creato.');
    }

    public function edit(Service $service)
    {
        return view('admin.services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $validated = $request->validate([
            'type' => 'required|in:prodotto,consulenza',
            'name' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string',
            'price_from' => 'nullable|numeric|min:0',
            'price_to' => 'nullable|numeric|min:0',
            'price_unit' => 'nullable|string|max:50',
            'is_active' => 'boolean',
            'sort_order' => 'integer',
        ]);
        $validated['is_active'] = $request->boolean('is_active');
        $service->update($validated);
        return redirect()->route('admin.services.index')->with('success', 'Servizio aggiornato.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('admin.services.index')->with('success', 'Servizio eliminato.');
    }
}
