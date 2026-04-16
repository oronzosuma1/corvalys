@extends('layouts.app')

@section('title', __('legal.cookie.meta_title', [], app()->getLocale()) ?: 'Cookie Policy — Corvalys')
@section('meta_description', __('legal.cookie.meta_description', [], app()->getLocale()) ?: '')

@section('content')

    {{-- ── Page Header ── --}}
    <section class="bg-hero text-white pt-32 pb-16 lg:pt-40 lg:pb-20">
        <div class="max-w-4xl mx-auto px-6">
            <h1
                class="font-heading text-3xl sm:text-4xl lg:text-5xl font-bold tracking-tight leading-tight mb-4"
                data-i18n="legal.cookie.title"
            >
                Cookie Policy
            </h1>
            <p class="text-white/60 text-sm" data-i18n="legal.cookie.updated">
                Last updated: 29 March 2026
            </p>
        </div>
    </section>

    {{-- ── Content ── --}}
    <section class="section bg-white">
        <div class="max-w-4xl mx-auto px-6">

            <div
                class="prose prose-gray prose-headings:font-heading prose-headings:font-bold prose-a:text-primary prose-a:no-underline hover:prose-a:underline max-w-none"
                data-i18n-html="legal.cookie.body"
            >

                <h2>1. What Are Cookies?</h2>
                <p>
                    Cookies are small text files placed on your device when you visit a website. They are widely used
                    to make websites work efficiently, to remember your preferences, and to provide information to
                    the website owners. This Cookie Policy explains how <strong>Corvalys LTD</strong>
                    (<a href="https://corvalys.eu">corvalys.eu</a>) uses cookies and similar technologies.
                </p>

                <h2>2. Types of Cookies We Use</h2>

                <h3>2.1 Strictly Necessary Cookies</h3>
                <p>
                    These cookies are essential for the website to function and cannot be disabled. They are usually
                    set in response to actions you take such as logging in or filling in forms. You can set your
                    browser to block these cookies, but some parts of the site may not work as a result.
                </p>

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Purpose</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>corvalys_session</code></td>
                            <td>Maintains user session state (Laravel session)</td>
                            <td>Session</td>
                        </tr>
                        <tr>
                            <td><code>XSRF-TOKEN</code></td>
                            <td>Cross-site request forgery protection</td>
                            <td>Session</td>
                        </tr>
                        <tr>
                            <td><code>cookie_consent</code></td>
                            <td>Stores your cookie consent choice</td>
                            <td>1 year</td>
                        </tr>
                    </tbody>
                </table>

                <h3>2.2 Functional Cookies</h3>
                <p>
                    These cookies enable enhanced functionality and personalisation such as language preferences.
                    They may be set by us or by third-party providers whose services we have added to our pages.
                </p>

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Purpose</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>locale</code></td>
                            <td>Stores your preferred interface language</td>
                            <td>1 year</td>
                        </tr>
                    </tbody>
                </table>

                <h3>2.3 Analytics Cookies</h3>
                <p>
                    These cookies allow us to count visits and traffic sources so we can measure and improve the
                    performance of our site. All information collected is aggregated and therefore anonymous.
                    If you do not allow these cookies, we will not know when you have visited our site.
                </p>

                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Provider</th>
                            <th>Purpose</th>
                            <th>Duration</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><code>_pk_id.*</code></td>
                            <td>Matomo (self-hosted)</td>
                            <td>Distinguishes users for analytics purposes</td>
                            <td>13 months</td>
                        </tr>
                        <tr>
                            <td><code>_pk_ses.*</code></td>
                            <td>Matomo (self-hosted)</td>
                            <td>Tracks the current session</td>
                            <td>30 minutes</td>
                        </tr>
                    </tbody>
                </table>

                <h3>2.4 Marketing Cookies</h3>
                <p>
                    We currently do not use marketing or advertising cookies. Should this change, this policy will
                    be updated accordingly and your consent will be requested before any such cookies are placed.
                </p>

                <h2>3. How to Manage Cookies</h2>
                <p>
                    You can control and manage cookies in several ways:
                </p>
                <ul>
                    <li>
                        <strong>Cookie banner:</strong> When you first visit corvalys.eu, you will be presented with
                        a cookie consent banner where you can accept or decline non-essential cookies.
                    </li>
                    <li>
                        <strong>Browser settings:</strong> Most browsers allow you to refuse or delete cookies through
                        their settings. Please note that blocking all cookies may affect the functionality of some
                        parts of our website.
                    </li>
                    <li>
                        <strong>Opt-out tools:</strong> For analytics, you can opt out by enabling the "Do Not Track"
                        header in your browser or by installing the Matomo opt-out plugin.
                    </li>
                </ul>

                <h2>4. Third-Party Cookies</h2>
                <p>
                    We embed content and scripts from third-party services (e.g., Vimeo for video, Google Fonts for
                    typography). These providers may set their own cookies. We encourage you to review their privacy
                    and cookie policies for further information.
                </p>

                <h2>5. Updates to This Policy</h2>
                <p>
                    We may update this Cookie Policy from time to time to reflect changes in the cookies we use or
                    for other operational, legal, or regulatory reasons. The "Last updated" date at the top of this
                    page will be revised accordingly.
                </p>

                <h2>6. Contact</h2>
                <p>
                    If you have questions about our use of cookies, please contact Corvalys LTD at
                    <a href="mailto:info@corvalys.eu">info@corvalys.eu</a>.
                </p>

            </div>

        </div>
    </section>

@endsection
