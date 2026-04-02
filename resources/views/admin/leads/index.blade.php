@extends('layouts.admin')

@section('title', 'Lead')

@section('content')
    {{-- Area Tabs --}}
    <div class="flex gap-2 mb-4">
        <a href="{{ route('admin.leads.index', request()->except('area')) }}"
            class="px-4 py-2 rounded-full text-sm font-medium transition {{ !request('area') ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Tutti
        </a>
        <a href="{{ route('admin.leads.index', ['area' => 'saas'] + request()->except('area')) }}"
            class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('area') === 'saas' ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            SaaS
        </a>
        <a href="{{ route('admin.leads.index', ['area' => 'consulenza'] + request()->except('area')) }}"
            class="px-4 py-2 rounded-full text-sm font-medium transition {{ request('area') === 'consulenza' ? 'bg-amber text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
            Consulenza
        </a>
    </div>

    {{-- Filter Bar --}}
    <div class="bg-white rounded-xl border border-gray-200/60 p-4 mb-6">
        <form method="GET" action="{{ route('admin.leads.index') }}" class="flex flex-wrap items-center gap-3">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cerca per nome, email, azienda..."
                    class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
            </div>
            <div>
                <select name="status" class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="">Tutti gli stati</option>
                    <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                    <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                    <option value="in_proposta" {{ request('status') === 'in_proposta' ? 'selected' : '' }}>In proposta</option>
                    <option value="converted" {{ request('status') === 'converted' ? 'selected' : '' }}>Converted</option>
                    <option value="lost" {{ request('status') === 'lost' ? 'selected' : '' }}>Lost</option>
                    <option value="spam" {{ request('status') === 'spam' ? 'selected' : '' }}>Spam</option>
                </select>
            </div>
            <div>
                <select name="service_type" class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="">Tutti i servizi</option>
                    <option value="strategy" {{ request('service_type') === 'strategy' ? 'selected' : '' }}>Strategy</option>
                    <option value="development" {{ request('service_type') === 'development' ? 'selected' : '' }}>Development</option>
                    <option value="industry40" {{ request('service_type') === 'industry40' ? 'selected' : '' }}>Industry 4.0</option>
                    <option value="compliance" {{ request('service_type') === 'compliance' ? 'selected' : '' }}>Compliance</option>
                    <option value="supplychain" {{ request('service_type') === 'supplychain' ? 'selected' : '' }}>Supply Chain</option>
                    <option value="llm" {{ request('service_type') === 'llm' ? 'selected' : '' }}>LLM</option>
                    <option value="general" {{ request('service_type') === 'general' ? 'selected' : '' }}>General</option>
                </select>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Filtra
            </button>
            @if(request('search') || request('status') || request('service_type'))
                <a href="{{ route('admin.leads.index') }}" class="text-sm text-gray-500 hover:text-gray-700">Reset</a>
            @endif
        </form>
    </div>

    {{-- Leads Table --}}
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-gray-50/80">
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Nome</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Azienda</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Servizio</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Tech Maturity</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Budget</th>
                        <th class="text-center px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Auto-Assessment</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Stato</th>
                        <th class="text-left px-5 py-3 text-xs font-medium text-gray-500 uppercase tracking-wide">Data</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($leads ?? [] as $lead)
                        <tr class="hover:bg-gray-50/50 transition-colors cursor-pointer" onclick="window.location='{{ route('admin.leads.show', $lead) }}'">
                            <td class="px-5 py-3">
                                <div class="font-medium text-gray-900">{{ $lead->name }}</div>
                                <div class="text-xs text-gray-400">{{ $lead->email }}</div>
                            </td>
                            <td class="px-5 py-3 text-gray-600">{{ $lead->company ?? '-' }}</td>
                            <td class="px-5 py-3">
                                @if($lead->service_type)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700">{{ $lead->service_type }}</span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @php
                                    $maturityLabel = $lead->getTechMaturityLabel();
                                    $maturityColors = [
                                        'Low' => 'bg-red-100 text-red-700',
                                        'Medium' => 'bg-amber-100 text-amber-700',
                                        'High' => 'bg-green-100 text-green-700',
                                        'N/A' => 'bg-gray-100 text-gray-500',
                                    ];
                                    $maturityColor = $maturityColors[$maturityLabel] ?? 'bg-gray-100 text-gray-500';
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $maturityColor }}">
                                    @if($lead->tech_maturity_score !== null)
                                        {{ $lead->tech_maturity_score }}/10 &middot; {{ $maturityLabel }}
                                    @else
                                        N/A
                                    @endif
                                </span>
                            </td>
                            <td class="px-5 py-3 text-gray-600 text-xs">{{ $lead->budget_label }}</td>
                            <td class="px-5 py-3 text-center">
                                @if($lead->claude_auto_assessment)
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-green-100 text-green-600" title="Auto-assessment disponibile">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </span>
                                @else
                                    <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-gray-100 text-gray-400" title="Nessun auto-assessment">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </span>
                                @endif
                            </td>
                            <td class="px-5 py-3">
                                @php
                                    $statusColors = [
                                        'new' => 'bg-blue-100 text-blue-700',
                                        'contacted' => 'bg-amber-100 text-amber-700',
                                        'in_proposta' => 'bg-purple-100 text-purple-700',
                                        'converted' => 'bg-green-100 text-green-700',
                                        'lost' => 'bg-gray-100 text-gray-600',
                                        'spam' => 'bg-red-100 text-red-700',
                                    ];
                                    $color = $statusColors[$lead->status] ?? 'bg-gray-100 text-gray-600';
                                @endphp
                                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $color }}">{{ $lead->status_label }}</span>
                            </td>
                            <td class="px-5 py-3 text-xs text-gray-400">{{ $lead->created_at->format('d/m/Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="8" class="px-5 py-8 text-center text-gray-400 text-sm">Nessun lead trovato</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if(isset($leads) && $leads->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">
                {{ $leads->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection
