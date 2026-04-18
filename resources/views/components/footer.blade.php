{{-- Footer --}}
<footer class="bg-[#1B3A5C] text-white">

    {{-- Newsletter Band --}}
    <div class="border-b border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-10 flex flex-col sm:flex-row items-center justify-between gap-6">
            <p class="text-white/70 text-sm font-medium" data-i18n="footer.newsletter.title">
                Stay up to date with Corvalys news and product updates.
            </p>
            <form action="{{ route('newsletter') }}" method="POST"
                  class="flex w-full sm:w-auto gap-2">
                @csrf
                <input
                    type="email"
                    name="email"
                    required
                    data-i18n-placeholder="footer.newsletter.placeholder"
                    placeholder="your@email.com"
                    class="flex-1 sm:w-64 px-4 py-2.5 rounded-lg bg-white/10 border border-white/20 text-sm text-white placeholder-white/40 focus:outline-none focus:ring-2 focus:ring-white/30 transition"
                />
                <button
                    type="submit"
                    class="px-5 py-2.5 rounded-lg bg-white text-[#1B3A5C] text-sm font-semibold hover:bg-white/90 transition whitespace-nowrap"
                    data-i18n="footer.newsletter.btn">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    {{-- Main Columns --}}
    <div class="max-w-7xl mx-auto px-6 py-14">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">

            {{-- Column 1 — Brand --}}
            <div class="space-y-5">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                    <img src="{{ asset('images/logo-corvalys.png') }}"
                         alt="Corvalys logo"
                         width="40"
                         height="40"
                         class="w-10 h-10 object-contain">
                    <span class="text-lg font-bold tracking-tight text-white">Corvalys</span>
                </a>

                <p class="text-white/70 text-sm leading-relaxed"
                   data-i18n="footer.tagline">
                    AI consulting and operational improvement for European SMEs.
                </p>

                {{-- Social links --}}
                <div class="flex items-center gap-4 pt-1">
                    {{-- LinkedIn --}}
                    <a href="https://www.linkedin.com/company/corvalysholding"
                       target="_blank" rel="noopener noreferrer"
                       aria-label="LinkedIn"
                       class="text-white/50 hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 0 1-2.063-2.065 2.064 2.064 0 1 1 2.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                        </svg>
                    </a>

                    {{-- Twitter / X --}}
                    <a href="#"
                       aria-label="X (Twitter)"
                       class="text-white/50 hover:text-white transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.737-8.835L1.254 2.25H8.08l4.253 5.622L18.244 2.25zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77z"/>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- Column 2 — Products --}}
            <div class="space-y-4">
                <h3 class="text-white text-sm font-semibold uppercase tracking-widest"
                    data-i18n="footer.products">
                    Solutions
                </h3>
                <ul class="space-y-2.5">
                    <li>
                        <a href="{{ route('consulenza') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.consulenza">
                            Servizi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('prodotti') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.prodotti">
                            Prodotti
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 3 — Company --}}
            <div class="space-y-4">
                <h3 class="text-white text-sm font-semibold uppercase tracking-widest"
                    data-i18n="footer.company">
                    Company
                </h3>
                <ul class="space-y-2.5">
                    <li>
                        <a href="{{ route('chi-siamo') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.chi-siamo">
                            Chi Siamo
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog.index') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.blog">
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('partner') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.partner">
                            Partner
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('risorse') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.risorse">
                            Risorse
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('business-survey') }}"
                           class="text-white/70 text-sm hover:text-white transition">
                            Business Survey
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Column 4 — Legal & Contact --}}
            <div class="space-y-4">
                <h3 class="text-white text-sm font-semibold uppercase tracking-widest"
                    data-i18n="footer.legal">
                    Legal & Contact
                </h3>
                <ul class="space-y-2.5">
                    <li>
                        <button type="button"
                           onclick="window.dispatchEvent(new CustomEvent('cookie-banner:open'))"
                           class="text-white/70 text-sm hover:text-white transition text-left"
                           data-i18n="nav.cookie-preferences">
                            {{ __('cookie.banner.preferences_link') }}
                        </button>
                    </li>
                    <li>
                        <a href="{{ route('privacy') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.privacy">
                            Privacy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('termini') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.termini">
                            Termini
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cookie') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.cookie">
                            Cookie
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contatto') }}"
                           class="text-white/70 text-sm hover:text-white transition"
                           data-i18n="nav.contatto">
                            Contatto
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>

    {{-- Bottom Bar --}}
    <div class="border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col sm:flex-row items-center justify-between gap-3">
            <p class="text-white/40 text-xs" data-i18n="footer.copy">
                &copy; {{ date('Y') }} Corvalys LTD &mdash; All rights reserved.
            </p>
            <p class="text-white/40 text-xs">
                Made with AI in Europe &#127466;&#127482;
            </p>
        </div>
    </div>

</footer>
