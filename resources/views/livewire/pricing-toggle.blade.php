<div>
    {{-- Toggle Switch --}}
    <div class="flex items-center justify-center gap-4 mb-12">
        <span class="{{ $period === 'monthly' ? 'text-navy font-semibold' : 'text-gray-400' }}">Mensile</span>
        <button wire:click="toggle"
            class="relative w-14 h-7 rounded-full transition-colors duration-200 {{ $period === 'annual' ? 'bg-primary' : 'bg-gray-300' }}"
            role="switch" aria-checked="{{ $period === 'annual' ? 'true' : 'false' }}">
            <span class="absolute top-0.5 left-0.5 w-6 h-6 bg-white rounded-full shadow transition-transform duration-200 {{ $period === 'annual' ? 'translate-x-7' : '' }}"></span>
        </button>
        <span class="{{ $period === 'annual' ? 'text-navy font-semibold' : 'text-gray-400' }}">
            Annuale <span class="text-primary text-xs font-semibold ml-1">-20%</span>
        </span>
    </div>

    {{-- Pricing Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto">
        {{-- Starter --}}
        <div class="card relative">
            <h3 class="font-heading text-xl font-bold text-navy">Starter</h3>
            <p class="text-gray-500 text-sm mt-1">Per esplorare senza impegno</p>
            <div class="mt-6">
                <span class="text-4xl font-bold text-navy">Gratis</span>
                <span class="text-gray-500 text-sm block mt-1">per 3 mesi</span>
            </div>
            <ul class="mt-6 space-y-3 text-sm text-gray-600">
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Tool A — Cash Controller (base)</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> 50 fatture/mese</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Brief mattutino email</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Supporto community</li>
            </ul>
            <a href="https://app.corvalys.eu/register" class="btn-outline w-full text-center mt-8 block">Inizia gratis</a>
        </div>

        {{-- Core --}}
        <div class="card relative border-primary border-2">
            <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full">Consigliato</span>
            <h3 class="font-heading text-xl font-bold text-navy">Core</h3>
            <p class="text-gray-500 text-sm mt-1">Per PMI che vogliono risultati</p>
            <div class="mt-6">
                <span class="text-4xl font-bold text-navy">&euro;{{ $period === 'monthly' ? '49' : '39' }}</span>
                <span class="text-gray-500 text-sm">/mese</span>
                @if($period === 'annual')
                    <span class="text-gray-400 text-xs block mt-1">Fatturato annualmente: &euro;470</span>
                @endif
            </div>
            <ul class="mt-6 space-y-3 text-sm text-gray-600">
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Tool A + Tool B</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> 500 fatture/mese</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Dashboard scadenze live</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Solleciti automatici</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Supporto email prioritario</li>
            </ul>
            <a href="https://app.corvalys.eu/register?plan=core" class="btn-primary w-full text-center mt-8 block">Scegli Core</a>
        </div>

        {{-- Pro --}}
        <div class="card relative">
            <h3 class="font-heading text-xl font-bold text-navy">Pro</h3>
            <p class="text-gray-500 text-sm mt-1">Compliance e controllo totale</p>
            <div class="mt-6">
                <span class="text-4xl font-bold text-navy">&euro;{{ $period === 'monthly' ? '89' : '71' }}</span>
                <span class="text-gray-500 text-sm">/mese</span>
                @if($period === 'annual')
                    <span class="text-gray-400 text-xs block mt-1">Fatturato annualmente: &euro;855</span>
                @endif
            </div>
            <ul class="mt-6 space-y-3 text-sm text-gray-600">
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Tool A + B + C</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Fatture illimitate</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> AI Act compliance report</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Inventario AI automatico</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Supporto call 1:1</li>
            </ul>
            <a href="https://app.corvalys.eu/register?plan=pro" class="btn-primary w-full text-center mt-8 block">Scegli Pro</a>
        </div>

        {{-- Business --}}
        <div class="card relative bg-navy text-white">
            <h3 class="font-heading text-xl font-bold text-white">Business</h3>
            <p class="text-gray-300 text-sm mt-1">Soluzioni su misura</p>
            <div class="mt-6">
                <span class="text-4xl font-bold text-white">&euro;179</span>
                <span class="text-gray-300 text-sm">/mese</span>
                <span class="text-gray-400 text-xs block mt-1">Prezzo indicativo, su preventivo</span>
            </div>
            <ul class="mt-6 space-y-3 text-sm text-gray-300">
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-amber flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Tutto in Pro</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-amber flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Integrazioni custom</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-amber flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Agenti AI dedicati</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-amber flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> SLA garantito</li>
                <li class="flex items-start gap-2"><svg class="w-5 h-5 text-amber flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> Account manager dedicato</li>
            </ul>
            <a href="/contatto" class="bg-amber text-white px-6 py-3 rounded-lg font-semibold hover:bg-amber-600 transition-colors w-full text-center mt-8 block">Contattaci</a>
        </div>
    </div>
</div>
