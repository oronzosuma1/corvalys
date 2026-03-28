<?php $__env->startSection('title', 'Corvalys — Your first AI employee for European SMEs'); ?>

<?php $__env->startSection('content'); ?>


<section class="bg-gradient-to-br from-navy to-primary py-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">

            
            <div>
                <span class="inline-block bg-amber-light text-amber-800 text-xs font-semibold px-3 py-1 rounded-full mb-6" data-i18n-html="home.badge">
                    AI Act &mdash; <?php echo e($stats['giorni']); ?> days
                </span>
                <h1 class="font-heading text-5xl font-bold text-white leading-tight">
                    <span data-i18n="home.title">Your first</span> <span class="text-primary-light" data-i18n="home.title.highlight">AI employee</span>
                </h1>
                <p class="mt-6 text-xl text-gray-300 max-w-lg" data-i18n="home.subtitle">
                    Manages your invoices, approves documents, prepares you for the AI Act. Zero technical setup.
                </p>
                <div class="mt-8 flex flex-wrap gap-4">
                    <a href="https://app.corvalys.eu/register" class="btn-primary" data-i18n-html="home.cta1">
                        Start free &mdash; 3 months
                    </a>
                    <a href="/consulenza" class="btn-outline border-white text-white hover:bg-white/10" data-i18n="home.cta2">
                        Discover consulting
                    </a>
                </div>
            </div>

            
            <div class="flex justify-center lg:justify-end"
                 x-data="{ active: 0 }"
                 x-init="setInterval(() => active = (active + 1) % 3, 2500)">
                <div class="bg-white rounded-2xl shadow-2xl p-6 text-gray-900 w-full max-w-md">
                    
                    <div class="flex items-center justify-between mb-5">
                        <span class="inline-flex items-center gap-2 text-sm font-semibold text-gray-900">
                            <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            Morning brief
                        </span>
                        <span class="text-xs text-gray-400">Generated at 07:00</span>
                    </div>

                    
                    <div class="space-y-3 min-h-[72px]">
                        
                        <div x-show="active === 0"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Invoice #2847 &mdash; Rossi Constructions</p>
                                <p class="text-xs text-gray-500">&euro;4,200 &mdash; Due tomorrow</p>
                            </div>
                            <span class="shrink-0 ml-3 inline-block bg-red-100 text-red-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Urgent</span>
                        </div>

                        
                        <div x-show="active === 1"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Invoice #2843 &mdash; Studio Bianchi</p>
                                <p class="text-xs text-gray-500">&euro;1,850 &mdash; Reminder sent</p>
                            </div>
                            <span class="shrink-0 ml-3 inline-block bg-amber-100 text-amber-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Pending</span>
                        </div>

                        
                        <div x-show="active === 2"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="flex items-center justify-between bg-gray-50 rounded-lg px-4 py-3">
                            <div>
                                <p class="text-sm font-medium text-gray-900">Invoice #2839 &mdash; Tech Solutions</p>
                                <p class="text-xs text-gray-500">&euro;7,500 &mdash; Paid</p>
                            </div>
                            <span class="shrink-0 ml-3 inline-block bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Completed</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-8 text-center">
            <div>
                <p class="text-primary font-heading text-3xl font-bold"><?php echo e($stats['sme']); ?></p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.sme">SMEs in Europe</p>
            </div>
            <div>
                <p class="text-primary font-heading text-3xl font-bold"><?php echo e($stats['ore']); ?></p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.ore">hrs/week on payments</p>
            </div>
            <div>
                <p class="text-primary font-heading text-3xl font-bold"><?php echo e($stats['pct']); ?></p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.pct">SMEs with delays</p>
            </div>
            <div>
                <p class="text-primary font-heading text-3xl font-bold">&euro;<?php echo e($stats['miliardi']); ?></p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.cash">cash blocked</p>
            </div>
            <div class="col-span-2 sm:col-span-1">
                <p class="text-primary font-heading text-3xl font-bold"><?php echo e($stats['giorni']); ?></p>
                <p class="text-gray-500 text-sm mt-1" data-i18n="stats.giorni">days to Aug 2, 2026</p>
            </div>
        </div>
    </div>
</section>


<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-14">
            <h2 class="section-title" data-i18n="problem.title">Every week SMEs lose time and money</h2>
            <p class="section-sub mt-4" data-i18n="problem.subtitle">Forgotten invoices, chaotic approvals, and an AI regulation looming. Sound familiar?</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            
            <div class="card hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <text x="12" y="16" text-anchor="middle" fill="currentColor" font-size="12" font-weight="bold" stroke="none">&euro;</text>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy" data-i18n="problem.card1.title">Cash blocked</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed" data-i18n="problem.card1.desc">
                    9.85 hours per week chasing late payments. Almost 2 working days lost.
                </p>
            </div>

            
            <div class="card hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy" data-i18n="problem.card2.title">Approvals in chaos</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed" data-i18n="problem.card2.desc">
                    Contracts approved via WhatsApp, without trace. Who gave the OK? When?
                </p>
            </div>

            
            <div class="card hover:shadow-lg transition">
                <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center mb-5">
                    <svg class="w-7 h-7 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-navy" data-i18n="problem.card3.title">AI Act imminent</h3>
                <p class="mt-2 text-gray-600 text-sm leading-relaxed" data-i18n="problem.card3.desc">
                    <?php echo e($stats['giorni']); ?> days to August 2, 2026. You are already an AI deployer even if you don't know it.
                </p>
            </div>
        </div>
    </div>
</section>


<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
<section class="<?php echo e($index % 2 === 0 ? 'bg-white' : 'bg-gray-50'); ?> py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index % 2 === 1): ?>
                
                <div class="hidden lg:flex items-center justify-center order-2 lg:order-1">
                    <div class="w-full max-w-sm bg-gray-200 rounded-2xl h-72 flex items-center justify-center text-gray-400 text-sm">
                        Screenshot <?php echo e($product->name); ?>

                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="<?php echo e($index % 2 === 1 ? 'order-1 lg:order-2' : ''); ?>">
                <span class="inline-block bg-primary text-white text-xs font-semibold px-3 py-1 rounded-full mb-4">Tool <?php echo e(chr(65 + $index)); ?></span>
                <h2 class="section-title"><?php echo e($product->name); ?></h2>
                <p class="mt-4 text-gray-600 leading-relaxed">
                    <?php echo e($product->short_description); ?>

                </p>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($product->price_from): ?>
                    <p class="mt-6 text-primary font-semibold">
                        From &euro;<?php echo e(number_format($product->price_from, 0)); ?><?php echo e($product->price_unit ? '/' . $product->price_unit : ''); ?>

                    </p>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <a href="<?php echo e(route('prodotti.show', $product)); ?>" class="inline-block mt-4 text-primary font-semibold hover:underline">Learn more &rarr;</a>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index % 2 === 0): ?>
                
                <div class="hidden lg:flex items-center justify-center">
                    <div class="w-full max-w-sm bg-gray-100 rounded-2xl h-72 flex items-center justify-center text-gray-400 text-sm">
                        Screenshot <?php echo e($product->name); ?>

                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </div>
</section>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>


<section class="bg-primary-dark py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-3xl font-bold text-white" data-i18n="consult.title">
            Need something more custom?
        </h2>
        <p class="mt-4 text-lg text-white/80 max-w-2xl mx-auto" data-i18n="consult.desc">
            We design and build custom AI systems for your business.
        </p>
        <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
            <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm" data-i18n="consult.pill1">Agentic AI Systems</span>
            <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm" data-i18n="consult.pill2">Supply Chain</span>
            <span class="bg-white/10 text-white px-4 py-2 rounded-full text-sm" data-i18n="consult.pill3">AI Act Compliance</span>
        </div>
        <div class="mt-8">
            <a href="/consulenza" class="btn-outline border-white text-white hover:bg-white/10" data-i18n-html="consult.cta">
                Discover consulting &rarr;
            </a>
        </div>
    </div>
</section>


<section class="bg-navy py-20">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-3xl font-bold text-white" data-i18n="footer-cta.title">
            Join the SMEs already using their first AI employee
        </h2>

        <div class="max-w-md mx-auto mt-8">
            <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('newsletter-form');

$__keyOuter = $__key ?? null;

$__key = null;
$__componentSlots = [];

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-265582293-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key, $__componentSlots);

echo $__html;

unset($__html);
unset($__key);
$__key = $__keyOuter;
unset($__keyOuter);
unset($__name);
unset($__params);
unset($__componentSlots);
unset($__split);
?>
        </div>

        <div class="mt-8 flex flex-wrap items-center justify-center gap-6 text-sm text-white/70">
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span data-i18n="footer-cta.badge1">No credit card</span>
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span data-i18n="footer-cta.badge2">3 months free</span>
            </span>
            <span class="flex items-center gap-2">
                <svg class="w-4 h-4 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span data-i18n="footer-cta.badge3">AI Act compliant</span>
            </span>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/pages/home.blade.php ENDPATH**/ ?>