@extends('layouts.admin')

@section('title', 'Cash Flow')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-heading font-bold text-gray-900 mb-1">Cash Flow</h1>
            <p class="text-sm text-gray-500">Panoramica entrate e uscite degli ultimi 12 mesi.</p>
        </div>
        <a href="{{ route('admin.cashflow.detail') }}"
            class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 text-sm font-semibold rounded-lg hover:bg-gray-50 transition-colors">
            Vedi dettaglio completo &rarr;
        </a>
    </div>

    {{-- Summary Row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Saldo Attuale</p>
            <p class="text-2xl font-bold mt-1 {{ $saldoAttuale >= 0 ? 'text-green-600' : 'text-red-600' }}">
                &euro; {{ number_format($saldoAttuale, 2, ',', '.') }}
            </p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-green-500 uppercase tracking-wider">Entrate Mese</p>
            <p class="text-2xl font-bold text-green-600 mt-1">&euro; {{ number_format($entrateCurrentMonth, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-red-500 uppercase tracking-wider">Uscite Mese</p>
            <p class="text-2xl font-bold text-red-600 mt-1">&euro; {{ number_format($usciteCurrentMonth, 2, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-blue-500 uppercase tracking-wider">Previsione Pross. Mese</p>
            <p class="text-2xl font-bold mt-1 {{ $previsioneProssimoMese >= 0 ? 'text-blue-600' : 'text-red-600' }}">
                &euro; {{ number_format($previsioneProssimoMese, 2, ',', '.') }}
            </p>
        </div>
    </div>

    {{-- Monthly Chart --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6 mb-8">
        <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Andamento Mensile</h3>
        <div class="flex items-end gap-1 h-48">
            @foreach($monthlyData as $data)
                <div class="flex-1 flex flex-col items-center gap-1 h-full justify-end">
                    {{-- Entrate bar --}}
                    <div class="w-full flex gap-0.5 items-end flex-1">
                        <div class="flex-1 bg-green-400 rounded-t transition-all" title="Entrate: {{ number_format($data['entrate'], 2, ',', '.') }} EUR"
                            style="height: {{ $maxValue > 0 ? ($data['entrate'] / $maxValue * 100) : 0 }}%"></div>
                        <div class="flex-1 bg-red-400 rounded-t transition-all" title="Uscite: {{ number_format($data['uscite'], 2, ',', '.') }} EUR"
                            style="height: {{ $maxValue > 0 ? ($data['uscite'] / $maxValue * 100) : 0 }}%"></div>
                    </div>
                    <span class="text-[9px] text-gray-400 font-medium whitespace-nowrap">{{ $data['label'] }}</span>
                </div>
            @endforeach
        </div>
        <div class="flex items-center gap-4 mt-4 text-xs text-gray-500">
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-sm bg-green-400"></span> Entrate
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-sm bg-red-400"></span> Uscite
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Upcoming Payments --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-heading font-semibold text-gray-900">Pagamenti in Scadenza</h3>
                <a href="{{ route('admin.invoices.index', ['status' => 'inviata']) }}" class="text-xs text-primary hover:text-primary-dark font-medium">Vedi fatture &rarr;</a>
            </div>
            @forelse($upcomingPayments as $payment)
                <a href="{{ route('admin.invoices.show', $payment) }}" class="block py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }} hover:bg-gray-50 -mx-2 px-2 rounded transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $payment->client_name }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $payment->invoice_number }} &middot; {{ $payment->type === 'emessa' ? 'Emessa' : 'Ricevuta' }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-semibold text-gray-900">&euro; {{ number_format($payment->total, 2, ',', '.') }}</p>
                            <p class="text-[10px] {{ $payment->due_date->isPast() ? 'text-red-500 font-semibold' : 'text-gray-400' }} mt-0.5">
                                Scad. {{ $payment->due_date->format('d/m/Y') }}
                            </p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-400 text-sm py-4">Nessun pagamento in scadenza nei prossimi 30 giorni.</p>
            @endforelse
        </div>

        {{-- Quick Add Entry --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Aggiungi Movimento</h3>

            <form method="POST" action="{{ route('admin.cashflow.store') }}">
                @csrf
                <input type="hidden" name="redirect" value="index">

                <div class="space-y-3">
                    <div class="grid grid-cols-2 gap-3">
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
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Descrizione *</label>
                        <input type="text" name="description" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required placeholder="Breve descrizione...">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Importo *</label>
                            <input type="number" name="amount" step="0.01" min="0.01" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Data *</label>
                            <input type="date" name="date" value="{{ now()->format('Y-m-d') }}" class="w-full text-sm border-gray-300 rounded-lg focus:ring-primary focus:border-primary" required>
                        </div>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-colors">
                        Aggiungi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Recent Entries --}}
    @if($recentEntries->isNotEmpty())
        <div class="bg-white rounded-xl border border-gray-200 p-6 mt-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-heading font-semibold text-gray-900">Movimenti Recenti</h3>
                <a href="{{ route('admin.cashflow.detail') }}" class="text-xs text-primary hover:text-primary-dark font-medium">Vedi tutti &rarr;</a>
            </div>
            <div class="divide-y divide-gray-50">
                @foreach($recentEntries as $entry)
                    <div class="flex items-center justify-between py-3">
                        <div class="flex items-center gap-3">
                            <span class="w-2 h-2 rounded-full {{ $entry->type === 'entrata' ? 'bg-green-400' : 'bg-red-400' }}"></span>
                            <div>
                                <p class="text-sm font-medium text-gray-900">{{ $entry->description }}</p>
                                <p class="text-xs text-gray-400">{{ $entry->category }} &middot; {{ $entry->date->format('d/m/Y') }}</p>
                            </div>
                        </div>
                        <p class="text-sm font-semibold {{ $entry->type === 'entrata' ? 'text-green-600' : 'text-red-600' }}">
                            {{ $entry->type === 'entrata' ? '+' : '-' }}&euro; {{ number_format($entry->amount, 2, ',', '.') }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@endsection
