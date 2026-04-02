{{-- Results partial (shown after successful submission) --}}
<div class="space-y-8">

    {{-- Success banner --}}
    <div class="bg-[#0F7B6C]/10 border border-[#0F7B6C]/20 rounded-2xl p-6 text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 bg-[#0F7B6C] rounded-full mb-4">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
            </svg>
        </div>
        <h2 class="font-heading text-2xl lg:text-3xl font-bold text-[#1B3A5C] mb-2"
            data-i18n="survey.results.title">
            Assessment Complete
        </h2>
        <p class="text-gray-500 font-body" data-i18n="survey.results.desc">
            Your AI Readiness Assessment has been submitted. Here are your results.
        </p>
    </div>

    {{-- Overall score card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 text-center">
        <p class="text-sm font-semibold text-gray-400 uppercase tracking-wider mb-3 font-body" data-i18n="survey.results.overall">
            Overall Readiness Score
        </p>
        <div class="text-7xl lg:text-8xl font-heading font-bold mb-2"
             :class="results.overall >= 4 ? 'text-green-600' : (results.overall >= 3 ? 'text-amber-600' : 'text-red-500')"
             x-text="results.overall.toFixed(1)"></div>
        <span class="inline-block px-4 py-1.5 rounded-full text-sm font-bold font-body"
              :class="results.overall >= 4 ? 'bg-green-100 text-green-700' : (results.overall >= 3 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-600')"
              x-text="results.label"></span>
        <p class="text-sm text-gray-400 mt-3 font-body">out of 5.0</p>
    </div>

    {{-- Radar chart --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:p-8">
        <h3 class="font-heading text-lg font-bold text-[#1B3A5C] mb-4" data-i18n="survey.results.radar_title">
            Dimension Overview
        </h3>
        <div class="max-w-lg mx-auto">
            <canvas id="radarChart"></canvas>
        </div>
    </div>

    {{-- Per-dimension breakdown --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 lg:p-8">
        <h3 class="font-heading text-lg font-bold text-[#1B3A5C] mb-6" data-i18n="survey.results.breakdown_title">
            Dimension Breakdown
        </h3>

        <div class="space-y-5">
            <template x-for="dim in dimensionList" :key="dim.key">
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-semibold text-gray-700 font-body" x-text="dim.label"></span>
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold font-heading"
                                  :class="results.scores[dim.key].avg >= 4 ? 'text-green-600' : (results.scores[dim.key].avg >= 3 ? 'text-amber-600' : 'text-red-500')"
                                  x-text="results.scores[dim.key].avg.toFixed(1)"></span>
                            <span class="text-xs px-2 py-0.5 rounded-full font-semibold font-body"
                                  :class="results.scores[dim.key].avg >= 4 ? 'bg-green-100 text-green-700' : (results.scores[dim.key].avg >= 3 ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-600')"
                                  x-text="readinessLabel(results.scores[dim.key].avg)"></span>
                        </div>
                    </div>
                    <div class="w-full h-4 bg-gray-100 rounded-full overflow-hidden">
                        <div class="h-full rounded-full transition-all duration-1000 ease-out"
                             :class="results.scores[dim.key].avg >= 4 ? 'bg-green-500' : (results.scores[dim.key].avg >= 3 ? 'bg-amber-500' : 'bg-red-400')"
                             :style="'width:' + ((results.scores[dim.key].avg / 5) * 100) + '%'"
                             x-init="$el.style.width = '0%'; setTimeout(() => $el.style.width = ((results.scores[dim.key].avg / 5) * 100) + '%', 100)"></div>
                    </div>
                </div>
            </template>
        </div>
    </div>

    {{-- Strengths & Weaknesses --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Strong areas --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 rounded-lg bg-green-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/>
                    </svg>
                </div>
                <h3 class="font-heading text-base font-bold text-green-700" data-i18n="survey.results.strengths">Strong Areas</h3>
            </div>
            <template x-for="dim in dimensionList.filter(d => results.scores[d.key].avg >= 3.5)" :key="dim.key">
                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                    <span class="text-sm text-gray-600 font-body" x-text="dim.label"></span>
                    <span class="text-sm font-bold text-green-600 font-body" x-text="results.scores[dim.key].avg.toFixed(1)"></span>
                </div>
            </template>
            <template x-if="dimensionList.filter(d => results.scores[d.key].avg >= 3.5).length === 0">
                <p class="text-sm text-gray-400 font-body italic">No strong areas identified (3.5+ threshold)</p>
            </template>
        </div>

        {{-- Weak areas --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center gap-2 mb-4">
                <div class="w-8 h-8 rounded-lg bg-red-100 flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-base font-bold text-red-600" data-i18n="survey.results.weaknesses">Areas for Improvement</h3>
            </div>
            <template x-for="dim in dimensionList.filter(d => results.scores[d.key].avg > 0 && results.scores[d.key].avg < 3)" :key="dim.key">
                <div class="flex items-center justify-between py-2 border-b border-gray-50 last:border-0">
                    <span class="text-sm text-gray-600 font-body" x-text="dim.label"></span>
                    <span class="text-sm font-bold text-red-500 font-body" x-text="results.scores[dim.key].avg.toFixed(1)"></span>
                </div>
            </template>
            <template x-if="dimensionList.filter(d => results.scores[d.key].avg > 0 && results.scores[d.key].avg < 3).length === 0">
                <p class="text-sm text-gray-400 font-body italic">No weak areas identified (below 3.0 threshold)</p>
            </template>
        </div>
    </div>

    {{-- CTA --}}
    <div class="bg-[#1B3A5C] rounded-2xl p-8 lg:p-10 text-center">
        <h3 class="font-heading text-2xl font-bold text-white mb-3" data-i18n="survey.results.cta_title">
            Ready to Start Your AI Journey?
        </h3>
        <p class="text-white/70 mb-6 max-w-xl mx-auto font-body" data-i18n="survey.results.cta_desc">
            Our AI consultants can help you build a tailored roadmap based on your assessment results. Get a free consultation to discuss your next steps.
        </p>
        <a href="/contatto"
           class="inline-flex items-center gap-2 px-8 py-4 bg-[#0F7B6C] text-white rounded-xl font-semibold text-sm hover:bg-[#0d6b5e] hover:shadow-lg hover:shadow-[#0F7B6C]/30 transition-all duration-200 font-body"
           data-i18n="survey.results.cta_btn">
            Get a Free Consultation
            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/>
            </svg>
        </a>
    </div>
</div>
