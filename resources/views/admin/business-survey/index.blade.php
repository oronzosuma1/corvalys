@extends('layouts.admin')

@section('title', 'Business Survey Responses')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-heading font-bold text-gray-900 mb-1">Business Survey Responses</h1>
            <p class="text-sm text-gray-500">{{ $surveys->total() }} responses collected</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.business-survey.analytics') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                Analytics
            </a>
            <a href="{{ route('admin.business-survey.export') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Export CSV
            </a>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <select name="sector" class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white">
            <option value="">All Sectors</option>
            @foreach($sectors as $val => $label)
                <option value="{{ $val }}" {{ request('sector') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>

        <select name="company_size" class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white">
            <option value="">All Sizes</option>
            @foreach($sizes as $val => $label)
                <option value="{{ $val }}" {{ request('company_size') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>

        <input type="text" name="country" value="{{ request('country') }}" placeholder="Country"
               class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white w-36">

        <select name="cluster" class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white">
            <option value="">All Clusters</option>
            @foreach([
                'admin_automation' => 'Admin Automation',
                'finance_automation' => 'Finance & Invoice',
                'customer_service_automation' => 'Customer Service',
                'sales_automation' => 'Sales Automation',
                'reporting_bi_automation' => 'Reporting & BI',
                'supply_chain_automation' => 'Supply Chain',
                'compliance_automation' => 'Compliance',
                'marketing_automation' => 'Marketing',
            ] as $val => $label)
                <option value="{{ $val }}" {{ request('cluster') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>

        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-semibold hover:bg-gray-700 transition-colors">Filter</button>
        @if(request()->hasAny(['sector', 'company_size', 'country', 'cluster']))
            <a href="{{ route('admin.business-survey.index') }}" class="px-4 py-2 border border-gray-200 text-gray-500 rounded-lg text-sm hover:bg-gray-50 transition-colors">Clear</a>
        @endif
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Sector</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Size</th>
                    <th class="text-left px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Country</th>
                    <th class="text-left px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Pain</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Automation</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Readiness</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Lead</th>
                    <th class="text-right px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($surveys as $r)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3.5 text-xs text-gray-500">{{ $r->created_at?->format('d M Y') }}</td>
                    <td class="px-5 py-3.5 text-sm text-gray-700">{{ \App\Models\BusinessSurvey::sectorLabels()[$r->sector] ?? $r->sector }}</td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-full bg-gray-100 text-gray-600">{{ str_replace('_', '-', $r->company_size) }}</span>
                    </td>
                    <td class="px-3 py-3.5 text-sm text-gray-700">{{ $r->country }}</td>
                    <td class="px-3 py-3.5 text-sm text-gray-700">{{ $r->respondent_role }}</td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="inline-block px-2.5 py-0.5 text-[10px] font-semibold rounded-full
                            @if($r->pain_score >= 8) bg-red-100 text-red-700
                            @elseif($r->pain_score >= 6) bg-amber-100 text-amber-700
                            @elseif($r->pain_score >= 4) bg-blue-100 text-blue-700
                            @else bg-gray-100 text-gray-600
                            @endif">
                            {{ number_format($r->pain_score, 1) }}
                        </span>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="inline-block px-2.5 py-0.5 text-[10px] font-semibold rounded-full
                            @if($r->automation_potential >= 8) bg-green-100 text-green-700
                            @elseif($r->automation_potential >= 6) bg-blue-100 text-blue-700
                            @elseif($r->automation_potential >= 4) bg-amber-100 text-amber-700
                            @else bg-gray-100 text-gray-600
                            @endif">
                            {{ number_format($r->automation_potential, 1) }}
                        </span>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="inline-block px-2.5 py-0.5 text-[10px] font-semibold rounded-full
                            @if($r->commercial_readiness >= 8) bg-green-100 text-green-700
                            @elseif($r->commercial_readiness >= 6) bg-blue-100 text-blue-700
                            @elseif($r->commercial_readiness >= 4) bg-amber-100 text-amber-700
                            @else bg-gray-100 text-gray-600
                            @endif">
                            {{ number_format($r->commercial_readiness, 1) }}
                        </span>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        @if($r->is_lead)
                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-green-500"></span>
                        @else
                            <span class="text-xs text-gray-300">&mdash;</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-right">
                        <a href="{{ route('admin.business-survey.show', $r) }}" class="text-primary hover:text-primary-dark text-xs font-semibold transition-colors">View</a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10" class="px-5 py-12 text-center text-gray-400">
                        <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                        No survey responses yet.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($surveys->hasPages())
        <div class="mt-6">{{ $surveys->withQueryString()->links() }}</div>
    @endif
@endsection
