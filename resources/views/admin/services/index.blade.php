@extends('layouts.admin')

@section('title', 'Prodotti & Consulenze')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-heading font-bold text-primary-dark">Prodotti & Consulenze</h2>
            <p class="text-sm text-gray-500 mt-1">Gestisci i servizi e le consulenze offerte.</p>
        </div>
        <a href="{{ route('admin.services.create') }}" class="btn-primary inline-flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nuovo servizio
        </a>
    </div>

    {{-- Filter tabs --}}
    <div class="flex gap-2">
        <a href="{{ route('admin.services.index') }}"
           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ !request('type') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Tutti
        </a>
        <a href="{{ route('admin.services.index', ['type' => 'prodotto']) }}"
           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('type') === 'prodotto' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Prodotti
        </a>
        <a href="{{ route('admin.services.index', ['type' => 'consulenza']) }}"
           class="px-4 py-2 rounded-lg text-sm font-medium transition-colors {{ request('type') === 'consulenza' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Consulenze
        </a>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Nome</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Tipo</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Descrizione</th>
                    <th class="text-left px-6 py-3 font-semibold text-gray-600">Prezzo</th>
                    <th class="text-center px-6 py-3 font-semibold text-gray-600">Attivo</th>
                    <th class="text-center px-6 py-3 font-semibold text-gray-600">Ordine</th>
                    <th class="text-right px-6 py-3 font-semibold text-gray-600">Azioni</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($services as $service)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-gray-900">{{ $service->name }}</td>
                        <td class="px-6 py-4">
                            @if($service->type === 'prodotto')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-primary/10 text-primary">Prodotto</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800">Consulenza</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-gray-500 max-w-xs truncate">{{ Str::limit($service->short_description, 60) }}</td>
                        <td class="px-6 py-4 text-gray-600">
                            @if($service->price_from && $service->price_to)
                                &euro;{{ number_format($service->price_from, 0, ',', '.') }} &ndash; {{ number_format($service->price_to, 0, ',', '.') }}
                                @if($service->price_unit) / {{ $service->price_unit }} @endif
                            @elseif($service->price_from)
                                da &euro;{{ number_format($service->price_from, 0, ',', '.') }}
                                @if($service->price_unit) / {{ $service->price_unit }} @endif
                            @else
                                <span class="text-gray-400">&mdash;</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($service->is_active)
                                <span class="inline-flex items-center gap-1 text-green-600">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-gray-400">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center text-gray-500">{{ $service->sort_order }}</td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.services.edit', $service) }}"
                                   class="text-gray-400 hover:text-primary transition" title="Modifica">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                </a>
                                <form method="POST" action="{{ route('admin.services.destroy', $service) }}"
                                      onsubmit="return confirm('Sei sicuro di voler eliminare questo servizio?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-500 transition" title="Elimina">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            Nessun servizio trovato. <a href="{{ route('admin.services.create') }}" class="text-primary hover:underline">Crea il primo.</a>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($services->hasPages())
        <div class="mt-4">
            {{ $services->withQueryString()->links() }}
        </div>
    @endif
</div>
@endsection
