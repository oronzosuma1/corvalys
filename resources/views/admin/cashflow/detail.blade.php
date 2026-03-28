@extends('layouts.admin')

@section('title', 'Cash Flow — Dettaglio')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.cashflow.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-heading font-bold text-gray-900">Dettaglio Cash Flow</h1>
                <p class="text-sm text-gray-500">Tutti i movimenti finanziari registrati.</p>
            </div>
        </div>
        <button onclick="document.getElementById('newEntryForm').classList.toggle('hidden')"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-colors shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Nuova Voce
        </button>
    </div>

    {{-- Inline New Entry Form --}}
    <div id="newEntryForm" class="bg-white rounded-xl border border-gray-200 p-6 mb-6 hidden">
        <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Nuovo Movimento</h3>
        <form method="POST" action="{{ route('admin.cashflow.store') }}">
            @csrf
            <input type="hidden" name="redirect" value="detail">

            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tipo *</label>
                    <select name="type" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
                        <option value="entrata">Entrata</option>
                        <option value="uscita">Uscita</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Categoria *</label>
                    <select name="category" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
                        <option value="consulenza">Consulenza</option>
                        <option value="licenze">Licenze</option>
                        <option value="hosting">Hosting</option>
                        <option value="stipendi">Stipendi</option>
                        <option value="tasse">Tasse</option>
                        <option value="altro">Altro</option>
                    </select>
                </div>
                <div class="md:col-span-1 lg:col-span-2">
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Descrizione *</label>
                    <input type="text" name="description" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Importo *</label>
                    <input type="number" name="amount" step="0.01" min="0.01" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Data *</label>
                    <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                <div>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" name="is_recurring" value="1" class="rounded border-gray-300 text-primary focus:ring-primary">
                        Ricorrente
                    </label>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Frequenza</label>
                    <select name="recurring_frequency" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                        <option value="">--</option>
                        <option value="monthly">Mensile</option>
                        <option value="quarterly">Trimestrale</option>
                        <option value="yearly">Annuale</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Note</label>
                    <input type="text" name="notes" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                </div>
            </div>

            <div class="mt-4 flex items-center gap-3">
                <button type="submit" class="px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-colors">
                    Salva
                </button>
                <button type="button" onclick="document.getElementById('newEntryForm').classList.add('hidden')" class="text-sm text-gray-500 hover:text-gray-700">
                    Annulla
                </button>
            </div>
        </form>
    </div>

    {{-- Filters --}}
    <form method="GET" class="bg-white rounded-xl border border-gray-200 p-4 mb-6">
        <div class="flex flex-wrap items-end gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Da</label>
                <input type="date" name="from" value="{{ request('from') }}"
                    class="text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">A</label>
                <input type="date" name="to" value="{{ request('to') }}"
                    class="text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Categoria</label>
                <select name="category" class="text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    <option value="">Tutte</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tipo</label>
                <select name="type" class="text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary">
                    <option value="tutti" {{ request('type') == 'tutti' ? 'selected' : '' }}>Tutti</option>
                    <option value="entrata" {{ request('type') == 'entrata' ? 'selected' : '' }}>Entrate</option>
                    <option value="uscita" {{ request('type') == 'uscita' ? 'selected' : '' }}>Uscite</option>
                </select>
            </div>
            <button type="submit" class="px-4 py-2 bg-gray-800 text-white text-sm font-semibold rounded-lg hover:bg-gray-900 transition-colors">
                Filtra
            </button>
            @if(request()->hasAny(['from', 'to', 'category', 'type']))
                <a href="{{ route('admin.cashflow.detail') }}" class="text-sm text-gray-500 hover:text-gray-700 underline">Reset</a>
            @endif
        </div>
    </form>

    {{-- Summary --}}
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-green-500 uppercase tracking-wider">Totale Entrate</p>
            <p class="text-2xl font-bold text-green-600 mt-1">&euro; {{ number_format($totaleEntrate, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-red-500 uppercase tracking-wider">Totale Uscite</p>
            <p class="text-2xl font-bold text-red-600 mt-1">&euro; {{ number_format($totaleUscite, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Saldo</p>
            <p class="text-2xl font-bold mt-1 {{ ($totaleEntrate - $totaleUscite) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                &euro; {{ number_format($totaleEntrate - $totaleUscite, 2, ',', '.') }}
            </p>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Data</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Categoria</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Descrizione</th>
                        <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Importo</th>
                        <th class="text-left px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Fattura</th>
                        <th class="text-right px-4 py-3 text-xs font-semibold text-gray-500 uppercase tracking-wider">Azioni</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($entries as $entry)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-4 py-3 text-gray-700">{{ $entry->date->format('d/m/Y') }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-full {{ $entry->type === 'entrata' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $entry->type === 'entrata' ? 'Entrata' : 'Uscita' }}
                                </span>
                            </td>
                            <td class="px-4 py-3 text-gray-700">{{ ucfirst($entry->category) }}</td>
                            <td class="px-4 py-3 text-gray-900">
                                {{ $entry->description }}
                                @if($entry->is_recurring)
                                    <span class="text-xs text-blue-500 ml-1" title="Ricorrente {{ $entry->recurring_frequency }}">&#8635;</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right font-semibold {{ $entry->type === 'entrata' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $entry->type === 'entrata' ? '+' : '-' }}&euro; {{ number_format($entry->amount, 2, ',', '.') }}
                            </td>
                            <td class="px-4 py-3">
                                @if($entry->invoice)
                                    <a href="{{ route('admin.invoices.show', $entry->invoice) }}" class="text-primary hover:text-primary-dark text-xs font-medium">
                                        {{ $entry->invoice->invoice_number }}
                                    </a>
                                @else
                                    <span class="text-gray-300">--</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-right">
                                <form method="POST" action="{{ route('admin.cashflow.destroy', $entry) }}" class="inline" onsubmit="return confirm('Eliminare questa voce?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded hover:bg-red-50 text-gray-400 hover:text-red-600" title="Elimina">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-400">Nessun movimento trovato.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($entries->hasPages())
            <div class="px-4 py-3 border-t border-gray-100">
                {{ $entries->links() }}
            </div>
        @endif
    </div>
@endsection
