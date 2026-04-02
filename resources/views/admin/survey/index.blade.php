@extends('layouts.admin')

@section('title', 'AI Readiness Surveys')

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-heading font-bold text-gray-900 mb-1">AI Readiness Surveys</h1>
            <p class="text-sm text-gray-500">{{ $surveys->total() }} responses collected</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.survey.analytics') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-primary text-white rounded-lg text-sm font-semibold hover:bg-primary-dark transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                Analytics
            </a>
            <a href="{{ route('admin.survey.export') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
                Export CSV
            </a>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" class="flex flex-wrap gap-3 mb-6">
        <select name="size" class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white">
            <option value="">All Sizes</option>
            @foreach(['1-9' => 'Micro (1-9)', '10-49' => 'Small (10-49)', '50-249' => 'Medium (50-249)', '250+' => 'Large (250+)'] as $val => $label)
                <option value="{{ $val }}" {{ request('size') === $val ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <select name="industry" class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white">
            <option value="">All Industries</option>
            @foreach($industries as $ind)
                <option value="{{ $ind }}" {{ request('industry') === $ind ? 'selected' : '' }}>{{ $ind }}</option>
            @endforeach
        </select>
        <select name="level" class="px-3 py-2 border border-gray-200 rounded-lg text-sm bg-white">
            <option value="">All Levels</option>
            <option value="excellent" {{ request('level') === 'excellent' ? 'selected' : '' }}>Excellent (4.5+)</option>
            <option value="good" {{ request('level') === 'good' ? 'selected' : '' }}>Good (3.5-4.4)</option>
            <option value="moderate" {{ request('level') === 'moderate' ? 'selected' : '' }}>Moderate (2.5-3.4)</option>
            <option value="low" {{ request('level') === 'low' ? 'selected' : '' }}>Low (1.5-2.4)</option>
            <option value="very_low" {{ request('level') === 'very_low' ? 'selected' : '' }}>Very Low (&lt;1.5)</option>
        </select>
        <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg text-sm font-semibold hover:bg-gray-700 transition-colors">Filter</button>
        @if(request()->hasAny(['size', 'industry', 'level']))
            <a href="{{ route('admin.survey.index') }}" class="px-4 py-2 border border-gray-200 text-gray-500 rounded-lg text-sm hover:bg-gray-50 transition-colors">Clear</a>
        @endif
    </form>

    {{-- Table --}}
    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-200">
                    <th class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Company</th>
                    <th class="text-left px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Contact</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Size</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Score</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Level</th>
                    <th class="text-center px-3 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Consultation</th>
                    <th class="text-right px-5 py-3 text-[11px] font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
                @forelse($surveys as $s)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-5 py-3.5">
                        <a href="{{ route('admin.survey.show', $s) }}" class="font-medium text-gray-900 hover:text-primary transition-colors">{{ $s->company_name }}</a>
                        <p class="text-xs text-gray-400 mt-0.5">{{ $s->industry }}</p>
                    </td>
                    <td class="px-5 py-3.5">
                        <p class="text-gray-700">{{ $s->contact_name }}</p>
                        <p class="text-xs text-gray-400">{{ $s->contact_email }}</p>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="inline-block px-2 py-0.5 text-[10px] font-semibold rounded-full bg-gray-100 text-gray-600">{{ $s->company_size }}</span>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="text-lg font-bold
                            @if($s->overall_score >= 4) text-green-600
                            @elseif($s->overall_score >= 3) text-amber-600
                            @else text-red-500
                            @endif">
                            {{ number_format($s->overall_score, 1) }}
                        </span>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        <span class="inline-block px-2.5 py-0.5 text-[10px] font-semibold rounded-full
                            @if($s->overall_score >= 4.5) bg-green-100 text-green-700
                            @elseif($s->overall_score >= 3.5) bg-blue-100 text-blue-700
                            @elseif($s->overall_score >= 2.5) bg-amber-100 text-amber-700
                            @elseif($s->overall_score >= 1.5) bg-orange-100 text-orange-700
                            @else bg-red-100 text-red-600
                            @endif">
                            {{ $s->readiness_level }}
                        </span>
                    </td>
                    <td class="px-3 py-3.5 text-center">
                        @if($s->wants_consultation)
                            <span class="inline-flex items-center gap-1 text-xs font-semibold text-green-600">
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd"/></svg>
                                Yes
                            </span>
                        @else
                            <span class="text-xs text-gray-400">&mdash;</span>
                        @endif
                    </td>
                    <td class="px-5 py-3.5 text-right text-xs text-gray-400">{{ $s->completed_at?->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-5 py-12 text-center text-gray-400">
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
