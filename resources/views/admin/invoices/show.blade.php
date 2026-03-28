@extends('layouts.admin')

@section('title', 'Fattura ' . $invoice->invoice_number)

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.invoices.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-heading font-bold text-gray-900">{{ $invoice->invoice_number }}</h1>
                <p class="text-sm text-gray-500">
                    {{ $invoice->type === 'emessa' ? 'Fattura emessa' : 'Fattura ricevuta' }} &middot;
                    Creata il {{ $invoice->created_at->format('d/m/Y') }}
                </p>
            </div>
        </div>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.invoices.edit', $invoice) }}"
                class="inline-flex items-center gap-2 px-4 py-2 border border-gray-300 text-sm font-semibold rounded-lg hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                Modifica
            </a>
            <form method="POST" action="{{ route('admin.invoices.destroy', $invoice) }}" onsubmit="return confirm('Eliminare questa fattura?')">
                @csrf @method('DELETE')
                <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 border border-red-300 text-red-600 text-sm font-semibold rounded-lg hover:bg-red-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Elimina
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Main Info --}}
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-sm font-heading font-semibold text-gray-900">Dettagli Fattura</h3>
                    <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full {{ $invoice->status_color }}">
                        {{ $invoice->status_label }}
                    </span>
                </div>

                <div class="grid grid-cols-2 gap-4 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-0.5">Tipo</p>
                        <p class="font-medium text-gray-900">{{ $invoice->type === 'emessa' ? 'Emessa' : 'Ricevuta' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-0.5">Valuta</p>
                        <p class="font-medium text-gray-900">{{ $invoice->currency }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-0.5">Data Emissione</p>
                        <p class="font-medium text-gray-900">{{ $invoice->issue_date->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-0.5">Data Scadenza</p>
                        <p class="font-medium {{ $invoice->status !== 'pagata' && $invoice->due_date->isPast() ? 'text-red-600' : 'text-gray-900' }}">
                            {{ $invoice->due_date->format('d/m/Y') }}
                            @if($invoice->status !== 'pagata' && $invoice->due_date->isPast())
                                <span class="text-xs text-red-500 ml-1">(Scaduta)</span>
                            @endif
                        </p>
                    </div>
                    @if($invoice->paid_date)
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider mb-0.5">Data Pagamento</p>
                            <p class="font-medium text-green-600">{{ $invoice->paid_date->format('d/m/Y') }}</p>
                        </div>
                    @endif
                </div>

                {{-- Amounts --}}
                <div class="mt-6 pt-4 border-t border-gray-100">
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Imponibile</span>
                            <span class="font-medium text-gray-900">&euro; {{ number_format($invoice->amount, 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">IVA</span>
                            <span class="font-medium text-gray-900">&euro; {{ number_format($invoice->vat_amount, 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between pt-2 border-t border-gray-100">
                            <span class="font-semibold text-gray-900">Totale</span>
                            <span class="font-bold text-lg text-gray-900">&euro; {{ number_format($invoice->total, 2, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Description --}}
            @if($invoice->description)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-heading font-semibold text-gray-900 mb-3">Descrizione</h3>
                    <p class="text-sm text-gray-700 whitespace-pre-line">{{ $invoice->description }}</p>
                </div>
            @endif

            {{-- Notes --}}
            @if($invoice->notes)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-heading font-semibold text-gray-900 mb-3">Note interne</h3>
                    <p class="text-sm text-gray-700 whitespace-pre-line">{{ $invoice->notes }}</p>
                </div>
            @endif
        </div>

        {{-- Sidebar --}}
        <div class="space-y-6">
            {{-- Client Info --}}
            <div class="bg-white rounded-xl border border-gray-200 p-6">
                <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Cliente</h3>
                <div class="space-y-3 text-sm">
                    <div>
                        <p class="text-gray-400 text-xs uppercase tracking-wider mb-0.5">Nome</p>
                        <p class="font-medium text-gray-900">{{ $invoice->client_name }}</p>
                    </div>
                    @if($invoice->client_email)
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider mb-0.5">Email</p>
                            <p class="text-gray-700">{{ $invoice->client_email }}</p>
                        </div>
                    @endif
                    @if($invoice->client_vat)
                        <div>
                            <p class="text-gray-400 text-xs uppercase tracking-wider mb-0.5">Partita IVA</p>
                            <p class="text-gray-700">{{ $invoice->client_vat }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Connected Lead --}}
            @if($invoice->lead)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Lead Collegato</h3>
                    <a href="{{ route('admin.leads.show', $invoice->lead) }}" class="block p-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                        <p class="text-sm font-medium text-gray-900">{{ $invoice->lead->name }}</p>
                        <p class="text-xs text-gray-500 mt-0.5">{{ $invoice->lead->email }}</p>
                        @if($invoice->lead->company)
                            <p class="text-xs text-gray-400 mt-0.5">{{ $invoice->lead->company }}</p>
                        @endif
                    </a>
                </div>
            @endif

            {{-- Cash Flow Entry --}}
            @if($invoice->cashFlowEntry)
                <div class="bg-white rounded-xl border border-gray-200 p-6">
                    <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Movimento Cash Flow</h3>
                    <div class="text-sm space-y-2">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Tipo</span>
                            <span class="font-medium {{ $invoice->cashFlowEntry->type === 'entrata' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $invoice->cashFlowEntry->type === 'entrata' ? 'Entrata' : 'Uscita' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Importo</span>
                            <span class="font-medium text-gray-900">&euro; {{ number_format($invoice->cashFlowEntry->amount, 2, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Data</span>
                            <span class="text-gray-700">{{ $invoice->cashFlowEntry->date->format('d/m/Y') }}</span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
