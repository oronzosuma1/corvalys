<footer class="bg-gray-900 text-gray-300 mt-0">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        {{-- Columns --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12">
            <div>
                <h4 class="text-white font-heading font-semibold mb-4" data-i18n="footer.prodotti">Products</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('prodotti') }}" class="hover:text-primary transition">AI Cash Controller</a></li>
                    <li><a href="{{ route('prodotti') }}" class="hover:text-primary transition">AI Approval Coordinator</a></li>
                    <li><a href="{{ route('prodotti') }}" class="hover:text-primary transition">AI Compliance Officer</a></li>
                    <li><a href="{{ route('prezzi') }}" class="hover:text-primary transition"><span data-i18n="footer.prezzi">Pricing</span></a></li>
                    <li><a href="https://app.corvalys.eu/register" class="hover:text-primary transition"><span data-i18n="footer.trial">Free trial</span></a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-heading font-semibold mb-4" data-i18n="footer.consulenza">Consulting</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('consulenza') }}" class="hover:text-primary transition"><span data-i18n="footer.servizi">Services</span></a></li>
                    <li><a href="{{ route('chi-siamo') }}" class="hover:text-primary transition"><span data-i18n="footer.chi-siamo">About Us</span></a></li>
                    <li><a href="{{ route('contatto') }}" class="hover:text-primary transition"><span data-i18n="footer.contatto">Contact</span></a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-heading font-semibold mb-4" data-i18n="footer.azienda">Company</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('blog.index') }}" class="hover:text-primary transition"><span data-i18n="footer.blog">Blog</span></a></li>
                    <li><a href="{{ route('partner') }}" class="hover:text-primary transition"><span data-i18n="footer.partner">Partner</span></a></li>
                    <li><a href="{{ route('risorse') }}" class="hover:text-primary transition"><span data-i18n="footer.risorse">Resources</span></a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-heading font-semibold mb-4" data-i18n="footer.legale">Legal</h4>
                <ul class="space-y-2.5 text-sm">
                    <li><a href="{{ route('privacy') }}" class="hover:text-primary transition"><span data-i18n="footer.privacy">Privacy Policy</span></a></li>
                    <li><a href="{{ route('termini') }}" class="hover:text-primary transition"><span data-i18n="footer.termini">Terms of Service</span></a></li>
                    <li><a href="{{ route('cookie') }}" class="hover:text-primary transition"><span data-i18n="footer.cookie">Cookie Policy</span></a></li>
                </ul>
            </div>
        </div>

        {{-- Newsletter --}}
        <div class="border-t border-gray-800 pt-8 mb-8">
            <div class="max-w-md">
                <h4 class="text-white font-heading font-semibold mb-2" data-i18n="footer.newsletter.title">Stay updated</h4>
                <p class="text-sm text-gray-400 mb-4" data-i18n="footer.newsletter.desc">Receive insights on AI, SMEs, and automation. No spam.</p>
                @livewire('newsletter-form')
            </div>
        </div>

        {{-- Bottom bar --}}
        <div class="border-t border-gray-800 pt-6 flex flex-col md:flex-row items-center justify-between gap-4">
            <p class="text-xs text-gray-500" data-i18n="footer.copyright" data-i18n-params='{"year":"{{ date('Y') }}"}'>&copy; {{ date('Y') }} Corvalys. All rights reserved.</p>
            <div class="flex items-center gap-4">
                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-amber bg-amber-light/10 px-3 py-1 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    AI Act Ready 2026
                </span>
                <span class="inline-flex items-center gap-1.5 text-xs font-medium text-primary bg-primary-light/20 px-3 py-1 rounded-full">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                    GDPR Compliant
                </span>
                {{-- LinkedIn --}}
                <a href="https://linkedin.com/company/corvalys" target="_blank" class="text-gray-500 hover:text-white transition">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>
