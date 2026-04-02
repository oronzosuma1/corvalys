{{--
    Dimension scoring partial.
    Variables: $dimKey, $stepNum, $title, $description, $criteria, $guide
--}}
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 lg:p-10">

    {{-- Header with running average pill --}}
    <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-2">
        <div>
            <h2 class="font-heading text-2xl lg:text-3xl font-bold text-[#1B3A5C]">
                {{ $title }}
            </h2>
        </div>
        <div class="flex-shrink-0">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-sm font-bold font-body transition-colors duration-300"
                  :class="dimAvg('{{ $dimKey }}') >= 4 ? 'bg-green-100 text-green-700' : (dimAvg('{{ $dimKey }}') >= 3 ? 'bg-amber-100 text-amber-700' : (dimAvg('{{ $dimKey }}') > 0 ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-400'))">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z"/></svg>
                <span x-text="dimAvg('{{ $dimKey }}') > 0 ? dimAvg('{{ $dimKey }}').toFixed(1) + ' / 5.0' : 'No scores yet'"></span>
            </span>
        </div>
    </div>
    <p class="text-gray-500 mb-6 font-body">
        {{ $description }}
    </p>

    {{-- Scoring guidance (collapsible) --}}
    <div x-data="{ open: false }" class="mb-8">
        <button type="button" @click="open = !open"
                class="flex items-center gap-2 text-sm font-semibold text-[#0F7B6C] hover:text-[#0d6b5e] transition-colors font-body">
            <svg class="w-4 h-4 transition-transform duration-200" :class="open ? 'rotate-90' : ''" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 4.5l7.5 7.5-7.5 7.5"/>
            </svg>
            <span data-i18n="survey.scoring_guide">Scoring Guidance</span>
        </button>
        <div x-show="open"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-1"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-1"
             class="mt-3">
            <div class="bg-gray-50 rounded-xl border border-gray-100 p-5">
                <div class="space-y-3">
                    @foreach($guide as $g)
                    <div class="flex gap-3">
                        <span class="flex-shrink-0 w-8 h-8 rounded-lg flex items-center justify-center text-sm font-bold text-white
                            @if($g['score'] === 1) bg-red-500
                            @elseif($g['score'] === 2) bg-orange-500
                            @elseif($g['score'] === 3) bg-amber-500
                            @elseif($g['score'] === 4) bg-blue-500
                            @else bg-green-500
                            @endif">
                            {{ $g['score'] }}
                        </span>
                        <div>
                            <span class="text-sm font-semibold text-gray-700 font-body">{{ $g['label'] }}:</span>
                            <span class="text-sm text-gray-500 font-body"> {{ $g['desc'] }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- Validation error for dimension --}}
    <div x-show="errors.dimension" class="bg-red-50 border border-red-200 rounded-xl p-3 mb-6">
        <p class="text-sm text-red-600 font-body" x-text="errors.dimension"></p>
    </div>

    {{-- Criteria --}}
    <div class="space-y-6">
        @foreach($criteria as $c)
        <div class="border border-gray-100 rounded-xl p-5 hover:border-gray-200 transition-colors">
            {{-- Criterion header --}}
            <div class="flex items-start gap-3 mb-4">
                <span class="flex-shrink-0 inline-flex items-center justify-center w-10 h-10 rounded-lg bg-[#1B3A5C]/10 text-[#1B3A5C] text-xs font-bold font-body">
                    {{ $c['code'] }}
                </span>
                <div>
                    <h3 class="font-heading text-base font-bold text-gray-800">{{ $c['name'] }}</h3>
                    <p class="text-sm text-gray-500 font-body">{{ $c['desc'] }}</p>
                </div>
            </div>

            {{-- Score buttons --}}
            <div class="flex items-center gap-2 mb-3">
                <span class="text-xs text-gray-400 font-body mr-1">Score:</span>
                @for($i = 1; $i <= 5; $i++)
                <button type="button"
                        @click="scores.{{ $dimKey }}.{{ $c['code'] }} = {{ $i }}"
                        :class="scores.{{ $dimKey }}.{{ $c['code'] }} === {{ $i }}
                            ? '{{ $i === 1 ? "bg-red-500 text-white border-red-500" : ($i === 2 ? "bg-orange-500 text-white border-orange-500" : ($i === 3 ? "bg-amber-500 text-white border-amber-500" : ($i === 4 ? "bg-blue-500 text-white border-blue-500" : "bg-green-500 text-white border-green-500"))) }} shadow-sm scale-110'
                            : 'bg-white text-gray-500 border-gray-200 hover:border-[#0F7B6C]/40 hover:text-gray-700'"
                        class="w-11 h-11 sm:w-12 sm:h-12 rounded-lg border-2 text-sm font-bold transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-[#0F7B6C]/30">
                    {{ $i }}
                </button>
                @endfor
            </div>

            {{-- Low score reason (shown for scores 1 or 2 with animation) --}}
            <div x-show="scores.{{ $dimKey }}.{{ $c['code'] }} === 1 || scores.{{ $dimKey }}.{{ $c['code'] }} === 2"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 -translate-y-2 max-h-0"
                 x-transition:enter-end="opacity-100 translate-y-0 max-h-40"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 max-h-40"
                 x-transition:leave-end="opacity-0 -translate-y-2 max-h-0"
                 class="overflow-hidden">
                <div class="mt-3 bg-red-50/50 rounded-lg p-3 border border-red-100">
                    <label class="block text-xs font-semibold text-red-600 mb-1 font-body">Why did you give a low score?</label>
                    <textarea x-model="lowReasons.{{ $dimKey }}.{{ $c['code'] }}" rows="2"
                              class="w-full px-3 py-2 text-sm border border-red-200 rounded-lg focus:ring-2 focus:ring-red-200 focus:border-red-300 transition-colors font-body bg-white"
                              placeholder="What are the main barriers or challenges for this area?"></textarea>
                </div>
            </div>

            {{-- Notes (optional) --}}
            <details class="mt-3 group">
                <summary class="text-xs font-semibold text-gray-400 cursor-pointer hover:text-gray-600 transition-colors font-body select-none">
                    + Add notes
                </summary>
                <div class="mt-2">
                    <textarea x-model="notes.{{ $dimKey }}.{{ $c['code'] }}" rows="2"
                              class="w-full px-3 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-primary/20 focus:border-primary/40 transition-colors font-body"
                              placeholder="Optional notes or context for this criterion..."></textarea>
                </div>
            </details>
        </div>
        @endforeach
    </div>
</div>
