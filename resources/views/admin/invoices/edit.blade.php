@extends('layouts.admin')

@section('title', 'Modifica Fattura')

@section('content')
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.invoices.index') }}" class="text-gray-400 hover:text-gray-600 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <div>
            <h1 class="text-2xl font-heading font-bold text-gray-900">Modifica Fattura {{ $invoice->invoice_number }}</h1>
            <p class="text-sm text-gray-500">Aggiorna i dati della fattura.</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.invoices.update', $invoice) }}" class="bg-white rounded-xl border border-gray-200 p-6">
        @csrf
        @method('PUT')
        @include('admin.invoices._form')

        <div class="mt-6 flex items-center gap-3 pt-4 border-t border-gray-100">
            <button type="submit" class="px-6 py-2.5 bg-primary text-white text-sm font-semibold rounded-lg hover:bg-primary-dark transition-colors shadow-sm">
                Aggiorna Fattura
            </button>
            <a href="{{ route('admin.invoices.index') }}" class="px-4 py-2.5 text-sm text-gray-500 hover:text-gray-700">Annulla</a>
        </div>
    </form>
@endsection
