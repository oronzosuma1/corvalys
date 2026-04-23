@extends('layouts.app')

@section('title', __('seo.business_survey.title'))
@section('meta_description', __('seo.business_survey.description'))

@section('content')
<section class="min-h-screen bg-gradient-to-br from-gray-100 via-gray-50 to-gray-100 py-8 sm:py-12 lg:py-16"
         x-data="businessSurvey()"
         x-cloak>

    <div class="max-w-2xl mx-auto px-4 sm:px-6">
        {{-- Card --}}
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden relative">

            {{-- Progress bar --}}
            <div class="h-1.5 bg-gray-100">
                <div class="h-full rounded-r-full transition-all duration-500 ease-out"
                     :style="'width:' + progressPercent + '%'"
                     style="background: linear-gradient(90deg, #0F7B6C, #10B981);"></div>
            </div>

            {{-- Header with back button and counter --}}
            <div class="flex items-center justify-between px-5 py-4 border-b border-gray-100"
                 x-show="step > 0 && step <= totalQuestions">
                <button @click="goBack()"
                        x-show="step > 1"
                        class="flex items-center gap-1 text-sm text-gray-500 hover:text-gray-700 transition-colors min-h-[44px] px-2"
                        type="button">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                    <span data-i18n="survey.biz.back">Back</span>
                </button>
                <div x-show="step < 1" class="w-16"></div>
                <span class="text-sm text-gray-400 font-medium" x-text="step + ' of ' + totalQuestions"></span>
                <div class="w-16"></div>
            </div>

            {{-- Content area --}}
            <div class="px-5 py-8 sm:px-8 sm:py-10 min-h-[400px] flex flex-col">

                {{-- ═══════════════════════════════════════
                     STEP 0: INTRO
                ═══════════════════════════════════════ --}}
                <template x-if="step === 0">
                    <div class="flex flex-col items-center text-center flex-1 justify-center"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0">
                        <div class="w-16 h-16 rounded-2xl bg-[#0F7B6C]/10 flex items-center justify-center mb-6">
                            <svg class="w-8 h-8 text-[#0F7B6C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <h1 class="font-heading text-2xl sm:text-3xl font-bold text-[#1B3A5C] mb-4 leading-tight"
                            data-i18n="survey.biz.hero.title">
                            {{ __('survey.hero.title') }}
                        </h1>
                        <p class="text-gray-500 text-base sm:text-lg mb-8 max-w-md leading-relaxed"
                           data-i18n="survey.biz.hero.sub">
                            {{ __('survey.hero.sub') }}
                        </p>
                        <div class="flex flex-wrap justify-center gap-3 mb-8">
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-100 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-[#0F7B6C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span data-i18n="survey.cta.subtitle">{{ __('survey.cta.subtitle') }}</span>
                            </span>
                            <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-100 text-sm text-gray-600">
                                <svg class="w-4 h-4 text-[#0F7B6C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                <span data-i18n="survey.cta.anonymous">{{ __('survey.cta.anonymous') }}</span>
                            </span>
                        </div>
                        <button @click="step = 1"
                                class="w-full sm:w-auto px-8 py-4 bg-[#0F7B6C] hover:bg-[#0a5f54] text-white font-semibold rounded-xl transition-colors text-lg min-h-[48px]"
                                type="button"
                                data-i18n="survey.cta.primary">
                            {{ __('survey.cta.primary') }}
                        </button>
                    </div>
                </template>

                {{-- ═══════════════════════════════════════
                     STEPS 1-19: QUESTIONS
                ═══════════════════════════════════════ --}}
                <template x-if="step >= 1 && step <= totalQuestions">
                    <div :key="step"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         class="flex flex-col flex-1">

                        <div class="mb-6">
                            <h2 class="font-heading text-xl sm:text-2xl font-bold text-[#1B3A5C] mb-2"
                                x-text="currentQuestion.title"></h2>
                            <p class="text-gray-500 text-sm sm:text-base"
                               x-show="currentQuestion.subtitle"
                               x-text="currentQuestion.subtitle"></p>
                        </div>

                        {{-- Single choice --}}
                        <template x-if="currentQuestion.type === 'single'">
                            <div class="space-y-3 flex-1">
                                <template x-for="opt in currentQuestion.options" :key="opt.value">
                                    <button @click="selectSingle(currentQuestion.field, opt.value)"
                                            :class="answers[currentQuestion.field] === opt.value
                                                ? 'bg-[#0F7B6C] text-white border-[#0F7B6C] shadow-md'
                                                : 'bg-white text-gray-700 border-gray-200 hover:border-[#0F7B6C]/50 hover:bg-[#0F7B6C]/5'"
                                            class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl border-2 transition-all duration-200 text-left min-h-[48px] cursor-pointer"
                                            type="button">
                                        <span x-show="opt.icon" x-text="opt.icon" class="text-xl"></span>
                                        <span class="font-medium text-sm sm:text-base" x-text="opt.label"></span>
                                    </button>
                                </template>
                            </div>
                        </template>

                        {{-- Multi choice --}}
                        <template x-if="currentQuestion.type === 'multi'">
                            <div class="flex flex-col flex-1">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 flex-1">
                                    <template x-for="opt in getFilteredOptions(currentQuestion)" :key="opt.value">
                                        <button @click="toggleMulti(currentQuestion.field, opt.value)"
                                                :class="(answers[currentQuestion.field] || []).includes(opt.value)
                                                    ? 'bg-[#0F7B6C]/10 border-[#0F7B6C] text-[#0F7B6C]'
                                                    : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'"
                                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl border-2 transition-all duration-200 text-left min-h-[48px] cursor-pointer relative"
                                                type="button">
                                            <span class="w-5 h-5 rounded border-2 flex items-center justify-center flex-shrink-0 transition-all"
                                                  :class="(answers[currentQuestion.field] || []).includes(opt.value)
                                                      ? 'bg-[#0F7B6C] border-[#0F7B6C]'
                                                      : 'border-gray-300'">
                                                <svg x-show="(answers[currentQuestion.field] || []).includes(opt.value)"
                                                     class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                            </span>
                                            <span class="font-medium text-sm" x-text="opt.label"></span>
                                        </button>
                                    </template>
                                </div>
                                <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                                    <button @click="goForward()" class="text-sm text-gray-400 hover:text-gray-600 transition-colors min-h-[44px] px-2" type="button"
                                            data-i18n="survey.biz.skip">
                                        Skip
                                    </button>
                                    <button @click="goForward()"
                                            class="px-6 py-3 bg-[#0F7B6C] hover:bg-[#0a5f54] text-white font-semibold rounded-xl transition-colors min-h-[48px]"
                                            type="button"
                                            data-i18n="survey.biz.next">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </template>

                        {{-- Scale --}}
                        <template x-if="currentQuestion.type === 'scale'">
                            <div class="flex flex-col items-center flex-1 justify-center">
                                <div class="flex items-center gap-3 sm:gap-4 mb-4">
                                    <template x-for="n in 5" :key="n">
                                        <button @click="selectScale(currentQuestion.field, n)"
                                                :class="{
                                                    'bg-green-500 text-white border-green-500': answers[currentQuestion.field] === n && n <= 2,
                                                    'bg-[#D97706] text-white border-[#D97706]': answers[currentQuestion.field] === n && n === 3,
                                                    'bg-red-500 text-white border-red-500': answers[currentQuestion.field] === n && n >= 4,
                                                    'bg-white text-gray-700 border-gray-200 hover:border-gray-400': answers[currentQuestion.field] !== n
                                                }"
                                                class="w-14 h-14 sm:w-16 sm:h-16 rounded-full border-2 flex items-center justify-center text-xl font-bold transition-all duration-200 cursor-pointer"
                                                type="button"
                                                x-text="n">
                                        </button>
                                    </template>
                                </div>
                                <div class="flex justify-between w-full max-w-xs text-sm text-gray-400">
                                    <span data-i18n="survey.biz.scale.minor">Minor</span>
                                    <span data-i18n="survey.biz.scale.serious">Serious</span>
                                </div>
                            </div>
                        </template>

                        {{-- Select --}}
                        <template x-if="currentQuestion.type === 'select'">
                            <div class="flex flex-col flex-1">
                                <select x-model="answers[currentQuestion.field]"
                                        @change="saveAnswers()"
                                        class="w-full px-4 py-3.5 rounded-xl border-2 border-gray-200 focus:border-[#0F7B6C] focus:ring-2 focus:ring-[#0F7B6C]/20 outline-none text-gray-700 bg-white min-h-[48px] text-base transition-colors">
                                    <option value="" data-i18n="survey.biz.select_placeholder">Select an option...</option>
                                    <template x-for="opt in currentQuestion.options" :key="opt.value">
                                        <option :value="opt.value" x-text="opt.label"></option>
                                    </template>
                                </select>
                                <div class="flex justify-end mt-6 pt-4 border-t border-gray-100">
                                    <button @click="goForward()"
                                            :disabled="!answers[currentQuestion.field]"
                                            :class="answers[currentQuestion.field] ? 'bg-[#0F7B6C] hover:bg-[#0a5f54] text-white' : 'bg-gray-200 text-gray-400 cursor-not-allowed'"
                                            class="px-6 py-3 font-semibold rounded-xl transition-colors min-h-[48px]"
                                            type="button"
                                            data-i18n="survey.biz.next">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </template>

                        {{-- Dynamic Single --}}
                        <template x-if="currentQuestion.type === 'dynamic_single'">
                            <div class="space-y-3 flex-1">
                                <template x-for="opt in getDynamicOptions(currentQuestion)" :key="opt.value">
                                    <button @click="selectSingle(currentQuestion.field, opt.value)"
                                            :class="answers[currentQuestion.field] === opt.value
                                                ? 'bg-[#0F7B6C] text-white border-[#0F7B6C] shadow-md'
                                                : 'bg-white text-gray-700 border-gray-200 hover:border-[#0F7B6C]/50 hover:bg-[#0F7B6C]/5'"
                                            class="w-full flex items-center gap-3 px-4 py-3.5 rounded-xl border-2 transition-all duration-200 text-left min-h-[48px] cursor-pointer"
                                            type="button">
                                        <span class="font-medium text-sm sm:text-base" x-text="opt.label"></span>
                                    </button>
                                </template>
                            </div>
                        </template>

                        {{-- Dynamic Multi --}}
                        <template x-if="currentQuestion.type === 'dynamic_multi'">
                            <div class="flex flex-col flex-1">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 flex-1">
                                    <template x-for="opt in getDynamicOptions(currentQuestion)" :key="opt.value">
                                        <button @click="toggleMulti(currentQuestion.field, opt.value, currentQuestion.maxSelect)"
                                                :class="(answers[currentQuestion.field] || []).includes(opt.value)
                                                    ? 'bg-[#0F7B6C]/10 border-[#0F7B6C] text-[#0F7B6C]'
                                                    : 'bg-white text-gray-700 border-gray-200 hover:border-gray-300'"
                                                class="flex items-center gap-3 px-4 py-3.5 rounded-xl border-2 transition-all duration-200 text-left min-h-[48px] cursor-pointer"
                                                type="button">
                                            <span class="w-5 h-5 rounded border-2 flex items-center justify-center flex-shrink-0 transition-all"
                                                  :class="(answers[currentQuestion.field] || []).includes(opt.value)
                                                      ? 'bg-[#0F7B6C] border-[#0F7B6C]'
                                                      : 'border-gray-300'">
                                                <svg x-show="(answers[currentQuestion.field] || []).includes(opt.value)"
                                                     class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                            </span>
                                            <span class="font-medium text-sm" x-text="opt.label"></span>
                                        </button>
                                    </template>
                                </div>
                                <p class="text-xs text-gray-400 mt-3" x-show="currentQuestion.maxSelect"
                                   x-text="'Selected: ' + ((answers[currentQuestion.field] || []).length) + ' / ' + currentQuestion.maxSelect"></p>
                                <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                                    <button @click="goForward()" class="text-sm text-gray-400 hover:text-gray-600 transition-colors min-h-[44px] px-2" type="button"
                                            data-i18n="survey.biz.skip">
                                        Skip
                                    </button>
                                    <button @click="goForward()"
                                            class="px-6 py-3 bg-[#0F7B6C] hover:bg-[#0a5f54] text-white font-semibold rounded-xl transition-colors min-h-[48px]"
                                            type="button"
                                            data-i18n="survey.biz.next">
                                        Next
                                    </button>
                                </div>
                            </div>
                        </template>

                    </div>
                </template>

                {{-- ═══════════════════════════════════════
                     STEP 20: CONTACT FORM
                ═══════════════════════════════════════ --}}
                <template x-if="step === totalQuestions + 1">
                    <div x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-8"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         class="flex flex-col flex-1">

                        <div class="mb-6">
                            <h2 class="font-heading text-xl sm:text-2xl font-bold text-[#1B3A5C] mb-2"
                                data-i18n="survey.biz.contact.title">
                                Stay in touch, if you want
                            </h2>
                            <p class="text-gray-500 text-sm sm:text-base leading-relaxed"
                               data-i18n="survey.biz.contact.sub">
                                You can submit the survey without leaving your contact details. If you'd like to receive insights or hear from Corvalys, you can leave your information below.
                            </p>
                        </div>

                        <div class="space-y-4 flex-1">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1"
                                       data-i18n="survey.biz.field.name">Name</label>
                                <input type="text" x-model="answers.contact_name" @input="saveAnswers()"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0F7B6C] focus:ring-2 focus:ring-[#0F7B6C]/20 outline-none min-h-[48px] text-base transition-colors"
                                       data-i18n-placeholder="survey.biz.placeholder.name"
                                       placeholder="Your name">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1"
                                       data-i18n="survey.biz.field.company">Company</label>
                                <input type="text" x-model="answers.contact_company" @input="saveAnswers()"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0F7B6C] focus:ring-2 focus:ring-[#0F7B6C]/20 outline-none min-h-[48px] text-base transition-colors"
                                       data-i18n-placeholder="survey.biz.placeholder.company"
                                       placeholder="Your company">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1"
                                       data-i18n="survey.biz.field.email">Email</label>
                                <input type="email" x-model="answers.contact_email" @input="saveAnswers()"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0F7B6C] focus:ring-2 focus:ring-[#0F7B6C]/20 outline-none min-h-[48px] text-base transition-colors"
                                       data-i18n-placeholder="survey.biz.placeholder.email"
                                       placeholder="you@company.com">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1"
                                       data-i18n="survey.biz.field.phone">Phone</label>
                                <input type="tel" x-model="answers.contact_phone" @input="saveAnswers()"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0F7B6C] focus:ring-2 focus:ring-[#0F7B6C]/20 outline-none min-h-[48px] text-base transition-colors"
                                       data-i18n-placeholder="survey.biz.placeholder.phone"
                                       placeholder="+39 ...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1"
                                       data-i18n="survey.biz.field.country">Country</label>
                                <select x-model="answers.contact_country" @change="saveAnswers()"
                                        class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-[#0F7B6C] focus:ring-2 focus:ring-[#0F7B6C]/20 outline-none min-h-[48px] text-base bg-white transition-colors">
                                    <option value="" data-i18n="survey.biz.country_placeholder">Select country...</option>
                                    <template x-for="c in countryOptions" :key="c">
                                        <option :value="c" x-text="c"></option>
                                    </template>
                                </select>
                            </div>

                            <div class="space-y-3 pt-2">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" x-model="answers.wants_insights" @change="saveAnswers()"
                                           class="mt-0.5 w-5 h-5 rounded border-gray-300 text-[#0F7B6C] focus:ring-[#0F7B6C]">
                                    <span class="text-sm text-gray-700"
                                          data-i18n="survey.biz.opt.insights">Send me a summary of the survey insights</span>
                                </label>
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" x-model="answers.wants_solutions_contact" @change="saveAnswers()"
                                           class="mt-0.5 w-5 h-5 rounded border-gray-300 text-[#0F7B6C] focus:ring-[#0F7B6C]">
                                    <span class="text-sm text-gray-700"
                                          data-i18n="survey.biz.opt.solutions">Contact me about possible AI solutions for my business</span>
                                </label>
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" x-model="answers.wants_pilot" @change="saveAnswers()"
                                           class="mt-0.5 w-5 h-5 rounded border-gray-300 text-[#0F7B6C] focus:ring-[#0F7B6C]">
                                    <span class="text-sm text-gray-700"
                                          data-i18n="survey.biz.opt.pilot">Contact me about pilot opportunities</span>
                                </label>
                            </div>

                            {{-- GDPR consent --}}
                            <div x-show="hasContactInfo" class="pt-2">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" x-model="answers.gdpr_consent" @change="saveAnswers()"
                                           class="mt-0.5 w-5 h-5 rounded border-gray-300 text-[#0F7B6C] focus:ring-[#0F7B6C]">
                                    <span class="text-sm text-gray-600">
                                        <span data-i18n="survey.biz.gdpr.text">I consent to Corvalys processing my data to respond to my request, in accordance with GDPR and the</span>
                                        <a href="{{ route('privacy') }}" target="_blank" class="text-[#0F7B6C] underline hover:text-[#0a5f54]"
                                           data-i18n="survey.biz.gdpr.link">Privacy Policy</a>.
                                    </span>
                                </label>
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-3 mt-8 pt-4 border-t border-gray-100">
                            <button @click="submitSurvey(true)"
                                    :disabled="submitting"
                                    class="flex-1 px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-semibold rounded-xl transition-colors min-h-[48px] text-sm"
                                    type="button"
                                    data-i18n="survey.biz.submit.skip_contact">
                                Submit without contact info
                            </button>
                            <button @click="submitSurvey(false)"
                                    :disabled="submitting || (hasContactInfo && !answers.gdpr_consent)"
                                    :class="(submitting || (hasContactInfo && !answers.gdpr_consent))
                                        ? 'bg-gray-200 text-gray-400 cursor-not-allowed'
                                        : 'bg-[#0F7B6C] hover:bg-[#0a5f54] text-white'"
                                    class="flex-1 px-6 py-3 font-semibold rounded-xl transition-colors min-h-[48px] text-sm"
                                    type="button">
                                <span x-show="!submitting" data-i18n="survey.biz.submit.send">Submit</span>
                                <span x-show="submitting" class="flex items-center justify-center gap-2">
                                    <svg class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"/></svg>
                                    <span data-i18n="survey.biz.submit.sending">Submitting...</span>
                                </span>
                            </button>
                        </div>
                    </div>
                </template>

                {{-- ═══════════════════════════════════════
                     STEP 21: THANK YOU
                ═══════════════════════════════════════ --}}
                <template x-if="step === totalQuestions + 2">
                    <div class="flex flex-col items-center text-center flex-1 justify-center py-8"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100">
                        <div class="w-20 h-20 rounded-full bg-[#0F7B6C]/10 flex items-center justify-center mb-6">
                            <svg class="w-10 h-10 text-[#0F7B6C]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                        </div>
                        <h2 class="font-heading text-2xl sm:text-3xl font-bold text-[#1B3A5C] mb-4"
                            data-i18n="survey.biz.thanks.title">Thank you!</h2>
                        <p class="text-gray-500 text-base sm:text-lg max-w-md leading-relaxed mb-2"
                           data-i18n="survey.biz.thanks.body">
                            Your responses help us understand what European businesses really need. Together, we're building smarter tools for real work.
                        </p>
                        <p x-show="hasContactInfo" class="text-[#0F7B6C] font-medium mb-8"
                           data-i18n="survey.biz.thanks.followup">
                            We'll be in touch soon.
                        </p>
                        <div x-show="!hasContactInfo" class="mb-8"></div>
                        <a href="{{ url('/') }}"
                           class="px-8 py-4 bg-[#0F7B6C] hover:bg-[#0a5f54] text-white font-semibold rounded-xl transition-colors text-lg min-h-[48px] inline-flex items-center"
                           data-i18n="survey.biz.thanks.cta">
                            Go to Homepage
                        </a>
                    </div>
                </template>

            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script @cspNonce>
function businessSurvey() {
    return {
        step: 0,
        answers: {},
        submitting: false,
        totalQuestions: 19,

        countryOptions: [
            'Italy','Germany','France','Spain','Netherlands','Belgium','Austria','Portugal',
            'Greece','Poland','Czech Republic','Romania','Ireland','Sweden','Denmark',
            'Finland','Norway','Switzerland','Luxembourg','United Kingdom','Other'
        ],

        questions: [
            {
                id: 1, field: 'company_size', type: 'single',
                title: 'How big is your company?',
                options: [
                    { value: '1_5', label: '1-5 people', icon: '\u{1F464}' },
                    { value: '6_20', label: '6-20 people', icon: '\u{1F465}' },
                    { value: '21_50', label: '21-50 people', icon: '\u{1F3E2}' },
                    { value: '51_200', label: '51-200 people', icon: '\u{1F3ED}' },
                    { value: '200_plus', label: '200+ people', icon: '\u{1F310}' }
                ]
            },
            {
                id: 2, field: 'sector', type: 'single',
                title: 'What sector are you in?',
                options: [
                    { value: 'retail', label: 'Retail & E-commerce', icon: '\u{1F6D2}' },
                    { value: 'manufacturing', label: 'Manufacturing', icon: '\u2699\uFE0F' },
                    { value: 'logistics', label: 'Logistics & Transport', icon: '\u{1F69B}' },
                    { value: 'food_hospitality', label: 'Food & Hospitality', icon: '\u{1F37D}\uFE0F' },
                    { value: 'consulting', label: 'Consulting & Professional Services', icon: '\u{1F4BC}' },
                    { value: 'other', label: 'Other', icon: '\u{1F4E6}' }
                ]
            },
            {
                id: 3, field: 'country', type: 'select',
                title: 'Where is your business based?',
                options: [
                    'Italy','Germany','France','Spain','Netherlands','Belgium','Austria','Portugal',
                    'Greece','Poland','Czech Republic','Romania','Ireland','Sweden','Denmark',
                    'Finland','Norway','Switzerland','Luxembourg','United Kingdom','Other'
                ].map(c => ({ value: c, label: c }))
            },
            {
                id: 4, field: 'respondent_role', type: 'single',
                title: "What's your role?",
                options: [
                    { value: 'owner', label: 'Owner / Founder' },
                    { value: 'ceo_gm', label: 'CEO / General Manager' },
                    { value: 'operations', label: 'Operations' },
                    { value: 'finance', label: 'Finance / Accounting' },
                    { value: 'sales_marketing', label: 'Sales / Marketing' },
                    { value: 'it', label: 'IT / Technology' },
                    { value: 'hr', label: 'HR / People' },
                    { value: 'other', label: 'Other' }
                ]
            },
            {
                id: 5, field: 'frustration_areas', type: 'multi', sectorSpecific: true,
                title: 'What frustrates you the most at work?',
                subtitle: 'Select all that apply',
                options: [
                    { value: 'manual_data_entry', label: 'Manual data entry', sectors: ['all'] },
                    { value: 'email_overload', label: 'Email overload', sectors: ['all'] },
                    { value: 'invoice_processing', label: 'Invoice and payment processing', sectors: ['all'] },
                    { value: 'scheduling', label: 'Scheduling and calendar management', sectors: ['all'] },
                    { value: 'document_filing', label: 'Document filing and search', sectors: ['all'] },
                    { value: 'reporting', label: 'Generating reports', sectors: ['all'] },
                    // Retail
                    { value: 'inventory_tracking', label: 'Inventory tracking', sectors: ['retail'] },
                    { value: 'order_processing', label: 'Order processing', sectors: ['retail'] },
                    { value: 'customer_inquiries', label: 'Customer service inquiries', sectors: ['retail'] },
                    { value: 'product_listings', label: 'Product listing management', sectors: ['retail'] },
                    { value: 'returns_processing', label: 'Returns processing', sectors: ['retail'] },
                    // Manufacturing
                    { value: 'production_planning', label: 'Production planning', sectors: ['manufacturing'] },
                    { value: 'quality_control', label: 'Quality control documentation', sectors: ['manufacturing'] },
                    { value: 'equipment_maintenance', label: 'Equipment maintenance tracking', sectors: ['manufacturing'] },
                    { value: 'supply_coordination', label: 'Supply chain coordination', sectors: ['manufacturing'] },
                    { value: 'compliance_docs', label: 'Compliance and safety reports', sectors: ['manufacturing'] },
                    // Logistics
                    { value: 'route_planning', label: 'Route planning', sectors: ['logistics'] },
                    { value: 'shipment_tracking', label: 'Shipment tracking', sectors: ['logistics'] },
                    { value: 'warehouse_mgmt', label: 'Warehouse management', sectors: ['logistics'] },
                    { value: 'customs_docs', label: 'Customs documentation', sectors: ['logistics'] },
                    { value: 'driver_scheduling', label: 'Driver scheduling', sectors: ['logistics'] },
                    // Food & Hospitality
                    { value: 'reservation_mgmt', label: 'Reservation management', sectors: ['food_hospitality'] },
                    { value: 'menu_costing', label: 'Menu planning and costing', sectors: ['food_hospitality'] },
                    { value: 'staff_scheduling', label: 'Staff scheduling', sectors: ['food_hospitality'] },
                    { value: 'supplier_ordering', label: 'Supplier ordering', sectors: ['food_hospitality'] },
                    { value: 'health_safety', label: 'Health and safety compliance', sectors: ['food_hospitality'] },
                    // Consulting
                    { value: 'proposal_writing', label: 'Proposal writing', sectors: ['consulting'] },
                    { value: 'time_billing', label: 'Time tracking and billing', sectors: ['consulting'] },
                    { value: 'client_reporting', label: 'Client reporting', sectors: ['consulting'] },
                    { value: 'knowledge_mgmt', label: 'Knowledge management', sectors: ['consulting'] },
                    { value: 'contract_mgmt', label: 'Contract management', sectors: ['consulting'] }
                ]
            },
            {
                id: 6, field: 'main_pain_driver', type: 'dynamic_single',
                title: 'Which ONE frustration is the biggest?',
                subtitle: 'Pick the one that costs you the most time or money',
                dynamicFrom: 'frustration_areas'
            },
            {
                id: 7, field: 'pain_frequency', type: 'single',
                title: 'How often does this problem happen?',
                options: [
                    { value: 'daily', label: 'Every day', icon: '\u{1F534}' },
                    { value: 'several_weekly', label: 'Several times a week', icon: '\u{1F7E0}' },
                    { value: 'weekly', label: 'About once a week', icon: '\u{1F7E1}' },
                    { value: 'monthly', label: 'A few times a month', icon: '\u{1F7E2}' },
                    { value: 'rarely', label: 'Rarely', icon: '\u26AA' }
                ]
            },
            {
                id: 8, field: 'time_wasted_weekly', type: 'single',
                title: 'How much time do you waste on it per week?',
                options: [
                    { value: 'under_1h', label: 'Less than 1 hour' },
                    { value: '1_3h', label: '1-3 hours' },
                    { value: '3_5h', label: '3-5 hours' },
                    { value: '5_10h', label: '5-10 hours' },
                    { value: 'over_10h', label: 'More than 10 hours' }
                ]
            },
            {
                id: 9, field: 'pain_severity', type: 'scale',
                title: 'How much does this affect your business?',
                subtitle: '1 = minor annoyance, 5 = serious problem'
            },
            {
                id: 10, field: 'repetitive_tasks', type: 'multi', sectorSpecific: true,
                title: 'What repetitive tasks eat your time?',
                subtitle: 'Select all that apply',
                options: [
                    { value: 'copying_data', label: 'Copying data between systems', sectors: ['all'] },
                    { value: 'sending_reminders', label: 'Sending reminders and follow-ups', sectors: ['all'] },
                    { value: 'creating_invoices', label: 'Creating and sending invoices', sectors: ['all'] },
                    { value: 'updating_spreadsheets', label: 'Updating spreadsheets', sectors: ['all'] },
                    { value: 'answering_same_questions', label: 'Answering the same questions', sectors: ['all'] },
                    { value: 'formatting_documents', label: 'Formatting documents', sectors: ['all'] },
                    // Retail
                    { value: 'updating_prices', label: 'Updating product prices', sectors: ['retail'] },
                    { value: 'processing_orders', label: 'Processing orders manually', sectors: ['retail'] },
                    { value: 'stock_counting', label: 'Counting and restocking inventory', sectors: ['retail'] },
                    { value: 'customer_returns', label: 'Processing customer returns', sectors: ['retail'] },
                    // Manufacturing
                    { value: 'logging_production', label: 'Logging production data', sectors: ['manufacturing'] },
                    { value: 'tracking_materials', label: 'Tracking raw materials', sectors: ['manufacturing'] },
                    { value: 'filing_quality_reports', label: 'Filing quality reports', sectors: ['manufacturing'] },
                    { value: 'maintenance_logs', label: 'Updating maintenance logs', sectors: ['manufacturing'] },
                    // Logistics
                    { value: 'tracking_parcels', label: 'Tracking parcels and shipments', sectors: ['logistics'] },
                    { value: 'printing_labels', label: 'Printing shipping labels', sectors: ['logistics'] },
                    { value: 'updating_delivery_status', label: 'Updating delivery status', sectors: ['logistics'] },
                    { value: 'coordinating_drivers', label: 'Coordinating with drivers', sectors: ['logistics'] },
                    // Food & Hospitality
                    { value: 'managing_reservations', label: 'Managing reservations', sectors: ['food_hospitality'] },
                    { value: 'ordering_supplies', label: 'Ordering supplies from vendors', sectors: ['food_hospitality'] },
                    { value: 'roster_planning', label: 'Planning staff rosters', sectors: ['food_hospitality'] },
                    { value: 'food_costing', label: 'Calculating food costs', sectors: ['food_hospitality'] },
                    // Consulting
                    { value: 'logging_hours', label: 'Logging billable hours', sectors: ['consulting'] },
                    { value: 'writing_status_updates', label: 'Writing status updates', sectors: ['consulting'] },
                    { value: 'preparing_presentations', label: 'Preparing presentations', sectors: ['consulting'] },
                    { value: 'research_compilation', label: 'Compiling research', sectors: ['consulting'] }
                ]
            },
            {
                id: 11, field: 'top_delegate_tasks', type: 'dynamic_multi',
                title: 'If you could hand off 3 tasks to an AI assistant, which ones?',
                subtitle: 'Pick up to 3',
                dynamicFrom: 'repetitive_tasks',
                maxSelect: 3
            },
            {
                id: 12, field: 'preferred_outcome', type: 'single',
                title: 'What outcome matters most to you?',
                options: [
                    { value: 'save_time', label: 'Save time on repetitive work', icon: '\u23F1\uFE0F' },
                    { value: 'reduce_costs', label: 'Reduce operating costs', icon: '\u{1F4B0}' },
                    { value: 'fewer_errors', label: 'Fewer mistakes and errors', icon: '\u2705' },
                    { value: 'faster_growth', label: 'Grow revenue faster', icon: '\u{1F4C8}' },
                    { value: 'better_decisions', label: 'Better decisions with data', icon: '\u{1F4CA}' },
                    { value: 'improve_cx', label: 'Improve customer experience', icon: '\u{1F60A}' }
                ]
            },
            {
                id: 13, field: 'current_ai_usage', type: 'single',
                title: 'Do you currently use any AI tools?',
                options: [
                    { value: 'none', label: 'No, never' },
                    { value: 'tried_once', label: 'Tried once or twice' },
                    { value: 'use_occasionally', label: 'I use them occasionally' },
                    { value: 'use_regularly', label: 'I use them regularly' }
                ]
            },
            {
                id: 14, field: 'ai_concerns', type: 'multi',
                title: 'What concerns you about AI?',
                subtitle: 'Select all that apply',
                options: [
                    { value: 'data_security', label: 'Data security and privacy' },
                    { value: 'cost', label: 'Too expensive' },
                    { value: 'complexity', label: 'Too complex to set up' },
                    { value: 'job_loss', label: 'Might replace jobs' },
                    { value: 'accuracy', label: 'AI might make mistakes' },
                    { value: 'not_understand', label: "I don't understand how it works" },
                    { value: 'no_concern', label: 'No major concerns' }
                ]
            },
            {
                id: 15, field: 'readiness_statement', type: 'single',
                title: 'Which statement best describes you?',
                options: [
                    { value: 'ready_now', label: "I'm ready to try AI tools now" },
                    { value: 'open_to_it', label: "I'm open but need guidance" },
                    { value: 'curious', label: "I'm curious but not sure where to start" },
                    { value: 'skeptical', label: "I'm skeptical AI can help my business" },
                    { value: 'not_interested', label: "I don't think AI is relevant for us" }
                ]
            },
            {
                id: 16, field: 'preferred_ai_areas', type: 'multi',
                title: 'Where would an AI assistant help you most?',
                subtitle: 'Select all that apply',
                options: [
                    { value: 'admin_tasks', label: 'Administrative tasks and data entry' },
                    { value: 'finance_invoicing', label: 'Finance and invoicing' },
                    { value: 'customer_support', label: 'Customer service and support' },
                    { value: 'sales_leads', label: 'Sales and lead follow-up' },
                    { value: 'reports_analytics', label: 'Reports and business analytics' },
                    { value: 'inventory_supply', label: 'Inventory and supply chain' },
                    { value: 'compliance_documentation', label: 'Compliance and documentation' },
                    { value: 'marketing_content_creation', label: 'Marketing and content creation' }
                ]
            },
            {
                id: 17, field: 'preferred_support_model', type: 'single',
                title: 'How would you prefer to get AI support?',
                options: [
                    { value: 'self_service', label: 'Self-service tool I use myself' },
                    { value: 'guided_setup', label: 'Guided setup with some support' },
                    { value: 'done_for_me', label: 'Done-for-me by a consultant' },
                    { value: 'hybrid', label: 'Mix of self-service and expert support' }
                ]
            },
            {
                id: 18, field: 'preferred_start_method', type: 'single',
                title: 'How would you like to start?',
                options: [
                    { value: 'free_trial', label: 'Free trial' },
                    { value: 'demo', label: 'Live demo or walkthrough' },
                    { value: 'pilot', label: 'Paid pilot on a real problem' },
                    { value: 'consultation', label: 'Free consultation first' },
                    { value: 'case_studies', label: 'Show me case studies first' }
                ]
            },
            {
                id: 19, field: 'trust_factors', type: 'multi',
                title: 'What would make you trust a new AI tool?',
                subtitle: 'Select all that apply',
                options: [
                    { value: 'data_privacy', label: 'Strong data privacy (GDPR)' },
                    { value: 'eu_based', label: 'EU-based company' },
                    { value: 'easy_cancel', label: 'Easy to cancel, no lock-in' },
                    { value: 'roi_proof', label: 'Clear ROI proof before buying' },
                    { value: 'peer_reviews', label: 'Reviews from similar businesses' },
                    { value: 'human_support', label: 'Access to human support' },
                    { value: 'free_start', label: 'Free to start' }
                ]
            }
        ],

        get currentQuestion() {
            return this.questions[this.step - 1] || {};
        },

        get progressPercent() {
            if (this.step === 0) return 0;
            if (this.step > this.totalQuestions + 1) return 100;
            return Math.round((this.step / (this.totalQuestions + 1)) * 100);
        },

        get hasContactInfo() {
            return !!(this.answers.contact_name || this.answers.contact_company ||
                      this.answers.contact_email || this.answers.contact_phone);
        },

        init() {
            const saved = sessionStorage.getItem('corvalys_business_survey');
            if (saved) {
                try {
                    this.answers = JSON.parse(saved);
                } catch (e) {
                    this.answers = {};
                }
            }
        },

        saveAnswers() {
            sessionStorage.setItem('corvalys_business_survey', JSON.stringify(this.answers));
        },

        getFilteredOptions(question) {
            if (!question.sectorSpecific) return question.options;
            const sector = this.answers.sector || '';
            return question.options.filter(opt => {
                if (!opt.sectors) return true;
                return opt.sectors.includes('all') || opt.sectors.includes(sector);
            });
        },

        getDynamicOptions(question) {
            const sourceField = question.dynamicFrom;
            const selectedValues = this.answers[sourceField] || [];
            if (!selectedValues.length) return [];

            // Find source question to get labels
            const sourceQuestion = this.questions.find(q => q.field === sourceField);
            if (!sourceQuestion) return [];

            return sourceQuestion.options
                .filter(opt => selectedValues.includes(opt.value))
                .map(opt => ({ value: opt.value, label: opt.label }));
        },

        selectSingle(field, value) {
            this.answers[field] = value;
            this.saveAnswers();
            setTimeout(() => this.goForward(), 300);
        },

        selectScale(field, value) {
            this.answers[field] = value;
            this.saveAnswers();
            setTimeout(() => this.goForward(), 300);
        },

        toggleMulti(field, value, maxSelect) {
            if (!this.answers[field]) this.answers[field] = [];
            const idx = this.answers[field].indexOf(value);
            if (idx > -1) {
                this.answers[field].splice(idx, 1);
            } else {
                if (maxSelect && this.answers[field].length >= maxSelect) return;
                this.answers[field].push(value);
            }
            this.saveAnswers();
        },

        goForward() {
            if (this.step <= this.totalQuestions) {
                this.step++;
                this.$nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }));
            }
        },

        goBack() {
            if (this.step > 1) {
                this.step--;
                this.$nextTick(() => window.scrollTo({ top: 0, behavior: 'smooth' }));
            }
        },

        async submitSurvey(skipContact) {
            this.submitting = true;
            const payload = { ...this.answers };
            if (skipContact) {
                delete payload.contact_name;
                delete payload.contact_company;
                delete payload.contact_email;
                delete payload.contact_phone;
                delete payload.contact_country;
                delete payload.wants_insights;
                delete payload.wants_solutions_contact;
                delete payload.wants_pilot;
                delete payload.gdpr_consent;
            }

            try {
                const response = await fetch('{{ route("business-survey.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(payload)
                });

                if (response.ok) {
                    sessionStorage.removeItem('corvalys_business_survey');
                    this.step = this.totalQuestions + 2;
                } else {
                    alert('Something went wrong. Please try again.');
                }
            } catch (e) {
                alert('Network error. Please check your connection and try again.');
            } finally {
                this.submitting = false;
            }
        }
    };
}
</script>
@endpush
