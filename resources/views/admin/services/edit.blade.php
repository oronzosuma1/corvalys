@extends('layouts.admin')

@section('title', 'Modifica Servizio')

@section('content')
<div class="max-w-3xl">
    {{-- Header --}}
    <div class="mb-8">
        <a href="{{ route('admin.services.index') }}" class="text-sm text-gray-500 hover:text-primary transition inline-flex items-center gap-1 mb-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Torna alla lista
        </a>
        <h2 class="text-2xl font-heading font-bold text-primary-dark">Modifica: {{ $service->name }}</h2>
    </div>

    <form method="POST" action="{{ route('admin.services.update', $service) }}" class="space-y-6">
        @csrf
        @method('PUT')

        @include('admin.services._form', ['service' => $service])

        <div class="flex items-center gap-4 pt-4">
            <button type="submit" class="btn-primary">Aggiorna servizio</button>
            <a href="{{ route('admin.services.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Annulla</a>
        </div>
    </form>
</div>
@endsection
