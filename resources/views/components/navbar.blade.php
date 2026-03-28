<header class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/60" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('images/logo-corvalys.png') }}" alt="Corvalys — Strategy. Experience. Identity." class="h-[50px] w-[50px] object-contain" onerror="this.onerror=null;this.src='{{ asset('images/logo-corvalys.jpeg') }}'">
            </a>

            {{-- Desktop Nav --}}
            <nav class="hidden lg:flex items-center gap-8">
                {{-- Chi Siamo Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <div class="flex items-center">
                        <a href="{{ route('chi-siamo') }}" class="text-sm font-medium {{ request()->routeIs('chi-siamo') || request()->routeIs('chi-siamo.*') ? 'text-primary border-b-2 border-primary pb-0.5' : 'text-gray-600 hover:text-primary' }} transition"><span data-i18n="nav.chi-siamo">About Us</span></a>
                        <button @click="open = !open" @click.away="open = false" class="ml-1 p-1 text-gray-400 hover:text-primary">
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-2 min-w-48 bg-white shadow-lg rounded-lg border border-gray-200 py-1 z-50">
                        <a href="{{ route('chi-siamo') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.chi-siamo">About Us</span></a>
                        <a href="{{ route('chi-siamo.missione') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.missione">Our Mission</span></a>
                        <a href="{{ route('chi-siamo.valori') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.valori">Values</span></a>
                        <a href="{{ route('chi-siamo.cosa-facciamo') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.cosa-facciamo">What We Do</span></a>
                        <a href="{{ route('chi-siamo.team') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.team">Our Team</span></a>
                        <a href="{{ route('chi-siamo.partners') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.partners">Partners</span></a>
                    </div>
                </div>

                {{-- Prodotti Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <div class="flex items-center">
                        <a href="{{ route('prodotti') }}" class="text-sm font-medium {{ request()->routeIs('prodotti') || request()->routeIs('prodotti.*') ? 'text-primary border-b-2 border-primary pb-0.5' : 'text-gray-600 hover:text-primary' }} transition"><span data-i18n="nav.prodotti">Products</span></a>
                        <button @click="open = !open" @click.away="open = false" class="ml-1 p-1 text-gray-400 hover:text-primary">
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>
                    @inject('navProductsService', 'App\Models\Service')
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-2 min-w-48 bg-white shadow-lg rounded-lg border border-gray-200 py-1 z-50">
                        <a href="{{ route('prodotti') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.tutti-prodotti">All Products</span></a>
                        @foreach($navProductsService::prodotti()->active()->orderBy('sort_order')->get() as $navProduct)
                            <a href="{{ route('prodotti.show', $navProduct) }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition">{{ $navProduct->name }}</a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('prezzi') }}" class="text-sm font-medium {{ request()->routeIs('prezzi') ? 'text-primary border-b-2 border-primary pb-0.5' : 'text-gray-600 hover:text-primary' }} transition"><span data-i18n="nav.prezzi">Pricing</span></a>
                <a href="{{ route('consulenza') }}" class="text-sm font-medium {{ request()->routeIs('consulenza') ? 'text-primary border-b-2 border-primary pb-0.5' : 'text-gray-600 hover:text-primary' }} transition"><span data-i18n="nav.consulenza">Consulting</span></a>
                {{-- Blog Dropdown --}}
                <div class="relative" x-data="{ open: false }">
                    <div class="flex items-center">
                        <a href="{{ route('blog.index') }}" class="text-sm font-medium {{ request()->routeIs('blog.*') ? 'text-primary border-b-2 border-primary pb-0.5' : 'text-gray-600 hover:text-primary' }} transition"><span data-i18n="nav.blog">Blog</span></a>
                        <button @click="open = !open" @click.away="open = false" class="ml-1 p-1 text-gray-400 hover:text-primary">
                            <svg class="w-3.5 h-3.5 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                    </div>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute left-0 mt-2 min-w-48 bg-white shadow-lg rounded-lg border border-gray-200 py-1 z-50">
                        <a href="{{ route('blog.index') }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.blog.all">All Posts</span></a>
                        <a href="{{ route('blog.index', ['type' => 'article']) }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.blog.articles">Articles</span></a>
                        <a href="{{ route('blog.index', ['type' => 'case_study']) }}" class="block px-4 py-2 text-sm text-gray-600 hover:bg-primary-light hover:text-primary transition"><span data-i18n="nav.blog.case-studies">Case Studies</span></a>
                    </div>
                </div>
            </nav>

            {{-- Desktop CTA --}}
            <div class="hidden lg:flex items-center gap-3">
                <x-language-switcher />
                <a href="https://app.corvalys.eu/login" class="btn-outline text-sm !py-2 !px-4"><span data-i18n="nav.accedi">Log In</span></a>
                <a href="https://app.corvalys.eu/register" class="btn-primary text-sm !py-2 !px-4"><span data-i18n="nav.inizia">Start Free</span></a>
            </div>

            {{-- Mobile hamburger --}}
            <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition">
                <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
                <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div x-show="mobileOpen" x-cloak x-transition class="lg:hidden pb-4 border-t border-gray-100">
            <nav class="flex flex-col gap-1 pt-3 text-sm font-medium">
                {{-- Language switcher mobile --}}
                <div class="px-3 pb-3 mb-2 border-b border-gray-100">
                    <x-language-switcher />
                </div>

                {{-- Chi Siamo expandable --}}
                <div x-data="{ expanded: false }">
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg {{ request()->routeIs('chi-siamo') || request()->routeIs('chi-siamo.*') ? 'bg-primary-light text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
                        <a href="{{ route('chi-siamo') }}" class="flex-1"><span data-i18n="nav.chi-siamo">About Us</span></a>
                        <button @click="expanded = !expanded" class="p-1 text-gray-400 hover:text-primary">
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                    <div x-show="expanded" x-cloak x-transition class="flex flex-col gap-1 pl-6 mt-1">
                        <a href="{{ route('chi-siamo') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.chi-siamo">About Us</span></a>
                        <a href="{{ route('chi-siamo.missione') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.missione">Our Mission</span></a>
                        <a href="{{ route('chi-siamo.valori') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.valori">Values</span></a>
                        <a href="{{ route('chi-siamo.cosa-facciamo') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.cosa-facciamo">What We Do</span></a>
                        <a href="{{ route('chi-siamo.team') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.team">Our Team</span></a>
                        <a href="{{ route('chi-siamo.partners') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.partners">Partners</span></a>
                    </div>
                </div>

                {{-- Prodotti expandable --}}
                <div x-data="{ expanded: false }">
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg {{ request()->routeIs('prodotti') || request()->routeIs('prodotti.*') ? 'bg-primary-light text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
                        <a href="{{ route('prodotti') }}" class="flex-1"><span data-i18n="nav.prodotti">Products</span></a>
                        <button @click="expanded = !expanded" class="p-1 text-gray-400 hover:text-primary">
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                    <div x-show="expanded" x-cloak x-transition class="flex flex-col gap-1 pl-6 mt-1">
                        <a href="{{ route('prodotti') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.tutti-prodotti">All Products</span></a>
                        @foreach($navProductsService::prodotti()->active()->orderBy('sort_order')->get() as $navProduct)
                            <a href="{{ route('prodotti.show', $navProduct) }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50">{{ $navProduct->name }}</a>
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('prezzi') }}" class="px-3 py-2 rounded-lg {{ request()->routeIs('prezzi') ? 'bg-primary-light text-primary' : 'text-gray-600 hover:bg-gray-50' }}"><span data-i18n="nav.prezzi">Pricing</span></a>
                <a href="{{ route('consulenza') }}" class="px-3 py-2 rounded-lg {{ request()->routeIs('consulenza') ? 'bg-primary-light text-primary' : 'text-gray-600 hover:bg-gray-50' }}"><span data-i18n="nav.consulenza">Consulting</span></a>
                {{-- Blog expandable --}}
                <div x-data="{ expanded: false }">
                    <div class="flex items-center justify-between px-3 py-2 rounded-lg {{ request()->routeIs('blog.*') ? 'bg-primary-light text-primary' : 'text-gray-600 hover:bg-gray-50' }}">
                        <a href="{{ route('blog.index') }}" class="flex-1"><span data-i18n="nav.blog">Blog</span></a>
                        <button @click="expanded = !expanded" class="p-1 text-gray-400 hover:text-primary">
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': expanded }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                    </div>
                    <div x-show="expanded" x-cloak x-transition class="flex flex-col gap-1 pl-6 mt-1">
                        <a href="{{ route('blog.index') }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.blog.all">All Posts</span></a>
                        <a href="{{ route('blog.index', ['type' => 'article']) }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.blog.articles">Articles</span></a>
                        <a href="{{ route('blog.index', ['type' => 'case_study']) }}" class="px-3 py-2 rounded-lg text-gray-600 hover:bg-gray-50"><span data-i18n="nav.blog.case-studies">Case Studies</span></a>
                    </div>
                </div>
                <div class="flex flex-col gap-2 mt-3 px-3">
                    <a href="https://app.corvalys.eu/login" class="btn-outline text-center text-sm"><span data-i18n="nav.accedi">Log In</span></a>
                    <a href="https://app.corvalys.eu/register" class="btn-primary text-center text-sm"><span data-i18n="nav.inizia">Start Free</span></a>
                </div>
            </nav>
        </div>
    </div>
</header>
