@extends('layouts.app')

@section('title', __('legal.privacy.meta_title', [], app()->getLocale()) ?: 'Privacy Policy — Corvalys')
@section('meta_description', __('legal.privacy.meta_description', [], app()->getLocale()) ?: '')

@section('content')

    {{-- ── Page Header ── --}}
    <section class="bg-hero text-white pt-32 pb-16 lg:pt-40 lg:pb-20">
        <div class="max-w-4xl mx-auto px-6">
            <h1
                class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight mb-4"
                data-i18n="legal.privacy.title"
            >
                Privacy Policy
            </h1>
            <p class="text-white/60 text-sm" data-i18n="legal.privacy.updated">
                Last updated: 29 March 2026
            </p>
        </div>
    </section>

    {{-- ── Content ── --}}
    <section class="section bg-white">
        <div class="max-w-4xl mx-auto px-6">

            {{--
                The data-i18n-html attribute allows the i18n JS layer to inject
                fully formatted HTML (headings, paragraphs, lists) from the
                translation file. The static content below serves as the
                server-side fallback and for SEO crawlers.
            --}}
            <div
                class="prose prose-gray prose-headings:font-heading prose-headings:font-bold prose-a:text-primary prose-a:no-underline hover:prose-a:underline max-w-none"
                data-i18n-html="legal.privacy.body"
            >

                <h2>1. Data Controller</h2>
                <p>
                    The data controller is <strong>Corvalys LTD</strong>, a company registered in Italy.
                    You can reach us at <a href="mailto:info@corvalys.eu">info@corvalys.eu</a> or through our website
                    <a href="https://corvalys.eu">corvalys.eu</a>.
                </p>

                <h2>2. Data We Collect</h2>
                <p>We may collect and process the following categories of personal data:</p>
                <ul>
                    <li><strong>Identity data:</strong> first name, last name, company name, job title.</li>
                    <li><strong>Contact data:</strong> email address, phone number, postal address.</li>
                    <li><strong>Technical data:</strong> IP address, browser type and version, time zone, operating system, device identifiers.</li>
                    <li><strong>Usage data:</strong> information about how you use our website and platform.</li>
                    <li><strong>Marketing and communications data:</strong> your preferences for receiving marketing communications from us.</li>
                </ul>

                <h2>3. Purposes and Legal Bases</h2>
                <p>We use your personal data for the following purposes:</p>
                <ul>
                    <li>To provide and manage our services — <em>performance of a contract (Art. 6(1)(b) GDPR)</em>.</li>
                    <li>To comply with legal and regulatory obligations — <em>legal obligation (Art. 6(1)(c) GDPR)</em>.</li>
                    <li>To send you marketing communications where you have opted in — <em>consent (Art. 6(1)(a) GDPR)</em>.</li>
                    <li>To improve our platform and conduct analytics — <em>legitimate interests (Art. 6(1)(f) GDPR)</em>.</li>
                </ul>

                <h2>4. Data Retention</h2>
                <p>
                    We retain personal data only for as long as necessary to fulfil the purposes for which it was collected,
                    including satisfying any legal, accounting, or reporting requirements. In general, client data is retained
                    for up to seven years after the end of the contractual relationship.
                </p>

                <h2>5. Data Sharing</h2>
                <p>
                    We do not sell your personal data. We may share it with trusted third-party service providers
                    (hosting, payment processing, email delivery) who act as data processors under written agreements
                    and are bound to process data only on our instructions. Where data is transferred outside the EEA,
                    we ensure appropriate safeguards are in place (e.g., Standard Contractual Clauses).
                </p>

                <h2>6. Your Rights</h2>
                <p>Under the GDPR, you have the right to:</p>
                <ul>
                    <li><strong>Access</strong> the personal data we hold about you.</li>
                    <li><strong>Rectify</strong> inaccurate or incomplete data.</li>
                    <li><strong>Erase</strong> your data ("right to be forgotten") where the legal basis no longer applies.</li>
                    <li><strong>Restrict</strong> processing in certain circumstances.</li>
                    <li><strong>Object</strong> to processing based on legitimate interests.</li>
                    <li><strong>Data portability</strong> — receive your data in a structured, machine-readable format.</li>
                    <li><strong>Withdraw consent</strong> at any time, without affecting the lawfulness of processing prior to withdrawal.</li>
                </ul>
                <p>
                    To exercise any of these rights, please contact us at
                    <a href="mailto:info@corvalys.eu">info@corvalys.eu</a>.
                    You also have the right to lodge a complaint with your national data protection authority.
                </p>

                <h2>7. Cookies</h2>
                <p>
                    We use cookies and similar tracking technologies. Please refer to our
                    <a href="{{ route('cookie') }}">Cookie Policy</a> for full details.
                </p>

                <h2>8. Changes to This Policy</h2>
                <p>
                    We may update this Privacy Policy from time to time. The "Last updated" date at the top of this page
                    will reflect any changes. We encourage you to review this policy periodically.
                </p>

                <h2>9. Contact</h2>
                <p>
                    For any privacy-related questions, please contact Corvalys LTD at
                    <a href="mailto:info@corvalys.eu">info@corvalys.eu</a>.
                </p>

            </div>

        </div>
    </section>

@endsection
