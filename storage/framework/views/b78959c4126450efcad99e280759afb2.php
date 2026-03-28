<?php $__env->startSection('title', 'Custom AI Consulting – Corvalys'); ?>

<?php $__env->startSection('content'); ?>


<section class="bg-gradient-to-br from-navy to-primary py-20 lg:py-28">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="font-heading text-4xl sm:text-5xl lg:text-6xl font-bold text-white leading-tight" data-i18n="consulenza.title">
            Custom AI consulting for your business
        </h1>
        <p class="mt-6 text-lg sm:text-xl text-gray-300 max-w-3xl mx-auto" data-i18n="consulenza.subtitle">
            We analyze your processes, identify AI opportunities, and build solutions that work. From day one.
        </p>
        <div class="mt-10">
            <a href="/contatto" class="btn-primary" data-i18n="consulenza.hero.cta">Request information</a>
        </div>
    </div>
</section>


<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title text-center" data-i18n="consulenza.why.title">Why Choose Corvalys</h2>
        <p class="section-sub text-center max-w-2xl mx-auto"></p>

        <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="card text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="consulenza.why.vertical.title">Vertical</h3>
                <p class="mt-2 text-gray-600 text-sm" data-i18n="consulenza.why.vertical.desc">We are not generalists. We work with European SMEs on concrete problems: payments, approvals, compliance.</p>
            </div>

            
            <div class="card text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="consulenza.why.operational.title">Operational</h3>
                <p class="mt-2 text-gray-600 text-sm" data-i18n="consulenza.why.operational.desc">We don't leave slide decks. We build systems that work and teach you how to use them.</p>
            </div>

            
            <div class="card text-center">
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-full bg-primary/10 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="font-heading text-lg font-bold text-gray-900" data-i18n="consulenza.why.compliant.title">Compliant</h3>
                <p class="mt-2 text-gray-600 text-sm" data-i18n="consulenza.why.compliant.desc">Every solution respects GDPR and AI Act. Compliance is not an extra, it's the starting point.</p>
            </div>
        </div>
    </div>
</section>


<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title text-center" data-i18n="consulenza.services.title">Our Services</h2>

        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($services->isNotEmpty()): ?>
            <div class="mt-12 grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <div class="card flex flex-col">
                        <h3 class="font-heading text-lg font-bold text-gray-900"><?php echo e($service->name); ?></h3>
                        <p class="mt-2 text-gray-600 text-sm flex-1"><?php echo e($service->short_description); ?></p>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($service->price_from): ?>
                            <p class="mt-3 text-primary font-semibold text-sm">
                                From &euro;<?php echo e(number_format($service->price_from, 0)); ?><?php echo e($service->price_unit ? '/' . $service->price_unit : ''); ?>

                            </p>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>
        <?php else: ?>
            <p class="mt-12 text-center text-gray-500 text-lg">No consulting services available at the moment.</p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section>


<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title text-center" data-i18n="consulenza.process.title">How We Work</h2>

        <div class="mt-16 grid sm:grid-cols-2 lg:grid-cols-4 gap-8 relative">
            
            <div class="hidden lg:block absolute top-7 left-[12.5%] right-[12.5%] h-0.5 bg-primary/20"></div>

            
            <div class="text-center relative">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary text-white text-xl font-bold relative z-10">1</div>
                <h3 class="mt-4 font-heading text-lg font-bold text-gray-900" data-i18n="consulenza.process.step1.title">Contact</h3>
                <p class="mt-2 text-gray-600 text-sm" data-i18n="consulenza.process.step1.desc">Fill out the form or book a call. We respond within 24 hours.</p>
            </div>

            
            <div class="text-center relative">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary text-white text-xl font-bold relative z-10">2</div>
                <h3 class="mt-4 font-heading text-lg font-bold text-gray-900" data-i18n="consulenza.process.step2.title">30-min Call</h3>
                <p class="mt-2 text-gray-600 text-sm" data-i18n="consulenza.process.step2.desc">We understand your problem, context, and priorities.</p>
            </div>

            
            <div class="text-center relative">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary text-white text-xl font-bold relative z-10">3</div>
                <h3 class="mt-4 font-heading text-lg font-bold text-gray-900" data-i18n="consulenza.process.step3.title">Proposal</h3>
                <p class="mt-2 text-gray-600 text-sm" data-i18n="consulenza.process.step3.desc">You receive a detailed proposal with scope, timeline, and costs.</p>
            </div>

            
            <div class="text-center relative">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-primary text-white text-xl font-bold relative z-10">4</div>
                <h3 class="mt-4 font-heading text-lg font-bold text-gray-900" data-i18n="consulenza.process.step4.title">Development</h3>
                <p class="mt-2 text-gray-600 text-sm" data-i18n="consulenza.process.step4.desc">We work in short sprints with incremental deliveries.</p>
            </div>
        </div>
    </div>
</section>


<section class="py-20 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="section-title text-center" data-i18n="consulenza.faq.title">Frequently Asked Questions</h2>

        <div class="mt-12 divide-y divide-gray-200" x-data="{ open: null }">
            
            <div class="py-5">
                <button @click="open = open === 1 ? null : 1" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="consulenza.faq.q1">How much does a consultation cost?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 1 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 1" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="consulenza.faq.a1">
                    The cost depends on the complexity and type of project. Contact us for a free personalized quote.
                </div>
            </div>

            
            <div class="py-5">
                <button @click="open = open === 2 ? null : 2" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="consulenza.faq.q2">How long does a typical project take?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 2 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 2" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="consulenza.faq.a2">
                    An assessment takes 1-2 weeks. A pilot project 4-8 weeks. A full implementation 2-4 months.
                </div>
            </div>

            
            <div class="py-5">
                <button @click="open = open === 3 ? null : 3" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="consulenza.faq.q3">Do you only work with Italian SMEs?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 3 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 3" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="consulenza.faq.a3">
                    We work with SMEs across Europe, with a focus on Italy, France, and DACH. We communicate in Italian, English, and French.
                </div>
            </div>

            
            <div class="py-5">
                <button @click="open = open === 4 ? null : 4" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="consulenza.faq.q4">Can I start with a small project?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 4 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 4" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="consulenza.faq.a4">
                    Absolutely. We always recommend starting with an assessment or pilot project to validate the value before investing more.
                </div>
            </div>

            
            <div class="py-5">
                <button @click="open = open === 5 ? null : 5" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="consulenza.faq.q5">What technologies do you use?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 5 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 5" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="consulenza.faq.a5">
                    Claude, OpenAI, Ollama for LLM. Python, FastAPI, Laravel for backend. PostgreSQL for data. AWS/GCP for cloud.
                </div>
            </div>

            
            <div class="py-5">
                <button @click="open = open === 6 ? null : 6" class="flex w-full items-center justify-between text-left">
                    <span class="font-heading text-base font-semibold text-gray-900" data-i18n="consulenza.faq.q6">Are you GDPR and AI Act compliant?</span>
                    <svg class="h-5 w-5 text-gray-500 transition-transform duration-200" :class="{ 'rotate-180': open === 6 }" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" /></svg>
                </button>
                <div x-show="open === 6" x-collapse x-cloak class="mt-3 text-gray-600 text-sm leading-relaxed" data-i18n="consulenza.faq.a6">
                    Yes. Compliance is integrated into every project. We can also help you prepare your company for the AI Act.
                </div>
            </div>
        </div>
    </div>
</section>


<section class="py-20 bg-navy">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="font-heading text-3xl sm:text-4xl font-bold text-white" data-i18n="consulenza.cta.title">Fill out the form, I'll respond within 24 hours.</h2>
        <div class="mt-8">
            <a href="/contatto" class="btn-primary" data-i18n="consulenza.hero.cta">Request information</a>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/pages/consulenza.blade.php ENDPATH**/ ?>