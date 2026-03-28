@extends('layouts.app')

@section('title', 'Pricing – Corvalys')

@section('content')

{{-- Hero --}}
<section class="bg-gradient-to-br from-navy to-navy/80 py-16 lg:py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight" data-i18n="prezzi.title">
            Simple pricing, real results
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto" data-i18n="prezzi.subtitle">
            Start free for 3 months. No credit card. Cancel anytime.
        </p>
    </div>
</section>

{{-- Pricing Cards (Livewire component) --}}
<section id="pricing" class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        @livewire('pricing-toggle')
    </div>
</section>

{{-- Feature Comparison Table --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title text-center" data-i18n="prezzi.compare.title">Compare Plans</h2>

        <div class="mt-12 overflow-x-auto">
            <table class="w-full min-w-[640px] text-sm text-left">
                <thead>
                    <tr class="border-b-2 border-gray-200">
                        <th class="py-4 pr-4 font-heading font-semibold text-gray-900 w-1/5">Feature</th>
                        <th class="py-4 px-4 font-heading font-semibold text-gray-900 text-center w-1/5">Starter</th>
                        <th class="py-4 px-4 font-heading font-semibold text-primary text-center w-1/5 bg-primary/5 rounded-t-lg">Core</th>
                        <th class="py-4 px-4 font-heading font-semibold text-gray-900 text-center w-1/5">Pro</th>
                        <th class="py-4 px-4 font-heading font-semibold text-gray-900 text-center w-1/5">Business</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    {{-- Tool A --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium" data-i18n-html="prezzi.table.toolA">Tool A &mdash; Cash Controller</td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.basic">Basic</td>
                        <td class="py-4 px-4 text-center text-gray-600 bg-primary/5" data-i18n="prezzi.table.full">Full</td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.full">Full</td>
                        <td class="py-4 px-4 text-center text-gray-600">Custom</td>
                    </tr>
                    {{-- Tool B --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium" data-i18n-html="prezzi.table.toolB">Tool B &mdash; Approval Coordinator</td>
                        <td class="py-4 px-4 text-center text-gray-400">&mdash;</td>
                        <td class="py-4 px-4 text-center bg-primary/5">
                            <svg class="mx-auto h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </td>
                        <td class="py-4 px-4 text-center">
                            <svg class="mx-auto h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </td>
                        <td class="py-4 px-4 text-center text-gray-600">Custom</td>
                    </tr>
                    {{-- Tool C --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium" data-i18n-html="prezzi.table.toolC">Tool C &mdash; Compliance Officer</td>
                        <td class="py-4 px-4 text-center text-gray-400">&mdash;</td>
                        <td class="py-4 px-4 text-center text-gray-400 bg-primary/5">&mdash;</td>
                        <td class="py-4 px-4 text-center">
                            <svg class="mx-auto h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </td>
                        <td class="py-4 px-4 text-center text-gray-600">Custom</td>
                    </tr>
                    {{-- Invoices/month --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium" data-i18n="prezzi.table.invoices">Invoices/month</td>
                        <td class="py-4 px-4 text-center text-gray-600">50</td>
                        <td class="py-4 px-4 text-center text-gray-600 bg-primary/5">500</td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.unlimited">Unlimited</td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.unlimited">Unlimited</td>
                    </tr>
                    {{-- Morning brief --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium" data-i18n="prezzi.table.brief">Morning brief</td>
                        <td class="py-4 px-4 text-center text-gray-600">Email</td>
                        <td class="py-4 px-4 text-center text-gray-600 bg-primary/5">Email + Dashboard</td>
                        <td class="py-4 px-4 text-center text-gray-600">Email + Dashboard + WhatsApp</td>
                        <td class="py-4 px-4 text-center text-gray-600">Custom</td>
                    </tr>
                    {{-- Automatic reminders --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium" data-i18n="prezzi.table.reminders">Automatic reminders</td>
                        <td class="py-4 px-4 text-center text-gray-400">&mdash;</td>
                        <td class="py-4 px-4 text-center bg-primary/5">
                            <svg class="mx-auto h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" /></svg>
                        </td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.escalation">Yes + escalation</td>
                        <td class="py-4 px-4 text-center text-gray-600">Custom</td>
                    </tr>
                    {{-- AI Act compliance --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium">AI Act compliance</td>
                        <td class="py-4 px-4 text-center text-gray-400">&mdash;</td>
                        <td class="py-4 px-4 text-center text-gray-400 bg-primary/5">&mdash;</td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.report">Report + Inventory</td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.audit">Full audit</td>
                    </tr>
                    {{-- Support --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium" data-i18n="prezzi.table.support">Support</td>
                        <td class="py-4 px-4 text-center text-gray-600">Community</td>
                        <td class="py-4 px-4 text-center text-gray-600 bg-primary/5" data-i18n="prezzi.table.priority-email">Priority email</td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.call">1:1 Call</td>
                        <td class="py-4 px-4 text-center text-gray-600" data-i18n="prezzi.table.account-mgr">Account manager</td>
                    </tr>
                    {{-- Integrations --}}
                    <tr>
                        <td class="py-4 pr-4 text-gray-700 font-medium" data-i18n="prezzi.table.integrations">Integrations</td>
                        <td class="py-4 px-4 text-center text-gray-400">&mdash;</td>
                        <td class="py-4 px-4 text-center text-gray-600 bg-primary/5">Standard</td>
                        <td class="py-4 px-4 text-center text-gray-600">Standard + API</td>
                        <td class="py-4 px-4 text-center text-gray-600">Custom</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

{{-- FAQ --}}
<section class="py-20 bg-white">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title text-center" data-i18n="prezzi.faq.title">Frequently Asked Questions</h2>

        <div class="mt-12 divide-y divide-gray-200" x-data="{ open: null }">
            {{-- FAQ 1 --}}
            <div class="py-5">
                <button @click="open = open === 1 ? null : 1" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="prezzi.faq.q1">What happens after the 3 free months?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 1 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 1" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="prezzi.faq.a1">
                    You automatically switch to a limited free plan, or choose a paid plan. We never charge without your consent.
                </div>
            </div>

            {{-- FAQ 2 --}}
            <div class="py-5">
                <button @click="open = open === 2 ? null : 2" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="prezzi.faq.q2">Can I change plans?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 2 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 2" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="prezzi.faq.a2">
                    Yes, you can upgrade or downgrade at any time. The change takes effect the following month.
                </div>
            </div>

            {{-- FAQ 3 --}}
            <div class="py-5">
                <button @click="open = open === 3 ? null : 3" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="prezzi.faq.q3">How does billing work?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 3 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 3" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="prezzi.faq.a3">
                    Monthly or annual (with 20% discount). We accept credit card and SEPA bank transfer.
                </div>
            </div>

            {{-- FAQ 4 --}}
            <div class="py-5">
                <button @click="open = open === 4 ? null : 4" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="prezzi.faq.q4">Do you offer startup discounts?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 4 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 4" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="prezzi.faq.a4">
                    Yes, contact us for our startup program with dedicated terms.
                </div>
            </div>
        </div>
    </div>
</section>

{{-- AI Act Banner --}}
<section class="py-16 bg-amber/10">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
            <div class="flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-amber" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <div class="flex-1">
                <p class="text-gray-800 font-medium" data-i18n-html="prezzi.aiact.warning">
                    <strong>Attention:</strong> from August 2, 2026, the AI Act requires compliance for all AI deployers. The Pro plan includes the compliance report.
                </p>
            </div>
            <div class="flex-shrink-0">
                <a href="#pricing" class="text-primary font-semibold hover:underline whitespace-nowrap" data-i18n-html="prezzi.aiact.cta">Discover the Pro plan &rarr;</a>
            </div>
        </div>
    </div>
</section>

{{-- Final CTA --}}
<section class="py-20 bg-navy">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white" data-i18n="prezzi.cta.title">Ready to try?</h2>
        <p class="mt-4 text-lg text-gray-300" data-i18n="prezzi.cta.subtitle">3 months free, zero risk</p>
        <div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="/contatto" class="btn-primary" data-i18n="cta.inizia">Start free</a>
            <a href="/contatto" class="btn-outline border-white text-white hover:bg-white/10" data-i18n="prezzi.cta.talk">Talk to us</a>
        </div>
    </div>
</section>

@endsection
