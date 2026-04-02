@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <h1 class="text-2xl font-heading font-bold text-gray-900 mb-1">Dashboard</h1>
    <p class="text-sm text-gray-500 mb-8">Panoramica attività e lead del sito.</p>

    {{-- Key Stats Row --}}
    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4 mb-8">
        <a href="{{ route('admin.leads.index') }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/40 hover:shadow-md transition-all">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Lead Nuovi</p>
            <p class="text-3xl font-bold text-primary mt-2">{{ $stats['leads_new'] }}</p>
        </a>
        <a href="{{ route('admin.leads.index') }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/40 hover:shadow-md transition-all">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Lead Attivi</p>
            <p class="text-3xl font-bold text-navy mt-2">{{ $stats['leads_active'] }}</p>
        </a>
        <a href="{{ route('admin.leads.index') }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/40 hover:shadow-md transition-all">
            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Lead Totali</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['leads_total'] }}</p>
        </a>
        <a href="{{ route('admin.articles.index') }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/40 hover:shadow-md transition-all">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Articoli</p>
            <p class="text-3xl font-bold text-navy mt-2">{{ $stats['articles'] }}</p>
        </a>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Pubblicati</p>
            <p class="text-3xl font-bold text-primary mt-2">{{ $stats['articles_published'] }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Newsletter</p>
            <p class="text-3xl font-bold text-navy mt-2">{{ $stats['subscribers'] }}</p>
        </div>
        <a href="{{ route('admin.partners.index') }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-amber/40 hover:shadow-md transition-all">
            <p class="text-[11px] font-semibold text-amber/70 uppercase tracking-wider">Partner</p>
            <p class="text-3xl font-bold text-amber mt-2">{{ $stats['partners'] }}</p>
        </a>
    </div>

    {{-- Finanza --}}
    <div class="mb-8">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-sm font-heading font-semibold text-gray-900">Finanza</h2>
            <a href="{{ route('admin.invoices.index') }}" class="text-xs text-primary hover:text-primary-dark font-medium">Vedi fatture &rarr;</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.invoices.index') }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-green-300 hover:shadow-md transition-all">
                <p class="text-[11px] font-semibold text-green-500 uppercase tracking-wider">Fatturato Mese</p>
                <p class="text-3xl font-bold text-green-600 mt-2">&euro; {{ number_format($stats['revenue_month'], 0, ',', '.') }}</p>
            </a>
            <a href="{{ route('admin.invoices.index') }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-red-300 hover:shadow-md transition-all">
                <p class="text-[11px] font-semibold text-red-500 uppercase tracking-wider">Spese Mese</p>
                <p class="text-3xl font-bold text-red-600 mt-2">&euro; {{ number_format($stats['expenses_month'], 0, ',', '.') }}</p>
            </a>
            <a href="{{ route('admin.invoices.index', ['status' => 'scaduta']) }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-red-300 hover:shadow-md transition-all">
                <p class="text-[11px] font-semibold text-red-400 uppercase tracking-wider">Fatture Scadute</p>
                <p class="text-3xl font-bold text-red-600 mt-2">{{ $stats['invoices_overdue'] }}</p>
            </a>
            <a href="{{ route('admin.invoices.index', ['status' => 'inviata']) }}" class="group block bg-white rounded-xl border border-gray-200 p-5 hover:border-blue-300 hover:shadow-md transition-all">
                <p class="text-[11px] font-semibold text-blue-500 uppercase tracking-wider">Fatture in Attesa</p>
                <p class="text-3xl font-bold text-blue-600 mt-2">{{ $stats['invoices_pending'] }}</p>
            </a>
        </div>
    </div>

    {{-- Recent Activity --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Recent Leads --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-heading font-semibold text-gray-900">Lead Recenti</h3>
                <a href="{{ route('admin.leads.index') }}" class="text-xs text-primary hover:text-primary-dark font-medium">Vedi tutti &rarr;</a>
            </div>
            @forelse($recentLeads as $lead)
                <a href="{{ route('admin.leads.show', $lead) }}" class="block py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }} hover:bg-gray-50 -mx-2 px-2 rounded transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $lead->name }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $lead->email }} @if($lead->company)&middot; {{ $lead->company }}@endif</p>
                        </div>
                        <div class="text-right">
                            <span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-full
                                @switch($lead->status)
                                    @case('new') bg-blue-100 text-blue-700 @break
                                    @case('contacted') bg-amber-100 text-amber-700 @break
                                    @case('in_proposta') bg-purple-100 text-purple-700 @break
                                    @case('converted') bg-green-100 text-green-700 @break
                                    @case('lost') bg-gray-100 text-gray-500 @break
                                    @case('spam') bg-red-100 text-red-600 @break
                                @endswitch">
                                {{ $lead->status_label }}
                            </span>
                            <p class="text-[10px] text-gray-400 mt-1">{{ $lead->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-gray-400 text-sm py-4">Nessun lead ancora.</p>
            @endforelse
        </div>

        {{-- Recent Articles --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-heading font-semibold text-gray-900">Articoli Recenti</h3>
                <a href="{{ route('admin.articles.index') }}" class="text-xs text-primary hover:text-primary-dark font-medium">Vedi tutti &rarr;</a>
            </div>
            @forelse($recentArticles as $article)
                <a href="{{ route('admin.articles.edit', $article) }}" class="block py-3 {{ !$loop->last ? 'border-b border-gray-50' : '' }} hover:bg-gray-50 -mx-2 px-2 rounded transition">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ $article->title }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ ucfirst(str_replace('-', ' ', $article->category)) }} &middot; {{ $article->reading_time_min }} min</p>
                        </div>
                        <span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-full {{ $article->is_published ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500' }}">
                            {{ $article->is_published ? 'Pubblicato' : 'Bozza' }}
                        </span>
                    </div>
                </a>
            @empty
                <p class="text-gray-400 text-sm py-4">Nessun articolo ancora.</p>
            @endforelse
        </div>
    </div>
@endsection
