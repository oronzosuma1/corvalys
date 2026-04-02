@extends('layouts.admin')

@section('title', 'Survey Analytics')

@push('head')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
@endpush

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('admin.survey.index') }}" class="text-sm text-primary hover:text-primary-dark font-medium mb-2 inline-flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                All Surveys
            </a>
            <h1 class="text-2xl font-heading font-bold text-gray-900 mb-1">Survey Analytics</h1>
            <p class="text-sm text-gray-500">Statistical overview of {{ $total }} collected responses</p>
        </div>
        @if($total > 0)
        <a href="{{ route('admin.survey.export') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Export CSV
        </a>
        @endif
    </div>

    @if($total === 0)
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
            <h3 class="text-lg font-heading font-bold text-gray-600 mb-2">No Data Yet</h3>
            <p class="text-gray-400 text-sm">Survey responses will appear here once they start coming in.</p>
        </div>
    @else

    {{-- Key Metrics --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total Responses</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $total }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Avg Score</p>
            <p class="text-3xl font-bold text-primary mt-2">{{ number_format($stats->avg_overall, 1) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-green-500 uppercase tracking-wider">Highest</p>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ number_format($stats->max_overall, 1) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-red-400 uppercase tracking-wider">Lowest</p>
            <p class="text-3xl font-bold text-red-500 mt-2">{{ number_format($stats->min_overall, 1) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-amber/70 uppercase tracking-wider">Want Consultation</p>
            <p class="text-3xl font-bold text-amber mt-2">{{ $wantsConsultation }}</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Radar Chart: Average Dimension Scores --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Average Dimension Scores</h3>
            <div class="max-w-md mx-auto">
                <canvas id="avgRadarChart"></canvas>
            </div>
        </div>

        {{-- Score Distribution --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Score Distribution</h3>
            <div>
                <canvas id="distributionChart" height="220"></canvas>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- By Company Size --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">By Company Size</h3>
            @if($bySize->count() > 0)
            <div class="space-y-3">
                @foreach($bySize as $row)
                <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <div class="flex items-center gap-3">
                        <span class="inline-block px-2.5 py-0.5 text-xs font-semibold rounded-full bg-gray-100 text-gray-600">{{ $row->company_size }}</span>
                        <span class="text-sm text-gray-500">{{ $row->count }} responses</span>
                    </div>
                    <span class="text-sm font-bold
                        @if($row->avg_score >= 4) text-green-600
                        @elseif($row->avg_score >= 3) text-amber-600
                        @else text-red-500
                        @endif">
                        {{ number_format($row->avg_score, 1) }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
                <p class="text-sm text-gray-400">No data available</p>
            @endif
        </div>

        {{-- By Industry --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">By Industry</h3>
            @if($byIndustry->count() > 0)
            <div class="space-y-3 max-h-72 overflow-y-auto">
                @foreach($byIndustry as $row)
                <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <div class="flex items-center gap-3">
                        <span class="text-sm text-gray-700">{{ $row->industry }}</span>
                        <span class="text-xs text-gray-400">({{ $row->count }})</span>
                    </div>
                    <span class="text-sm font-bold
                        @if($row->avg_score >= 4) text-green-600
                        @elseif($row->avg_score >= 3) text-amber-600
                        @else text-red-500
                        @endif">
                        {{ number_format($row->avg_score, 1) }}
                    </span>
                </div>
                @endforeach
            </div>
            @else
                <p class="text-sm text-gray-400">No data available</p>
            @endif
        </div>
    </div>

    {{-- Weakest Criteria & Needs Analysis --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Weakest Individual Criteria --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-1">Weakest Criteria</h3>
            <p class="text-xs text-gray-400 mb-4">Areas where companies score lowest on average</p>
            @if(count($weakestAreas) > 0)
            <div class="space-y-2">
                @foreach($weakestAreas as $area)
                <div class="flex items-center gap-3 py-1.5 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <span class="flex-shrink-0 w-7 h-7 rounded-md flex items-center justify-center text-[10px] font-bold text-white
                        @if($area['avg'] < 2) bg-red-500 @elseif($area['avg'] < 3) bg-orange-500 @else bg-amber-500 @endif">
                        {{ number_format($area['avg'], 1) }}
                    </span>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2">
                            <span class="text-[10px] font-bold text-gray-400">{{ $area['criterion'] }}</span>
                            <span class="text-sm text-gray-700">{{ $area['label'] }}</span>
                        </div>
                        <span class="text-[10px] text-gray-400 capitalize">{{ $area['dimension'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
            @else
                <p class="text-sm text-gray-400">No data available</p>
            @endif
        </div>

        {{-- Needs Analysis --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-1">What Companies Need</h3>
            <p class="text-xs text-gray-400 mb-4">Dimensions where companies score below 3.0 (most to least common)</p>
            @if(count($needsAnalysis) > 0)
            <div class="space-y-4">
                @php
                    $dimLabels = [
                        'leadership' => 'Leadership & Strategy',
                        'data' => 'Data Foundations',
                        'technology' => 'Technology Infrastructure',
                        'culture' => 'Culture & Skills',
                        'process' => 'Process Maturity',
                        'compliance' => 'Compliance & Governance',
                    ];
                @endphp
                @foreach($needsAnalysis as $dimKey => $need)
                    @if($need['count'] > 0)
                    <div class="py-2 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                        <div class="flex items-center justify-between mb-1">
                            <span class="text-sm font-semibold text-gray-700">{{ $dimLabels[$dimKey] ?? $dimKey }}</span>
                            <span class="text-xs font-bold px-2 py-0.5 rounded-full bg-red-100 text-red-600">
                                {{ $need['count'] }} companies need help
                            </span>
                        </div>
                        {{-- Progress bar --}}
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden mb-2">
                            <div class="h-full rounded-full bg-red-400" style="width: {{ $total > 0 ? round(($need['count'] / $total) * 100) : 0 }}%"></div>
                        </div>
                        @if(count($need['reasons']) > 0)
                            <div class="mt-2">
                                <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-1">Common Reasons:</p>
                                <ul class="text-xs text-gray-500 space-y-1">
                                    @foreach(array_slice($need['reasons'], 0, 3) as $reason)
                                        <li class="flex items-start gap-1">
                                            <span class="text-red-400 mt-0.5">&bull;</span>
                                            <span>{{ \Str::limit($reason, 120) }}</span>
                                        </li>
                                    @endforeach
                                    @if(count($need['reasons']) > 3)
                                        <li class="text-gray-400 italic">+ {{ count($need['reasons']) - 3 }} more reasons</li>
                                    @endif
                                </ul>
                            </div>
                        @endif
                    </div>
                    @endif
                @endforeach
            </div>
            @else
                <p class="text-sm text-gray-400">No needs data available yet</p>
            @endif
        </div>
    </div>

    {{-- Recent Surveys --}}
    <div class="bg-white rounded-xl border border-gray-200 p-6">
        <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Recent Surveys</h3>
        <div class="space-y-2">
            @foreach($recentSurveys as $s)
            <a href="{{ route('admin.survey.show', $s) }}" class="flex items-center justify-between py-2.5 px-3 rounded-lg hover:bg-gray-50 transition-colors {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                <div>
                    <span class="text-sm font-medium text-gray-900">{{ $s->company_name }}</span>
                    <span class="text-xs text-gray-400 ml-2">{{ $s->industry }} &middot; {{ $s->company_size }}</span>
                </div>
                <div class="flex items-center gap-3">
                    <span class="text-sm font-bold
                        @if($s->overall_score >= 4) text-green-600
                        @elseif($s->overall_score >= 3) text-amber-600
                        @else text-red-500
                        @endif">
                        {{ number_format($s->overall_score, 1) }}
                    </span>
                    <span class="text-xs text-gray-400">{{ $s->completed_at?->diffForHumans() }}</span>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if($total > 0)
    // Radar Chart
    const radarCtx = document.getElementById('avgRadarChart');
    if (radarCtx) {
        new Chart(radarCtx, {
            type: 'radar',
            data: {
                labels: {!! json_encode(array_keys($dimensionAverages)) !!},
                datasets: [{
                    label: 'Average Score',
                    data: {!! json_encode(array_values($dimensionAverages)) !!},
                    fill: true,
                    backgroundColor: 'rgba(15, 123, 108, 0.15)',
                    borderColor: '#0F7B6C',
                    borderWidth: 2,
                    pointBackgroundColor: '#0F7B6C',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    r: {
                        beginAtZero: true,
                        max: 5,
                        min: 0,
                        ticks: { stepSize: 1, font: { size: 11 }, backdropColor: 'transparent' },
                        pointLabels: { font: { size: 11, weight: '600' }, color: '#374151' },
                        grid: { color: 'rgba(0,0,0,0.06)' },
                        angleLines: { color: 'rgba(0,0,0,0.06)' },
                    }
                },
                plugins: { legend: { display: false } }
            }
        });
    }

    // Distribution Bar Chart
    const distCtx = document.getElementById('distributionChart');
    if (distCtx) {
        const dist = {!! json_encode($scoreDistribution) !!};
        new Chart(distCtx, {
            type: 'bar',
            data: {
                labels: Object.keys(dist),
                datasets: [{
                    label: 'Responses',
                    data: Object.values(dist),
                    backgroundColor: ['#ef4444', '#f97316', '#eab308', '#22c55e'],
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1, font: { size: 11 } },
                        grid: { color: 'rgba(0,0,0,0.04)' },
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, weight: '600' } },
                    }
                }
            }
        });
    }
    @endif
});
</script>
@endpush
