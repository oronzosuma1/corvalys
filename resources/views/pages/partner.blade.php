@extends('layouts.app')

@section('title', 'Programma Partner — Corvalys')

@section('content')

{{-- ========== HERO ========== --}}
<section class="bg-gradient-to-br from-navy to-primary py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <span class="inline-block bg-white/10 text-white text-xs font-semibold px-4 py-1.5 rounded-full mb-6">
            Programma Partner
        </span>
        <h1 class="font-heading text-4xl sm:text-5xl font-bold text-white leading-tight">
            Programma Partner Corvalys
        </h1>
        <p class="mt-6 text-xl text-gray-300 max-w-2xl mx-auto">
            Porta l&rsquo;AI nelle PMI dei tuoi clienti e guadagna il 20% ricorrente. Formazione, supporto e dashboard dedicata.
        </p>
    </div>
</section>

{{-- ========== BENEFITS ========== --}}
<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="section-title">Perch&eacute; diventare Partner</h2>
            <p class="section-sub mt-4">Vantaggi concreti per studi professionali, consulenti IT e system integrator.</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            {{-- Benefit 1 --}}
            <div class="card text-center">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy">20% MRR ricorrente</h3>
                <p class="mt-2 text-gray-600 text-sm">Commissione del 20% su ogni cliente referenziato, per tutta la durata del contratto.</p>
            </div>

            {{-- Benefit 2 --}}
            <div class="card text-center">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy">Dashboard dedicata</h3>
                <p class="mt-2 text-gray-600 text-sm">Monitora clienti, commissioni e performance dalla tua area partner personale.</p>
            </div>

            {{-- Benefit 3 --}}
            <div class="card text-center">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy">Formazione completa</h3>
                <p class="mt-2 text-gray-600 text-sm">Accesso a materiali formativi, webinar e certificazione partner Corvalys.</p>
            </div>

            {{-- Benefit 4 --}}
            <div class="card text-center">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy">Badge Partner</h3>
                <p class="mt-2 text-gray-600 text-sm">Badge verificato da mostrare sul tuo sito e materiali commerciali.</p>
            </div>
        </div>
    </div>
</section>

{{-- ========== HOW IT WORKS ========== --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-14">
            <h2 class="section-title">Come funziona</h2>
            <p class="section-sub mt-4">Tre semplici passaggi per iniziare a guadagnare.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            @foreach([
                ['1', 'Registrati', 'Compila il form qui sotto con i dati del tuo studio. Ti rispondiamo entro 48 ore.'],
                ['2', 'Formazione', 'Accedi ai materiali formativi e partecipa al webinar onboarding con il team Corvalys.'],
                ['3', 'Referenzia e guadagna', 'Presenta Corvalys ai tuoi clienti e inizia a guadagnare il 20% su ogni sottoscrizione.'],
            ] as $step)
                <div class="text-center">
                    <div class="w-16 h-16 bg-primary text-white rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="font-heading text-2xl font-bold">{{ $step[0] }}</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-navy">{{ $step[1] }}</h3>
                    <p class="mt-2 text-gray-600 text-sm">{{ $step[2] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ========== PARTNER FORM ========== --}}
<section class="bg-white py-20">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="section-title">Diventa Partner</h2>
            <p class="section-sub mt-4">Compila il form e ti ricontatteremo entro 48 ore.</p>
        </div>

        {{-- Success flash --}}
        @if(session('success'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition
                class="mb-8 bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg flex items-center justify-between"
            >
                <p class="text-sm font-medium">{{ session('success') }}</p>
                <button @click="show = false" class="text-green-600 hover:text-green-800">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        @endif

        <form method="POST" action="{{ route('partner.store') }}" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Nome --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nome e cognome *</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Studio name --}}
            <div>
                <label for="studio_name" class="block text-sm font-medium text-gray-700 mb-1">Nome dello studio / azienda *</label>
                <input type="text" name="studio_name" id="studio_name" value="{{ old('studio_name') }}" required
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                @error('studio_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Clients count --}}
            <div>
                <label for="clients_count" class="block text-sm font-medium text-gray-700 mb-1">Numero clienti gestiti</label>
                <select name="clients_count" id="clients_count"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                    <option value="">Seleziona</option>
                    <option value="1-10" {{ old('clients_count') === '1-10' ? 'selected' : '' }}>1 &ndash; 10</option>
                    <option value="11-50" {{ old('clients_count') === '11-50' ? 'selected' : '' }}>11 &ndash; 50</option>
                    <option value="51-200" {{ old('clients_count') === '51-200' ? 'selected' : '' }}>51 &ndash; 200</option>
                    <option value="200+" {{ old('clients_count') === '200+' ? 'selected' : '' }}>200+</option>
                </select>
                @error('clients_count')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Message --}}
            <div>
                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Messaggio</label>
                <textarea name="message" id="message" rows="4"
                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                    placeholder="Raccontaci del tuo studio e dei tuoi clienti...">{{ old('message') }}</textarea>
                @error('message')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Submit --}}
            <div class="text-center">
                <button type="submit" class="btn-primary">
                    Invia candidatura
                </button>
            </div>
        </form>
    </div>
</section>

@endsection
