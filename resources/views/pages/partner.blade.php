@extends('layouts.app')

@section('title', __('partner.meta.title', [], app()->getLocale()) ?: 'Diventa Partner — Corvalys')
@section('meta_description', __('partner.meta.description', [], app()->getLocale()) ?: '')

@section('content')

    {{-- ── Hero ── --}}
    <section class="bg-hero text-white pt-32 pb-24 lg:pt-40 lg:pb-32">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <h1
                class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold tracking-tight leading-tight mb-6"
                data-i18n="partner.hero.title"
            >
                Become a Partner
            </h1>
            <p
                class="text-lg sm:text-xl text-white/70 max-w-2xl mx-auto leading-relaxed"
                data-i18n="partner.hero.sub"
            >
                Join the Corvalys partner network and grow your business by bringing AI to European SMEs.
            </p>
        </div>
    </section>

    {{-- ── Benefits ── --}}
    <section class="section bg-white">
        <div class="max-w-7xl mx-auto px-6">

            <div class="text-center mb-14">
                <h2
                    class="section-title mb-4"
                    data-i18n="partner.benefits.heading"
                >
                    Why Partner with Corvalys?
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="partner.benefits.sub"
                >
                    Everything you need to deliver value and earn alongside your clients.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">

                {{-- Benefit 1 --}}
                <div class="card flex flex-col items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div>
                        <h3
                            class="font-heading font-bold text-gray-900 mb-2"
                            data-i18n="partner.benefit1.title"
                        >
                            20% MRR Commission
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="partner.benefit1.desc"
                        >
                            Earn a recurring 20% commission on every active subscription you bring on board, month after month.
                        </p>
                    </div>
                </div>

                {{-- Benefit 2 --}}
                <div class="card flex flex-col items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"/>
                        </svg>
                    </div>
                    <div>
                        <h3
                            class="font-heading font-bold text-gray-900 mb-2"
                            data-i18n="partner.benefit2.title"
                        >
                            Dedicated Dashboard
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="partner.benefit2.desc"
                        >
                            Manage all your clients from a single partner portal. Track usage, commissions, and renewals in real time.
                        </p>
                    </div>
                </div>

                {{-- Benefit 3 --}}
                <div class="card flex flex-col items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                        </svg>
                    </div>
                    <div>
                        <h3
                            class="font-heading font-bold text-gray-900 mb-2"
                            data-i18n="partner.benefit3.title"
                        >
                            Training &amp; Support
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="partner.benefit3.desc"
                        >
                            Onboarding sessions, product certifications, and a dedicated partner success manager at your side.
                        </p>
                    </div>
                </div>

                {{-- Benefit 4 --}}
                <div class="card flex flex-col items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 flex items-center justify-center shrink-0">
                        <svg class="w-6 h-6 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                    </div>
                    <div>
                        <h3
                            class="font-heading font-bold text-gray-900 mb-2"
                            data-i18n="partner.benefit4.title"
                        >
                            Co-Marketing
                        </h3>
                        <p
                            class="text-gray-500 text-sm leading-relaxed"
                            data-i18n="partner.benefit4.desc"
                        >
                            Joint campaigns, co-branded materials, and joint webinars to amplify your reach across European markets.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- ── Application Form ── --}}
    <section class="section bg-section-alt">
        <div class="max-w-2xl mx-auto px-6">

            <div class="text-center mb-12">
                <h2
                    class="section-title mb-4"
                    data-i18n="partner.form.heading"
                >
                    Apply to Become a Partner
                </h2>
                <p
                    class="section-sub mx-auto"
                    data-i18n="partner.form.sub"
                >
                    Fill in the form below and our partnership team will get back to you within two business days.
                </p>
            </div>

            {{-- Success flash --}}
            @if(session('success'))
                <div class="mb-8 rounded-xl bg-green-50 border border-green-200 px-5 py-4 flex items-start gap-3">
                    <svg class="w-5 h-5 text-green-500 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-green-700 text-sm font-medium" data-i18n="partner.form.success">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            <form
                action="{{ route('partner.store') }}"
                method="POST"
                class="card space-y-6"
            >
                @csrf

                {{-- Name --}}
                <div>
                    <label
                        for="name"
                        class="block text-sm font-medium text-gray-700 mb-1.5"
                        data-i18n="partner.form.name_label"
                    >
                        Full Name
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        value="{{ old('name') }}"
                        class="w-full rounded-xl border @error('name') border-red-400 bg-red-50 @else border-gray-200 @enderror px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition"
                        data-i18n-placeholder="partner.form.name_placeholder"
                        placeholder="Your full name"
                    >
                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="block text-sm font-medium text-gray-700 mb-1.5"
                        data-i18n="partner.form.email_label"
                    >
                        Business Email
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        value="{{ old('email') }}"
                        class="w-full rounded-xl border @error('email') border-red-400 bg-red-50 @else border-gray-200 @enderror px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition"
                        data-i18n-placeholder="partner.form.email_placeholder"
                        placeholder="you@yourcompany.com"
                    >
                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Studio / Company name --}}
                <div>
                    <label
                        for="studio_name"
                        class="block text-sm font-medium text-gray-700 mb-1.5"
                        data-i18n="partner.form.studio_label"
                    >
                        Studio / Company Name
                    </label>
                    <input
                        type="text"
                        id="studio_name"
                        name="studio_name"
                        required
                        value="{{ old('studio_name') }}"
                        class="w-full rounded-xl border @error('studio_name') border-red-400 bg-red-50 @else border-gray-200 @enderror px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition"
                        data-i18n-placeholder="partner.form.studio_placeholder"
                        placeholder="Your studio or company name"
                    >
                    @error('studio_name')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Clients count --}}
                <div>
                    <label
                        for="clients_count"
                        class="block text-sm font-medium text-gray-700 mb-1.5"
                        data-i18n="partner.form.clients_label"
                    >
                        Approximate Number of Clients
                    </label>
                    <input
                        type="number"
                        id="clients_count"
                        name="clients_count"
                        min="0"
                        value="{{ old('clients_count') }}"
                        class="w-full rounded-xl border @error('clients_count') border-red-400 bg-red-50 @else border-gray-200 @enderror px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition"
                        data-i18n-placeholder="partner.form.clients_placeholder"
                        placeholder="e.g. 25"
                    >
                    @error('clients_count')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Message --}}
                <div>
                    <label
                        for="message"
                        class="block text-sm font-medium text-gray-700 mb-1.5"
                        data-i18n="partner.form.message_label"
                    >
                        Tell us about your business
                    </label>
                    <textarea
                        id="message"
                        name="message"
                        rows="5"
                        class="w-full rounded-xl border @error('message') border-red-400 bg-red-50 @else border-gray-200 @enderror px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-primary/40 focus:border-primary transition resize-none"
                        data-i18n-placeholder="partner.form.message_placeholder"
                        placeholder="Describe your current offering, your clients' main challenges, and why you want to partner with Corvalys."
                    >{{ old('message') }}</textarea>
                    @error('message')
                        <p class="mt-1.5 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit --}}
                <div class="pt-2">
                    <button
                        type="submit"
                        class="btn-primary w-full justify-center"
                        data-i18n="partner.form.submit"
                    >
                        Submit Application
                    </button>
                </div>

            </form>
        </div>
    </section>

@endsection
