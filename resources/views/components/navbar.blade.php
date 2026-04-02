@inject('navServices', 'App\Models\Service')

<nav
    x-data="{
        mobileOpen: false,
        productsOpen: false,
        aboutOpen: false,
        blogOpen: false,
        scrolled: false,
        init() {
            window.addEventListener('scroll', () => {
                this.scrolled = window.scrollY > 10;
            });
        },
        closeAll() {
            this.productsOpen = false;
            this.aboutOpen   = false;
            this.blogOpen    = false;
        }
    }"
    @keydown.escape.window="closeAll(); mobileOpen = false"
    :class="scrolled ? 'shadow-md backdrop-blur-md bg-white/95' : 'bg-white'"
    class="fixed top-0 inset-x-0 z-50 border-b border-gray-100 transition-all duration-300"
>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">

            {{-- ── Logo ── --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2.5 flex-shrink-0">
                <img
                    src="{{ asset('images/logo-corvalys.png') }}"
                    alt="Corvalys logo"
                    width="50"
                    height="50"
                    class="w-[50px] h-[50px] object-contain"
                >
                <span class="text-xl font-bold tracking-tight text-gray-900 select-none">
                    Corvalys
                </span>
            </a>

            {{-- ── Desktop Navigation ── --}}
            <div class="hidden lg:flex items-center gap-1">

                    {{-- Chi Siamo dropdown (first item) --}}
                <div class="relative" x-data>
                    <button
                        @click="aboutOpen = !aboutOpen; productsOpen = false; blogOpen = false"
                        @click.outside="aboutOpen = false"
                        :class="aboutOpen || {{ request()->routeIs('chi-siamo*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-700'"
                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-lg hover:text-primary hover:bg-gray-50 transition-colors duration-150"
                        aria-haspopup="true"
                        :aria-expanded="aboutOpen"
                    >
                        <span data-i18n="nav.about">Chi Siamo</span>
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="aboutOpen ? 'rotate-180' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        x-show="aboutOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                        class="absolute left-0 mt-2 w-56 rounded-xl shadow-xl border border-gray-100 bg-white py-2 origin-top-left"
                        style="display:none"
                    >
                        @php
                            $aboutLinks = [
                                ['route' => 'chi-siamo',              'i18n' => 'nav.about',              'label' => 'Chi Siamo'],
                                ['route' => 'chi-siamo.missione',     'i18n' => 'nav.about.mission',      'label' => 'Missione'],
                                ['route' => 'chi-siamo.cosa-facciamo','i18n' => 'nav.about.whatwedo',     'label' => 'Cosa Facciamo'],
                                ['route' => 'chi-siamo.valori',       'i18n' => 'nav.about.values',       'label' => 'Valori'],
                                ['route' => 'chi-siamo.team',         'i18n' => 'nav.about.team',         'label' => 'Team'],
                                ['route' => 'chi-siamo.partners',     'i18n' => 'nav.about.partners',     'label' => 'Partners'],
                            ];
                        @endphp

                        @foreach($aboutLinks as $link)
                            <a
                                href="{{ route($link['route']) }}"
                                class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs($link['route']) ? 'text-primary bg-primary/5 font-medium' : '' }}"
                                data-i18n="{{ $link['i18n'] }}"
                            >
                                <span class="w-1.5 h-1.5 rounded-full bg-primary/40 flex-shrink-0"></span>
                                {{ $link['label'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Prodotti dropdown --}}
                <div class="relative" x-data>
                    <button
                        @click="productsOpen = !productsOpen; aboutOpen = false; blogOpen = false"
                        @click.outside="productsOpen = false"
                        :class="productsOpen || {{ request()->routeIs('prodotti*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-700'"
                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-lg hover:text-primary hover:bg-gray-50 transition-colors duration-150"
                        aria-haspopup="true"
                        :aria-expanded="productsOpen"
                    >
                        <span data-i18n="nav.products">Prodotti</span>
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="productsOpen ? 'rotate-180' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        x-show="productsOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                        class="absolute left-0 mt-2 w-60 rounded-xl shadow-xl border border-gray-100 bg-white py-2 origin-top-left"
                        style="display:none"
                    >
                        <a
                            href="{{ route('prodotti') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-sm font-semibold text-gray-800 hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('prodotti') && !request()->route()->hasParameter('service') ? 'text-primary bg-primary/5' : '' }}"
                        >
                            <svg class="w-4 h-4 text-primary/70 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7"/>
                            </svg>
                            <span data-i18n="nav.products">Tutti i Prodotti</span>
                        </a>

                        @php
                            $dynamicProducts = $navServices::prodotti()->active()->orderBy('sort_order')->get();
                        @endphp

                        @if($dynamicProducts->isNotEmpty())
                            <div class="my-1 border-t border-gray-100"></div>
                            @foreach($dynamicProducts as $s)
                                <a
                                    href="{{ route('prodotti.show', $s) }}"
                                    class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('prodotti.show') && request()->route('service') == $s->slug ? 'text-primary bg-primary/5' : '' }}"
                                >
                                    <span class="w-1.5 h-1.5 rounded-full bg-primary/40 flex-shrink-0"></span>
                                    {{ $s->name }}
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>

                {{-- Consulenza --}}
                <a
                    href="{{ route('consulenza') }}"
                    class="px-3 py-2 text-sm font-medium rounded-lg hover:text-primary hover:bg-gray-50 transition-colors duration-150 {{ request()->routeIs('consulenza') ? 'text-primary' : 'text-gray-700' }}"
                    data-i18n="nav.consulting"
                >Consulenza</a>

                {{-- Blog dropdown --}}
                <div class="relative" x-data>
                    <button
                        @click="blogOpen = !blogOpen; productsOpen = false; aboutOpen = false"
                        @click.outside="blogOpen = false"
                        :class="blogOpen || {{ request()->routeIs('blog*') ? 'true' : 'false' }} ? 'text-primary' : 'text-gray-700'"
                        class="flex items-center gap-1 px-3 py-2 text-sm font-medium rounded-lg hover:text-primary hover:bg-gray-50 transition-colors duration-150"
                        aria-haspopup="true"
                        :aria-expanded="blogOpen"
                    >
                        <span data-i18n="nav.blog">Blog</span>
                        <svg
                            class="w-4 h-4 transition-transform duration-200"
                            :class="blogOpen ? 'rotate-180' : ''"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                        >
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>

                    <div
                        x-show="blogOpen"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                        class="absolute left-0 mt-2 w-52 rounded-xl shadow-xl border border-gray-100 bg-white py-2 origin-top-left"
                        style="display:none"
                    >
                        <a
                            href="{{ route('blog.index') }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('blog.index') && !request()->query('type') ? 'text-primary bg-primary/5 font-medium' : '' }}"
                            data-i18n="nav.blog.all"
                        >
                            <span class="w-1.5 h-1.5 rounded-full bg-primary/40 flex-shrink-0"></span>
                            Tutti gli articoli
                        </a>
                        <a
                            href="{{ route('blog.index', ['type' => 'article']) }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('blog.index') && request()->query('type') === 'article' ? 'text-primary bg-primary/5 font-medium' : '' }}"
                            data-i18n="nav.blog.articles"
                        >
                            <span class="w-1.5 h-1.5 rounded-full bg-primary/40 flex-shrink-0"></span>
                            Articoli
                        </a>
                        <a
                            href="{{ route('blog.index', ['type' => 'case_study']) }}"
                            class="flex items-center gap-2 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('blog.index') && request()->query('type') === 'case_study' ? 'text-primary bg-primary/5 font-medium' : '' }}"
                            data-i18n="nav.blog.cases"
                        >
                            <span class="w-1.5 h-1.5 rounded-full bg-primary/40 flex-shrink-0"></span>
                            Case Studies
                        </a>
                    </div>
                </div>

                {{-- Risorse --}}
                <a
                    href="{{ route('risorse') }}"
                    class="px-3 py-2 text-sm font-medium rounded-lg hover:text-primary hover:bg-gray-50 transition-colors duration-150 {{ request()->routeIs('risorse*') ? 'text-primary' : 'text-gray-700' }}"
                    data-i18n="nav.resources"
                >Risorse</a>

                {{-- Business Survey --}}
                <a
                    href="{{ route('business-survey') }}"
                    class="px-3 py-2 text-sm font-semibold rounded-lg transition-colors duration-150 {{ request()->routeIs('business-survey*') ? 'text-primary' : 'text-amber-600 hover:text-amber-700 hover:bg-amber-50' }}"
                >
                    <span class="flex items-center gap-1.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                        Survey
                    </span>
                </a>

            </div>

            {{-- ── Right Side: Language Switcher + CTA ── --}}
            <div class="hidden lg:flex items-center gap-3">
                <x-language-switcher />

                <a
                    href="{{ route('contatto') }}"
                    class="btn-primary inline-flex items-center gap-1.5 px-5 py-2 rounded-lg text-sm font-semibold transition-all duration-150 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary/50"
                    data-i18n="nav.cta"
                >
                    Contattaci
                </a>
            </div>

            {{-- ── Mobile Hamburger ── --}}
            <button
                @click="mobileOpen = !mobileOpen"
                class="lg:hidden inline-flex items-center justify-center p-2 rounded-lg text-gray-600 hover:text-primary hover:bg-gray-50 transition-colors focus:outline-none focus:ring-2 focus:ring-primary/30"
                :aria-expanded="mobileOpen"
                aria-label="Toggle navigation"
            >
                <svg
                    x-show="!mobileOpen"
                    class="w-6 h-6"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                    style="display:block"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg
                    x-show="mobileOpen"
                    class="w-6 h-6"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                    style="display:none"
                >
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

        </div>
    </div>

    {{-- ── Mobile Menu ── --}}
    <div
        x-show="mobileOpen"
        x-transition:enter="transition ease-out duration-250"
        x-transition:enter-start="opacity-0 -translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 -translate-y-2"
        class="lg:hidden border-t border-gray-100 bg-white"
        style="display:none"
        x-data="{
            mProdOpen: false,
            mAboutOpen: false,
            mBlogOpen: false
        }"
    >
        <div class="max-w-7xl mx-auto px-4 py-3 space-y-1">

            {{-- Mobile: Chi Siamo --}}
            <div>
                <button
                    @click="mAboutOpen = !mAboutOpen"
                    class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors"
                >
                    <span data-i18n="nav.about">Chi Siamo</span>
                    <svg
                        class="w-4 h-4 transition-transform duration-200"
                        :class="mAboutOpen ? 'rotate-180' : ''"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div
                    x-show="mAboutOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-1 ml-3 pl-3 border-l-2 border-primary/20 space-y-0.5"
                    style="display:none"
                >
                    @foreach($aboutLinks as $link)
                        <a
                            href="{{ route($link['route']) }}"
                            class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs($link['route']) ? 'text-primary font-medium' : '' }}"
                            data-i18n="{{ $link['i18n'] }}"
                            @click="mobileOpen = false"
                        >{{ $link['label'] }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Mobile: Prodotti --}}
            <div>
                <button
                    @click="mProdOpen = !mProdOpen"
                    class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors"
                >
                    <span data-i18n="nav.products">Prodotti</span>
                    <svg
                        class="w-4 h-4 transition-transform duration-200"
                        :class="mProdOpen ? 'rotate-180' : ''"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div
                    x-show="mProdOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-1 ml-3 pl-3 border-l-2 border-primary/20 space-y-0.5"
                    style="display:none"
                >
                    <a
                        href="{{ route('prodotti') }}"
                        class="block px-3 py-2 text-sm text-gray-700 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('prodotti') && !request()->route()->hasParameter('service') ? 'text-primary font-medium' : '' }}"
                        data-i18n="nav.products"
                        @click="mobileOpen = false"
                    >Tutti i Prodotti</a>

                    @foreach($dynamicProducts as $s)
                        <a
                            href="{{ route('prodotti.show', $s) }}"
                            class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('prodotti.show') && request()->route('service') == $s->slug ? 'text-primary font-medium' : '' }}"
                            @click="mobileOpen = false"
                        >{{ $s->name }}</a>
                    @endforeach
                </div>
            </div>

            {{-- Mobile: Consulenza --}}
            <a
                href="{{ route('consulenza') }}"
                class="block px-3 py-2.5 text-sm font-medium rounded-lg hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('consulenza') ? 'text-primary' : 'text-gray-700' }}"
                data-i18n="nav.consulting"
                @click="mobileOpen = false"
            >Consulenza</a>

            {{-- Mobile: Blog --}}
            <div>
                <button
                    @click="mBlogOpen = !mBlogOpen"
                    class="w-full flex items-center justify-between px-3 py-2.5 text-sm font-medium text-gray-700 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors"
                >
                    <span data-i18n="nav.blog">Blog</span>
                    <svg
                        class="w-4 h-4 transition-transform duration-200"
                        :class="mBlogOpen ? 'rotate-180' : ''"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"
                    >
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>

                <div
                    x-show="mBlogOpen"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 -translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    class="mt-1 ml-3 pl-3 border-l-2 border-primary/20 space-y-0.5"
                    style="display:none"
                >
                    <a
                        href="{{ route('blog.index') }}"
                        class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('blog.index') && !request()->query('type') ? 'text-primary font-medium' : '' }}"
                        data-i18n="nav.blog.all"
                        @click="mobileOpen = false"
                    >Tutti gli articoli</a>
                    <a
                        href="{{ route('blog.index', ['type' => 'article']) }}"
                        class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('blog.index') && request()->query('type') === 'article' ? 'text-primary font-medium' : '' }}"
                        data-i18n="nav.blog.articles"
                        @click="mobileOpen = false"
                    >Articoli</a>
                    <a
                        href="{{ route('blog.index', ['type' => 'case_study']) }}"
                        class="block px-3 py-2 text-sm text-gray-600 rounded-lg hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('blog.index') && request()->query('type') === 'case_study' ? 'text-primary font-medium' : '' }}"
                        data-i18n="nav.blog.cases"
                        @click="mobileOpen = false"
                    >Case Studies</a>
                </div>
            </div>

            {{-- Mobile: Risorse --}}
            <a
                href="{{ route('risorse') }}"
                class="block px-3 py-2.5 text-sm font-medium rounded-lg hover:bg-gray-50 hover:text-primary transition-colors {{ request()->routeIs('risorse*') ? 'text-primary' : 'text-gray-700' }}"
                data-i18n="nav.resources"
                @click="mobileOpen = false"
            >Risorse</a>

            {{-- Mobile: Survey --}}
            <a
                href="{{ route('business-survey') }}"
                class="flex items-center gap-2 px-3 py-2.5 text-sm font-semibold rounded-lg transition-colors {{ request()->routeIs('business-survey*') ? 'text-primary bg-primary/5' : 'text-amber-600 hover:bg-amber-50 hover:text-amber-700' }}"
                @click="mobileOpen = false"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25z"/></svg>
                Survey
            </a>

            {{-- Mobile: Language Switcher + CTA --}}
            <div class="pt-3 pb-2 border-t border-gray-100 flex flex-col gap-3">
                <x-language-switcher />

                <a
                    href="{{ route('contatto') }}"
                    class="btn-primary inline-flex items-center justify-center gap-1.5 w-full px-5 py-2.5 rounded-lg text-sm font-semibold text-center transition-all duration-150 hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-primary/50"
                    data-i18n="nav.cta"
                    @click="mobileOpen = false"
                >
                    Contattaci
                </a>
            </div>

        </div>
    </div>
</nav>
