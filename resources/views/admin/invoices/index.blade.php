@extends('layouts.admin')

@section('title', 'Fatture SaaS')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-heading font-bold text-gray-900 mb-1">Fatture SaaS</h1>
            <p class="text-sm text-gray-500">Fatture per sottoscrizioni SaaS.</p>
        </div>
        <a href="{{ route('admin.invoices.create') }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nuova Fattura
        </a>
    </div>

    {{-- Filters --}}
    <form method="GET" class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <div class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tipo</label>
                <select name="type" class="text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    <option value="tutte" {{ request('type') == 'tutte' ? 'selected' : '' }}>Tutte</option>
                    <option value="emessa" {{ request('type', 'emessa') == 'emessa' ? 'selected' : '' }}>Emesse</option>
                    <option value="ricevuta" {{ request('type') == 'ricevuta' ? 'selected' : '' }}>Ricevute</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Stato</label>
                <select name="status" class="text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    <option value="">Tutti</option>
                    <option value="bozza" {{ request('status') == 'bozza' ? 'selected' : '' }}>Bozza</option>
                    <option value="inviata" {{ request('status') == 'inviata' ? 'selected' : '' }}>Inviata</option>
                    <option value="pagata" {{ request('status') == 'pagata' ? 'selected' : '' }}>Pagata</option>
                    <option value="scaduta" {{ request('status') == 'scaduta' ? 'selected' : '' }}>Scaduta</option>
                    <option value="annullata" {{ request('status') == 'annullata' ? 'selected' : '' }}>Annullata</option>
                </select>
            </div>
            <div class="flex-1 min-w-[200px]">
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Cerca</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Numero, cliente, email..."
                    class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-lg hover:bg-gray-900 transition-colors">
                Filtra
            </button>
            @if(request()->hasAny(['type', 'status', 'search']))
                <a href="{{ route('admin.invoices.index') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">Reset</a>
            @endif
        </div>
    </form>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-blue-500 uppercase tracking-wider">Emesse non pagate</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">&euro; {{ number_format($totals['emesse_non_pagate'], 2, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-amber-500 uppercase tracking-wider">Ricevute non pagate</p>
            <p class="text-2xl font-bold text-gray-900 mt-1">&euro; {{ number_format($totals['ricevute_non_pagate'], 2, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-red-500 uppercase tracking-wider">Scadute</p>
            <p class="text-2xl font-bold text-red-600 mt-1">{{ $totals['scadute'] }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-green-500 uppercase tracking-wider">Pagate questo mese</p>
            <p class="text-2xl font-bold text-green-600 mt-1">&euro; {{ number_format($totals['pagate_mese'], 2, ',', '.') }}</p>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Numero</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Cliente</th>
                        <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Totale</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Stato</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Emissione</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Scadenza</th>
                        <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Azioni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($invoices as $invoice)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 font-medium text-gray-900">
                                <a href="{{ route('admin.invoices.show', $invoice) }}" class="hover:text-primary">{{ $invoice->invoice_number }}</a>
                            </td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-full {{ $invoice->type === 'emessa' ? 'bg-blue-100 text-blue-700' : 'bg-amber-100 text-amber-700' }}">
                                    {{ $invoice->type === 'emessa' ? 'Emessa' : 'Ricevuta' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ $invoice->client_name }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-gray-900">&euro; {{ number_format($invoice->total, 2, ',', '.') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-full {{ $invoice->status_color }}">
                                    {{ $invoice->status_label }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-500">{{ $invoice->issue_date->format('d/m/Y') }}</td>
                            <td class="px-4 py-3 text-gray-500 {{ $invoice->status !== 'pagata' && $invoice->due_date->isPast() ? 'text-red-600 font-semibold' : '' }}">
                                {{ $invoice->due_date->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('admin.invoices.show', $invoice) }}" class="p-1.5 rounded hover:bg-gray-100 text-gray-400 hover:text-gray-600" title="Visualizza">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.invoices.edit', $invoice) }}" class="p-1.5 rounded hover:bg-gray-100 text-gray-400 hover:text-gray-600" title="Modifica">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.invoices.destroy', $invoice) }}" class="inline" onsubmit="return confirm('Eliminare questa fattura?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="p-1.5 rounded hover:bg-red-50 text-gray-400 hover:text-red-600" title="Elimina">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-4 py-8 text-center text-gray-400">Nessuna fattura trovata.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($invoices->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $invoices->links() }}
            </div>
        @endif
    </div>
@endsection
