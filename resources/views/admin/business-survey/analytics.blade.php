@extends('layouts.admin')

@section('title', 'Business Survey Analytics')

@push('head')
@vite('resources/js/admin-charts.js')
@endpush

@section('content')
    <div class="flex items-center justify-between mb-6">
        <div>
            <a href="{{ route('admin.business-survey.index') }}" class="text-sm text-primary hover:text-primary-dark font-medium mb-2 inline-flex items-center gap-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"/></svg>
                All Responses
            </a>
            <h1 class="text-2xl font-heading font-bold text-gray-900 mb-1">Business Survey Analytics</h1>
            <p class="text-sm text-gray-500">Statistical overview of {{ $totalResponses }} collected responses</p>
        </div>
        @if($totalResponses > 0)
        <a href="{{ route('admin.business-survey.export') }}"
           class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 text-gray-600 rounded-lg text-sm font-semibold hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3"/></svg>
            Export CSV
        </a>
        @endif
    </div>

    @if($totalResponses === 0)
        <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
            <h3 class="text-lg font-heading font-bold text-gray-600 mb-2">No Data Yet</h3>
            <p class="text-gray-400 text-sm">Business survey responses will appear here once they start coming in.</p>
        </div>
    @else

    @php
        $frustrationLabels = [
            'manual_data_entry' => 'Manual data entry',
            'invoice_processing' => 'Invoice processing',
            'email_management' => 'Email management',
            'scheduling' => 'Scheduling & calendar',
            'report_generation' => 'Report generation',
            'inventory_tracking' => 'Inventory tracking',
            'customer_follow_up' => 'Customer follow-up',
            'document_management' => 'Document management',
            'hr_admin' => 'HR administration',
            'compliance_tracking' => 'Compliance tracking',
            'social_media' => 'Social media management',
            'order_processing' => 'Order processing',
        ];

        $taskLabels = [
            'manual_data_entry' => 'Manual data entry',
            'invoice_processing' => 'Invoice processing',
            'email_management' => 'Email management',
            'scheduling' => 'Scheduling & calendar',
            'report_generation' => 'Report generation',
            'inventory_tracking' => 'Inventory tracking',
            'customer_follow_up' => 'Customer follow-up',
            'document_management' => 'Document management',
            'hr_admin' => 'HR administration',
            'compliance_tracking' => 'Compliance tracking',
            'social_media' => 'Social media management',
            'order_processing' => 'Order processing',
        ];

        $sectorLabels = [
            'retail' => 'Retail & E-commerce',
            'manufacturing' => 'Manufacturing',
            'food_hospitality' => 'Food & Hospitality',
            'professional_services' => 'Professional Services',
            'healthcare' => 'Healthcare',
            'construction' => 'Construction & Real Estate',
            'logistics' => 'Logistics & Transport',
            'education' => 'Education & Training',
            'finance' => 'Finance & Insurance',
            'technology' => 'Technology',
            'agriculture' => 'Agriculture',
            'other' => 'Other',
        ];

        $sizeLabels = [
            '1_5' => '1-5',
            '6_20' => '6-20',
            '21_50' => '21-50',
            '51_100' => '51-100',
            '101_250' => '101-250',
            '250_plus' => '250+',
        ];

        $clusterLabels = [
            'admin_automation' => 'Admin Automation',
            'finance_automation' => 'Finance & Invoice',
            'customer_service_automation' => 'Customer Service',
            'sales_automation' => 'Sales Automation',
            'reporting_bi_automation' => 'Reporting & BI',
            'supply_chain_automation' => 'Supply Chain',
            'compliance_automation' => 'Compliance',
            'marketing_automation' => 'Marketing',
        ];

        $readinessLabels = [
            'ready_now' => 'Ready to start now',
            'exploring' => 'Exploring options',
            'need_convincing' => 'Need more convincing',
            'not_ready' => 'Not ready yet',
            'already_using' => 'Already using AI tools',
        ];

        $concernLabels = [
            'cost' => 'Cost',
            'complexity' => 'Complexity',
            'data_privacy' => 'Data privacy',
            'job_loss' => 'Job loss concerns',
            'reliability' => 'Reliability',
            'integration' => 'Integration difficulty',
            'lack_of_knowledge' => 'Lack of knowledge',
            'no_concerns' => 'No concerns',
        ];

        $outcomeLabels = [
            'save_time' => 'Save time',
            'reduce_costs' => 'Reduce costs',
            'improve_accuracy' => 'Improve accuracy',
            'scale_operations' => 'Scale operations',
            'better_customer_experience' => 'Better customer experience',
            'competitive_advantage' => 'Competitive advantage',
        ];

        // Helper to map keys to human labels
        function mapLabels($data, $labels) {
            $mapped = [];
            foreach ($data as $key => $value) {
                $mapped[$labels[$key] ?? str_replace('_', ' ', ucfirst($key))] = $value;
            }
            return $mapped;
        }
    @endphp

    {{-- Key Metrics --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Total Responses</p>
            <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalResponses }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-green-500 uppercase tracking-wider">Total Leads</p>
            <p class="text-3xl font-bold text-green-600 mt-2">{{ $totalLeads }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-red-400 uppercase tracking-wider">Avg Pain Score</p>
            <p class="text-3xl font-bold text-red-500 mt-2">{{ number_format($avgPainScore, 1) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-primary/60 uppercase tracking-wider">Avg Automation</p>
            <p class="text-3xl font-bold text-primary mt-2">{{ number_format($avgAutomation, 1) }}</p>
        </div>
        <div class="bg-white rounded-xl border border-gray-200 p-5">
            <p class="text-[11px] font-semibold text-amber-500 uppercase tracking-wider">Avg Readiness</p>
            <p class="text-3xl font-bold text-amber-600 mt-2">{{ number_format($avgReadiness, 1) }}</p>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- Top Frustration Areas --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Top Frustration Areas</h3>
            <div>
                <canvas id="frustrationChart" height="280"></canvas>
            </div>
        </div>

        {{-- Top Tasks to Delegate --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Top Tasks to Delegate</h3>
            <div>
                <canvas id="delegateChart" height="280"></canvas>
            </div>
        </div>

        {{-- Responses by Sector --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Responses by Sector</h3>
            <div class="max-w-sm mx-auto">
                <canvas id="sectorChart"></canvas>
            </div>
        </div>

        {{-- Opportunity Clusters --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Opportunity Clusters</h3>
            <div>
                <canvas id="clusterChart" height="280"></canvas>
            </div>
        </div>
    </div>

    {{-- Tables --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        {{-- By Company Size --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Responses by Company Size</h3>
            @if(count($bySize) > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Size</th>
                        <th class="text-center py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Count</th>
                        <th class="text-center py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Avg Pain</th>
                        <th class="text-center py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Avg Readiness</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($bySize as $key => $data)
                    <tr>
                        <td class="py-2.5 text-gray-700">{{ $sizeLabels[$key] ?? $key }}</td>
                        <td class="py-2.5 text-center text-gray-600">{{ $data['count'] ?? $data }}</td>
                        <td class="py-2.5 text-center font-semibold
                            @if(($data['avg_pain'] ?? 0) >= 7) text-red-600
                            @elseif(($data['avg_pain'] ?? 0) >= 5) text-amber-600
                            @else text-green-600
                            @endif">{{ number_format($data['avg_pain'] ?? 0, 1) }}</td>
                        <td class="py-2.5 text-center font-semibold
                            @if(($data['avg_readiness'] ?? 0) >= 7) text-green-600
                            @elseif(($data['avg_readiness'] ?? 0) >= 5) text-amber-600
                            @else text-red-600
                            @endif">{{ number_format($data['avg_readiness'] ?? 0, 1) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-sm text-gray-400">No data available</p>
            @endif
        </div>

        {{-- By Country --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Responses by Country (Top 10)</h3>
            @if(count($byCountry) > 0)
            <div class="space-y-3 max-h-72 overflow-y-auto">
                @foreach(array_slice($byCountry, 0, 10, true) as $country => $count)
                <div class="flex items-center justify-between py-2 {{ !$loop->last ? 'border-b border-gray-50' : '' }}">
                    <span class="text-sm text-gray-700">{{ $country }}</span>
                    <span class="text-sm font-bold text-gray-600">{{ $count }}</span>
                </div>
                @endforeach
            </div>
            @else
                <p class="text-sm text-gray-400">No data available</p>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        {{-- AI Readiness Distribution --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">AI Readiness Distribution</h3>
            @if(count($readinessDistribution) > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Statement</th>
                        <th class="text-center py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Count</th>
                        <th class="text-right py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">%</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($readinessDistribution as $key => $count)
                    <tr>
                        <td class="py-2.5 text-gray-700">{{ $readinessLabels[$key] ?? str_replace('_', ' ', ucfirst($key)) }}</td>
                        <td class="py-2.5 text-center text-gray-600">{{ $count }}</td>
                        <td class="py-2.5 text-right text-gray-500">{{ $totalResponses > 0 ? number_format(($count / $totalResponses) * 100, 1) : 0 }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-sm text-gray-400">No data available</p>
            @endif
        </div>

        {{-- AI Concerns --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">AI Concerns</h3>
            @if(count($concernsDistribution) > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Concern</th>
                        <th class="text-center py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Count</th>
                        <th class="text-right py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">%</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($concernsDistribution as $key => $count)
                    <tr>
                        <td class="py-2.5 text-gray-700">{{ $concernLabels[$key] ?? str_replace('_', ' ', ucfirst($key)) }}</td>
                        <td class="py-2.5 text-center text-gray-600">{{ $count }}</td>
                        <td class="py-2.5 text-right text-gray-500">{{ $totalResponses > 0 ? number_format(($count / $totalResponses) * 100, 1) : 0 }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-sm text-gray-400">No data available</p>
            @endif
        </div>

        {{-- Preferred Outcomes --}}
        <div class="bg-white rounded-xl border border-gray-200 p-6">
            <h3 class="text-sm font-heading font-semibold text-gray-900 mb-4">Preferred Outcomes</h3>
            @if(count($outcomesDistribution) > 0)
            <table class="w-full text-sm">
                <thead>
                    <tr class="border-b border-gray-100">
                        <th class="text-left py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Outcome</th>
                        <th class="text-center py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">Count</th>
                        <th class="text-right py-2 text-[11px] font-semibold text-gray-400 uppercase tracking-wider">%</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($outcomesDistribution as $key => $count)
                    <tr>
                        <td class="py-2.5 text-gray-700">{{ $outcomeLabels[$key] ?? str_replace('_', ' ', ucfirst($key)) }}</td>
                        <td class="py-2.5 text-center text-gray-600">{{ $count }}</td>
                        <td class="py-2.5 text-right text-gray-500">{{ $totalResponses > 0 ? number_format(($count / $totalResponses) * 100, 1) : 0 }}%</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <p class="text-sm text-gray-400">No data available</p>
            @endif
        </div>
    </div>

    @endif
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    @if($totalResponses > 0)

    const chartColors = [
        '#0F7B6C', '#1B3A5C', '#D97706', '#ef4444', '#8b5cf6',
        '#06b6d4', '#ec4899', '#22c55e', '#f59e0b', '#6366f1',
        '#14b8a6', '#f43f5e'
    ];

    // Top Frustration Areas (horizontal bar)
    @php
        $mappedFrustrations = mapLabels(array_slice($topFrustrations, 0, 10, true), $frustrationLabels);
    @endphp
    const frustrationCtx = document.getElementById('frustrationChart');
    if (frustrationCtx) {
        new Chart(frustrationCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($mappedFrustrations)) !!},
                datasets: [{
                    label: 'Count',
                    data: {!! json_encode(array_values($mappedFrustrations)) !!},
                    backgroundColor: '#ef4444',
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: 'rgba(0,0,0,0.04)' } },
                    y: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });
    }

    // Top Tasks to Delegate (horizontal bar)
    @php
        $mappedDelegateTasks = mapLabels(array_slice($topDelegateTasks, 0, 10, true), $taskLabels);
    @endphp
    const delegateCtx = document.getElementById('delegateChart');
    if (delegateCtx) {
        new Chart(delegateCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($mappedDelegateTasks)) !!},
                datasets: [{
                    label: 'Count',
                    data: {!! json_encode(array_values($mappedDelegateTasks)) !!},
                    backgroundColor: '#0F7B6C',
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: 'rgba(0,0,0,0.04)' } },
                    y: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });
    }

    // Responses by Sector (doughnut)
    @php
        $mappedSectors = mapLabels($bySector, $sectorLabels);
    @endphp
    const sectorCtx = document.getElementById('sectorChart');
    if (sectorCtx) {
        new Chart(sectorCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($mappedSectors)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($mappedSectors)) !!},
                    backgroundColor: chartColors.slice(0, {{ count($mappedSectors) }}),
                    borderWidth: 2,
                    borderColor: '#fff',
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { size: 11 }, padding: 12, usePointStyle: true, pointStyle: 'circle' }
                    }
                }
            }
        });
    }

    // Opportunity Clusters (horizontal bar)
    @php
        $mappedClusters = mapLabels($clusterDistribution, $clusterLabels);
    @endphp
    const clusterCtx = document.getElementById('clusterChart');
    if (clusterCtx) {
        new Chart(clusterCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($mappedClusters)) !!},
                datasets: [{
                    label: 'Count',
                    data: {!! json_encode(array_values($mappedClusters)) !!},
                    backgroundColor: chartColors.slice(0, {{ count($mappedClusters) }}),
                    borderRadius: 6,
                    borderSkipped: false,
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    x: { beginAtZero: true, ticks: { stepSize: 1, font: { size: 11 } }, grid: { color: 'rgba(0,0,0,0.04)' } },
                    y: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });
    }

    @endif
});
</script>
@endpush
