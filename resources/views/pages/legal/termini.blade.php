@extends('layouts.app')

@section('title', __('legal.terms.meta_title', [], app()->getLocale()) ?: 'Terms of Service — Corvalys')
@section('meta_description', __('legal.terms.meta_description', [], app()->getLocale()) ?: '')

@section('content')

    {{-- ── Page Header ── --}}
    <section class="bg-hero text-white pt-32 pb-16 lg:pt-40 lg:pb-20">
        <div class="max-w-4xl mx-auto px-6">
            <h1
                class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight mb-4"
                data-i18n="legal.terms.title"
            >
                Terms of Service
            </h1>
            <p class="text-white/60 text-sm" data-i18n="legal.terms.updated">
                Last updated: 29 March 2026
            </p>
        </div>
    </section>

    {{-- ── Content ── --}}
    <section class="section bg-white">
        <div class="max-w-4xl mx-auto px-6">

            <div
                class="prose prose-gray prose-headings:font-heading prose-headings:font-bold prose-a:text-primary prose-a:no-underline hover:prose-a:underline max-w-none"
                data-i18n-html="legal.terms.body"
            >

                <h2>1. Acceptance of Terms</h2>
                <p>
                    By accessing or using the services provided by <strong>Corvalys LTD</strong> through
                    <a href="https://corvalys.eu">corvalys.eu</a> (the "Service"), you agree to be bound by these
                    Terms of Service ("Terms"). If you do not agree, please do not use the Service.
                </p>

                <h2>2. Description of Service</h2>
                <p>
                    Corvalys LTD provides AI-powered automation and compliance tools designed for European small
                    and medium-sized enterprises. Features include invoice management, approval workflows, AI Act
                    compliance assistance, and related integrations.
                </p>

                <h2>3. Account Registration</h2>
                <p>
                    To access certain features you must create an account. You agree to provide accurate, complete,
                    and current information and to keep it updated. You are responsible for maintaining the
                    confidentiality of your credentials and for all activity under your account.
                </p>

                <h2>4. Subscriptions and Payment</h2>
                <p>
                    Access to the Service is provided on a subscription basis. Fees are stated on the pricing page
                    and are billed in advance. All amounts are exclusive of VAT unless otherwise stated. We reserve
                    the right to modify pricing with 30 days' notice. Continued use after a price change constitutes
                    acceptance of the new price.
                </p>

                <h2>5. Acceptable Use</h2>
                <p>You agree not to:</p>
                <ul>
                    <li>Use the Service for any unlawful purpose or in violation of applicable regulations.</li>
                    <li>Attempt to gain unauthorised access to any part of the Service or its infrastructure.</li>
                    <li>Reverse engineer, decompile, or disassemble any software component of the Service.</li>
                    <li>Upload or transmit malicious code or any content that infringes third-party rights.</li>
                    <li>Resell or sub-license access to the Service without written authorisation from Corvalys LTD</li>
                </ul>

                <h2>6. Intellectual Property</h2>
                <p>
                    All intellectual property rights in the Service and its content (excluding your data) belong to
                    Corvalys LTD or its licensors. Nothing in these Terms transfers ownership of any intellectual
                    property to you. You are granted a limited, non-exclusive, non-transferable licence to use the
                    Service solely for your internal business purposes.
                </p>

                <h2>7. Your Data</h2>
                <p>
                    You retain ownership of all data you submit to the Service. By using the Service you grant
                    Corvalys LTD a limited licence to process your data solely to deliver and improve the Service,
                    in accordance with our <a href="{{ route('privacy') }}">Privacy Policy</a>.
                </p>

                <h2>8. Confidentiality</h2>
                <p>
                    Each party agrees to keep the other's confidential information secret and to use it only as
                    necessary to fulfil obligations under these Terms, with the same degree of care it uses for its
                    own confidential information (but no less than reasonable care).
                </p>

                <h2>9. Limitation of Liability</h2>
                <p>
                    To the maximum extent permitted by applicable law, Corvalys LTD shall not be liable for any
                    indirect, incidental, special, consequential, or punitive damages arising out of or related to
                    your use of the Service. Our total liability shall not exceed the fees you paid in the twelve
                    months preceding the claim.
                </p>

                <h2>10. Warranty Disclaimer</h2>
                <p>
                    The Service is provided "as is" without warranty of any kind, express or implied, including but
                    not limited to warranties of merchantability, fitness for a particular purpose, and
                    non-infringement. We do not warrant that the Service will be error-free or uninterrupted.
                </p>

                <h2>11. Term and Termination</h2>
                <p>
                    These Terms remain in effect for the duration of your subscription. Either party may terminate
                    for convenience with 30 days' written notice. We may suspend or terminate your access immediately
                    if you breach these Terms. Upon termination you will lose access to the Service and your data
                    will be handled as described in our Privacy Policy.
                </p>

                <h2>12. Governing Law</h2>
                <p>
                    These Terms are governed by and construed in accordance with the laws of Italy. Any disputes
                    shall be subject to the exclusive jurisdiction of the courts of Milan, Italy.
                </p>

                <h2>13. Changes to These Terms</h2>
                <p>
                    We may update these Terms from time to time. We will notify you of material changes by email or
                    by displaying a prominent notice on the Service at least 14 days before the changes take effect.
                    Continued use after the effective date constitutes acceptance.
                </p>

                <h2>14. Contact</h2>
                <p>
                    Questions about these Terms should be sent to Corvalys LTD at
                    <a href="mailto:info@corvalys.eu">info@corvalys.eu</a>.
                </p>

            </div>

        </div>
    </section>

@endsection
