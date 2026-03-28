<?php $__env->startSection('title', 'Contact — Corvalys'); ?>

<?php $__env->startSection('content'); ?>


<section class="bg-gradient-to-br from-navy via-navy to-primary/90 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-3xl md:text-4xl font-heading font-bold text-white mb-4" data-i18n="contact.title">
            Request a Consultation
        </h1>
        <p class="text-lg text-white/80 max-w-2xl mx-auto" data-i18n="contact.subtitle">
            Tell us about your business and project. We'll provide a personalized assessment within 24 hours.
        </p>
    </div>
</section>


<section class="py-12 bg-gray-50" x-data="contactForm()" x-cloak>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
            <div
                x-data="{ show: true }"
                x-show="show"
                x-transition
                class="mb-8 max-w-4xl mx-auto bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-lg flex items-center justify-between"
            >
                <p class="text-sm font-medium"><?php echo e(session('success')); ?></p>
                <button @click="show = false" class="text-green-600 hover:text-green-800">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        
        <div class="max-w-4xl mx-auto mb-10">
            <div class="flex items-center justify-between mb-3">
                <template x-for="s in 4" :key="s">
                    <div class="flex items-center" :class="s < 4 ? 'flex-1' : ''">
                        
                        <div class="flex items-center justify-center w-10 h-10 rounded-full text-sm font-bold transition-all duration-300"
                            :class="step >= s
                                ? 'bg-primary text-white shadow-lg shadow-primary/30'
                                : 'bg-white text-gray-400 border-2 border-gray-200'">
                            <template x-if="step > s">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                            </template>
                            <template x-if="step <= s">
                                <span x-text="s"></span>
                            </template>
                        </div>
                        
                        <div x-show="s < 4" class="flex-1 h-1 mx-2 rounded-full transition-all duration-300"
                            :class="step > s ? 'bg-primary' : 'bg-gray-200'"></div>
                    </div>
                </template>
            </div>
            <div class="flex justify-between text-xs text-gray-500 px-1">
                <span data-i18n="contact.step1.label" :class="step >= 1 && 'text-primary font-semibold'">About You</span>
                <span data-i18n="contact.step2.label" :class="step >= 2 && 'text-primary font-semibold'">Technology</span>
                <span data-i18n="contact.step3.label" :class="step >= 3 && 'text-primary font-semibold'">Your Project</span>
                <span data-i18n="contact.step4.label" :class="step >= 4 && 'text-primary font-semibold'">Review</span>
            </div>
        </div>

        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-3 gap-10">

            
            <div class="lg:col-span-2">
                <form method="POST" action="<?php echo e(route('contatto.store')); ?>" @submit.prevent="submitForm" x-ref="form">
                    <?php echo csrf_field(); ?>

                    
                    <div x-show="step === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <h2 class="text-2xl font-heading font-bold text-navy mb-2" data-i18n="contact.step1.title">About You</h2>
                        <p class="text-gray-500 mb-8" data-i18n="contact.step1.subtitle">Tell us who you are so we can personalize our proposal.</p>

                        <div class="space-y-6">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                
                                <div>
                                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.name">Name <span class="text-red-400">*</span></label>
                                    <input type="text" name="name" id="name" x-model="form.name" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                        data-i18n-placeholder="contact.name.placeholder" placeholder="Your full name">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.email">Email <span class="text-red-400">*</span></label>
                                    <input type="email" name="email" id="email" x-model="form.email" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                        placeholder="you@company.com">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div>
                                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.phone">Phone</label>
                                    <input type="tel" name="phone" id="phone" x-model="form.phone"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                        placeholder="+39 ...">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div>
                                    <label for="company" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.company">Company <span class="text-red-400">*</span></label>
                                    <input type="text" name="company" id="company" x-model="form.company" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                        data-i18n-placeholder="contact.company.placeholder" placeholder="Company name">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['company'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div>
                                    <label for="company_size" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.company_size">Company Size <span class="text-red-400">*</span></label>
                                    <select name="company_size" id="company_size" x-model="form.company_size" required
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                        <option value="" data-i18n="contact.company_size.placeholder">Select size...</option>
                                        <option value="1-10" data-i18n="contact.company_size.1_10">1-10 employees</option>
                                        <option value="11-50" data-i18n="contact.company_size.11_50">11-50 employees</option>
                                        <option value="51-200" data-i18n="contact.company_size.51_200">51-200 employees</option>
                                        <option value="200+" data-i18n="contact.company_size.200_plus">200+ employees</option>
                                    </select>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['company_size'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.industry">Industry</label>
                                    <input type="text" name="industry" id="industry" x-model="form.industry"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                        data-i18n-placeholder="contact.industry.placeholder" placeholder="e.g. Manufacturing, Retail, Services...">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['industry'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div>
                                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.country">Country</label>
                                    <input type="text" name="country" id="country" x-model="form.country"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                        data-i18n-placeholder="contact.country.placeholder" placeholder="e.g. Italy, Germany...">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>

                                
                                <div>
                                    <label for="website" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.website">Website</label>
                                    <input type="url" name="website" id="website" x-model="form.website"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                        placeholder="https://...">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['website'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div x-show="step === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <h2 class="text-2xl font-heading font-bold text-navy mb-2" data-i18n="contact.step2.title">Tell us about your current technology setup</h2>
                        <p class="text-gray-500 mb-8" data-i18n="contact.step2.subtitle">This helps us understand where you are and propose the right solution.</p>

                        <div class="space-y-4">
                            
                            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/30 transition-colors">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="uses_erp" value="1" x-model="form.uses_erp"
                                        class="rounded border-gray-300 text-primary focus:ring-primary w-5 h-5">
                                    <span class="font-medium text-gray-800" data-i18n="contact.tech.erp">We use an ERP system</span>
                                </label>
                                <div x-show="form.uses_erp" x-transition class="mt-3 ml-8">
                                    <input type="text" name="erp_name" x-model="form.erp_name"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm"
                                        data-i18n-placeholder="contact.tech.erp.placeholder" placeholder="e.g. SAP, Odoo, Microsoft Dynamics...">
                                </div>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/30 transition-colors">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="uses_excel" value="1" x-model="form.uses_excel"
                                        class="rounded border-gray-300 text-primary focus:ring-primary w-5 h-5">
                                    <span class="font-medium text-gray-800" data-i18n="contact.tech.excel">We primarily use Excel/spreadsheets for management</span>
                                </label>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/30 transition-colors">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="uses_database" value="1" x-model="form.uses_database"
                                        class="rounded border-gray-300 text-primary focus:ring-primary w-5 h-5">
                                    <span class="font-medium text-gray-800" data-i18n="contact.tech.database">We use a database system</span>
                                </label>
                                <div x-show="form.uses_database" x-transition class="mt-3 ml-8">
                                    <input type="text" name="database_name" x-model="form.database_name"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm"
                                        data-i18n-placeholder="contact.tech.database.placeholder" placeholder="e.g. MySQL, PostgreSQL, MongoDB...">
                                </div>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/30 transition-colors">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="has_it_team" value="1" x-model="form.has_it_team"
                                        class="rounded border-gray-300 text-primary focus:ring-primary w-5 h-5">
                                    <span class="font-medium text-gray-800" data-i18n="contact.tech.it_team">We have an internal IT team</span>
                                </label>
                                <div x-show="form.has_it_team" x-transition class="mt-3 ml-8">
                                    <input type="text" name="it_team_size" x-model="form.it_team_size"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm"
                                        data-i18n-placeholder="contact.tech.it_team.placeholder" placeholder="e.g. 2 people, 1 part-time...">
                                </div>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/30 transition-colors">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="uses_cloud" value="1" x-model="form.uses_cloud"
                                        class="rounded border-gray-300 text-primary focus:ring-primary w-5 h-5">
                                    <span class="font-medium text-gray-800" data-i18n="contact.tech.cloud">We use cloud services</span>
                                </label>
                                <div x-show="form.uses_cloud" x-transition class="mt-3 ml-8">
                                    <input type="text" name="cloud_provider" x-model="form.cloud_provider"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary text-sm"
                                        data-i18n-placeholder="contact.tech.cloud.placeholder" placeholder="e.g. AWS, Azure, Google Cloud...">
                                </div>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-5 hover:border-primary/30 transition-colors">
                                <label class="flex items-center gap-3 cursor-pointer">
                                    <input type="checkbox" name="has_api_integrations" value="1" x-model="form.has_api_integrations"
                                        class="rounded border-gray-300 text-primary focus:ring-primary w-5 h-5">
                                    <span class="font-medium text-gray-800" data-i18n="contact.tech.api">We have API integrations between systems</span>
                                </label>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-5">
                                <label for="current_ai_usage" class="block font-medium text-gray-800 mb-3" data-i18n="contact.tech.ai_usage">Current AI usage</label>
                                <select name="current_ai_usage" id="current_ai_usage" x-model="form.current_ai_usage"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                    <option value="none" data-i18n="contact.tech.ai_usage.none">None - we don't use AI</option>
                                    <option value="basic" data-i18n="contact.tech.ai_usage.basic">Basic - we use ChatGPT/similar</option>
                                    <option value="intermediate" data-i18n="contact.tech.ai_usage.intermediate">Intermediate - we have some AI automations</option>
                                    <option value="advanced" data-i18n="contact.tech.ai_usage.advanced">Advanced - AI is integrated in our workflows</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    
                    <div x-show="step === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <h2 class="text-2xl font-heading font-bold text-navy mb-2" data-i18n="contact.step3.title">Your Project</h2>
                        <p class="text-gray-500 mb-8" data-i18n="contact.step3.subtitle">Tell us what you need and we'll craft the best approach.</p>

                        <div class="space-y-6">
                            
                            <div>
                                <label for="service_type" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.service">Service type <span class="text-red-400">*</span></label>
                                <select name="service_type" id="service_type" x-model="form.service_type" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                    <option value="" data-i18n="contact.service.placeholder">Select a service...</option>
                                    <option value="strategy" data-i18n="contact.service.strategy">AI Strategy & Consulting</option>
                                    <option value="development" data-i18n="contact.service.development">AI Development / Integration</option>
                                    <option value="compliance" data-i18n="contact.service.compliance">AI Act Compliance</option>
                                    <option value="supplychain" data-i18n="contact.service.supplychain">Supply Chain Optimization</option>
                                    <option value="industry40" data-i18n="contact.service.industry40">Industry 4.0</option>
                                    <option value="llm" data-i18n="contact.service.llm">LLM & Multi-Agent Systems</option>
                                    <option value="other" data-i18n="contact.service.other">Other</option>
                                </select>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['service_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div>
                                <label for="project_description" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.description">Project description <span class="text-red-400">*</span></label>
                                <textarea name="project_description" id="project_description" rows="4" x-model="form.project_description" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                    data-i18n-placeholder="contact.description.placeholder" placeholder="Describe your project or challenge..."></textarea>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['project_description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <div>
                                <label for="pain_points" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.pain_points">Pain points</label>
                                <textarea name="pain_points" id="pain_points" rows="3" x-model="form.pain_points"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                    data-i18n-placeholder="contact.pain_points.placeholder" placeholder="What are the main problems you want to solve?"></textarea>
                            </div>

                            
                            <div>
                                <label for="expected_outcomes" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.expected_outcomes">Expected outcomes</label>
                                <textarea name="expected_outcomes" id="expected_outcomes" rows="3" x-model="form.expected_outcomes"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                    data-i18n-placeholder="contact.expected_outcomes.placeholder" placeholder="What results do you expect?"></textarea>
                            </div>

                            
                            <div>
                                <label for="monthly_volume" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.monthly_volume">Monthly volume</label>
                                <input type="text" name="monthly_volume" id="monthly_volume" x-model="form.monthly_volume"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary"
                                    data-i18n-placeholder="contact.monthly_volume.placeholder" placeholder="e.g. 500 invoices/month, 100 orders/day...">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                
                                <div>
                                    <label for="desired_timeline" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.timeline">Desired timeline</label>
                                    <select name="desired_timeline" id="desired_timeline" x-model="form.desired_timeline"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                        <option value="" data-i18n="contact.timeline.placeholder">Select...</option>
                                        <option value="asap" data-i18n="contact.timeline.asap">As soon as possible</option>
                                        <option value="1-3months" data-i18n="contact.timeline.1_3">1-3 months</option>
                                        <option value="3-6months" data-i18n="contact.timeline.3_6">3-6 months</option>
                                        <option value="6+months" data-i18n="contact.timeline.6_plus">6+ months</option>
                                        <option value="exploring" data-i18n="contact.timeline.exploring">No rush / exploring</option>
                                    </select>
                                </div>

                                
                                <div>
                                    <label for="budget_range" class="block text-sm font-medium text-gray-700 mb-1" data-i18n="contact.budget">Budget range</label>
                                    <select name="budget_range" id="budget_range" x-model="form.budget_range"
                                        class="w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary">
                                        <option value="" data-i18n="contact.budget.placeholder">Select a range...</option>
                                        <option value="under1k">&lt; &euro;1,000</option>
                                        <option value="1k-5k">&euro;1,000 &ndash; 5,000</option>
                                        <option value="5k-15k">&euro;5,000 &ndash; 15,000</option>
                                        <option value="15k-50k">&euro;15,000 &ndash; 50,000</option>
                                        <option value="over50k">&euro;50,000+</option>
                                        <option value="tbd" data-i18n="contact.budget.tbd">To be defined</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div x-show="step === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-x-4" x-transition:enter-end="opacity-100 translate-x-0">
                        <h2 class="text-2xl font-heading font-bold text-navy mb-2" data-i18n="contact.step4.title">Review & Submit</h2>
                        <p class="text-gray-500 mb-8" data-i18n="contact.step4.subtitle">Please review your information before submitting.</p>

                        <div class="space-y-6">
                            
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="font-heading font-bold text-navy" data-i18n="contact.step1.title">About You</h3>
                                    <button type="button" @click="step = 1" class="text-sm text-primary hover:underline" data-i18n="contact.review.edit">Edit</button>
                                </div>
                                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-3 text-sm">
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.name">Name</dt>
                                        <dd class="font-medium text-gray-900" x-text="form.name || '—'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.email">Email</dt>
                                        <dd class="font-medium text-gray-900" x-text="form.email || '—'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.phone">Phone</dt>
                                        <dd class="font-medium text-gray-900" x-text="form.phone || '—'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.company">Company</dt>
                                        <dd class="font-medium text-gray-900" x-text="form.company || '—'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.company_size">Company Size</dt>
                                        <dd class="font-medium text-gray-900" x-text="form.company_size || '—'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.industry">Industry</dt>
                                        <dd class="font-medium text-gray-900" x-text="form.industry || '—'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.country">Country</dt>
                                        <dd class="font-medium text-gray-900" x-text="form.country || '—'"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.website">Website</dt>
                                        <dd class="font-medium text-gray-900" x-text="form.website || '—'"></dd>
                                    </div>
                                </dl>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="font-heading font-bold text-navy" data-i18n="contact.step2.label">Technology</h3>
                                    <button type="button" @click="step = 2" class="text-sm text-primary hover:underline" data-i18n="contact.review.edit">Edit</button>
                                </div>
                                <div class="space-y-2 text-sm">
                                    <div x-show="form.uses_erp" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        <span class="text-gray-700" data-i18n="contact.tech.erp">ERP system</span>
                                        <span x-show="form.erp_name" class="text-gray-500">(<span x-text="form.erp_name"></span>)</span>
                                    </div>
                                    <div x-show="form.uses_excel" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        <span class="text-gray-700" data-i18n="contact.tech.excel">Excel/spreadsheets</span>
                                    </div>
                                    <div x-show="form.uses_database" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        <span class="text-gray-700" data-i18n="contact.tech.database">Database system</span>
                                        <span x-show="form.database_name" class="text-gray-500">(<span x-text="form.database_name"></span>)</span>
                                    </div>
                                    <div x-show="form.has_it_team" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        <span class="text-gray-700" data-i18n="contact.tech.it_team">Internal IT team</span>
                                        <span x-show="form.it_team_size" class="text-gray-500">(<span x-text="form.it_team_size"></span>)</span>
                                    </div>
                                    <div x-show="form.uses_cloud" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        <span class="text-gray-700" data-i18n="contact.tech.cloud">Cloud services</span>
                                        <span x-show="form.cloud_provider" class="text-gray-500">(<span x-text="form.cloud_provider"></span>)</span>
                                    </div>
                                    <div x-show="form.has_api_integrations" class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-green-500 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="3"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                        <span class="text-gray-700" data-i18n="contact.tech.api">API integrations</span>
                                    </div>
                                    <div x-show="!form.uses_erp && !form.uses_excel && !form.uses_database && !form.has_it_team && !form.uses_cloud && !form.has_api_integrations" class="text-gray-400 italic" data-i18n="contact.review.none_selected">
                                        No technologies selected
                                    </div>
                                    <div class="pt-2 border-t border-gray-100 mt-2">
                                        <span class="text-gray-500" data-i18n="contact.tech.ai_usage">AI usage:</span>
                                        <span class="font-medium text-gray-700" x-text="aiUsageLabel()"></span>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="font-heading font-bold text-navy" data-i18n="contact.step3.title">Your Project</h3>
                                    <button type="button" @click="step = 3" class="text-sm text-primary hover:underline" data-i18n="contact.review.edit">Edit</button>
                                </div>
                                <dl class="space-y-3 text-sm">
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.service">Service type</dt>
                                        <dd class="font-medium text-gray-900" x-text="serviceLabel()"></dd>
                                    </div>
                                    <div>
                                        <dt class="text-gray-500" data-i18n="contact.description">Project description</dt>
                                        <dd class="font-medium text-gray-900 whitespace-pre-line" x-text="form.project_description || '—'"></dd>
                                    </div>
                                    <div x-show="form.pain_points">
                                        <dt class="text-gray-500" data-i18n="contact.pain_points">Pain points</dt>
                                        <dd class="font-medium text-gray-900 whitespace-pre-line" x-text="form.pain_points"></dd>
                                    </div>
                                    <div x-show="form.expected_outcomes">
                                        <dt class="text-gray-500" data-i18n="contact.expected_outcomes">Expected outcomes</dt>
                                        <dd class="font-medium text-gray-900 whitespace-pre-line" x-text="form.expected_outcomes"></dd>
                                    </div>
                                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-2 border-t border-gray-100">
                                        <div x-show="form.monthly_volume">
                                            <dt class="text-gray-500" data-i18n="contact.monthly_volume">Monthly volume</dt>
                                            <dd class="font-medium text-gray-900" x-text="form.monthly_volume"></dd>
                                        </div>
                                        <div x-show="form.desired_timeline">
                                            <dt class="text-gray-500" data-i18n="contact.timeline">Timeline</dt>
                                            <dd class="font-medium text-gray-900" x-text="timelineLabel()"></dd>
                                        </div>
                                        <div x-show="form.budget_range">
                                            <dt class="text-gray-500" data-i18n="contact.budget">Budget</dt>
                                            <dd class="font-medium text-gray-900" x-text="budgetLabel()"></dd>
                                        </div>
                                    </div>
                                </dl>
                            </div>

                            
                            <div class="bg-white rounded-xl border border-gray-200 p-6">
                                <label class="flex items-start gap-3 cursor-pointer">
                                    <input type="checkbox" name="gdpr_consent" value="1" x-model="form.gdpr_consent" required
                                        class="mt-1 rounded border-gray-300 text-primary focus:ring-primary">
                                    <span class="text-sm text-gray-600" data-i18n-html="contact.gdpr">
                                        I consent to data processing according to the
                                        <a href="<?php echo e(route('privacy')); ?>" class="text-primary hover:underline" target="_blank">Privacy Policy</a> <span class="text-red-400">*</span>
                                    </span>
                                </label>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['gdpr_consent'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>

                            
                            <p class="text-xs text-gray-400 text-center" data-i18n="contact.response_note">
                                We'll analyze your request and get back to you within 24 hours with a preliminary assessment.
                            </p>
                        </div>
                    </div>

                    
                    <div class="flex items-center justify-between mt-10 pt-6 border-t border-gray-200">
                        <button type="button"
                            x-show="step > 1"
                            @click="step--; window.scrollTo({top: 0, behavior: 'smooth'})"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-gray-300 text-gray-700 font-medium hover:bg-gray-50 transition-colors">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                            <span data-i18n="contact.nav.back">Back</span>
                        </button>

                        <div x-show="step === 1" class="ml-auto"></div>

                        <button type="button"
                            x-show="step < 4"
                            @click="if(validateStep()) { step++; window.scrollTo({top: 0, behavior: 'smooth'}) }"
                            class="inline-flex items-center gap-2 px-6 py-3 rounded-lg bg-primary text-white font-medium hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20 ml-auto">
                            <span data-i18n="contact.nav.next">Next</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                        </button>

                        <button type="submit"
                            x-show="step === 4"
                            :disabled="!form.gdpr_consent || submitting"
                            class="inline-flex items-center gap-2 px-8 py-3 rounded-lg bg-primary text-white font-bold hover:bg-primary/90 transition-colors shadow-lg shadow-primary/20 ml-auto disabled:opacity-50 disabled:cursor-not-allowed">
                            <template x-if="!submitting">
                                <span class="flex items-center gap-2">
                                    <span data-i18n="contact.submit">Submit Request</span>
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                                </span>
                            </template>
                            <template x-if="submitting">
                                <span class="flex items-center gap-2">
                                    <svg class="animate-spin w-5 h-5" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"/></svg>
                                    <span data-i18n="contact.submitting">Submitting...</span>
                                </span>
                            </template>
                        </button>
                    </div>
                </form>
            </div>

            
            <aside x-show="step < 4" x-transition class="space-y-6 lg:sticky lg:top-24 lg:self-start">

                
                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm space-y-4">
                    <h4 class="font-heading font-bold text-navy" data-i18n="contact.direct">Direct contacts</h4>

                    <a href="mailto:info@corvalys.eu" class="flex items-center gap-3 text-sm text-gray-600 hover:text-primary transition">
                        <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        info@corvalys.eu
                    </a>

                    <div class="flex items-center gap-3 text-sm text-gray-600">
                        <svg class="w-5 h-5 text-gray-400 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        <span data-i18n-html="contact.direct.location">Europe &mdash; we work remotely with clients across Europe</span>
                    </div>

                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 8 8"><circle cx="4" cy="4" r="4"/></svg>
                        <span data-i18n="contact.direct.response">We respond within 24 hours</span>
                    </div>
                </div>

                
                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center gap-3 mb-3">
                        <svg class="w-5 h-5 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <h4 class="font-heading font-bold text-navy" data-i18n="contact.book">Book a call</h4>
                    </div>
                    <p class="text-gray-600 text-sm mb-4" data-i18n="contact.book.desc">Book a 30-minute discovery call to discuss your project.</p>

                    <a href="<?php echo e(config('corvalys.calendly_url')); ?>" target="_blank" rel="noopener"
                       class="btn-primary w-full text-center block" data-i18n="contact.book.btn">
                        Book a 30-minute call
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>


<script>
function contactForm() {
    return {
        step: 1,
        submitting: false,
        form: {
            // Step 1
            name: '<?php echo e(old("name", "")); ?>',
            email: '<?php echo e(old("email", "")); ?>',
            phone: '<?php echo e(old("phone", "")); ?>',
            company: '<?php echo e(old("company", "")); ?>',
            company_size: '<?php echo e(old("company_size", "")); ?>',
            industry: '<?php echo e(old("industry", "")); ?>',
            country: '<?php echo e(old("country", "")); ?>',
            website: '<?php echo e(old("website", "")); ?>',
            // Step 2
            uses_erp: <?php echo e(old('uses_erp') ? 'true' : 'false'); ?>,
            erp_name: '<?php echo e(old("erp_name", "")); ?>',
            uses_excel: <?php echo e(old('uses_excel') ? 'true' : 'false'); ?>,
            uses_database: <?php echo e(old('uses_database') ? 'true' : 'false'); ?>,
            database_name: '<?php echo e(old("database_name", "")); ?>',
            has_it_team: <?php echo e(old('has_it_team') ? 'true' : 'false'); ?>,
            it_team_size: '<?php echo e(old("it_team_size", "")); ?>',
            uses_cloud: <?php echo e(old('uses_cloud') ? 'true' : 'false'); ?>,
            cloud_provider: '<?php echo e(old("cloud_provider", "")); ?>',
            has_api_integrations: <?php echo e(old('has_api_integrations') ? 'true' : 'false'); ?>,
            current_ai_usage: '<?php echo e(old("current_ai_usage", "none")); ?>',
            // Step 3
            service_type: '<?php echo e(old("service_type", "")); ?>',
            project_description: '<?php echo e(old("project_description", "")); ?>',
            pain_points: '<?php echo e(old("pain_points", "")); ?>',
            expected_outcomes: '<?php echo e(old("expected_outcomes", "")); ?>',
            monthly_volume: '<?php echo e(old("monthly_volume", "")); ?>',
            desired_timeline: '<?php echo e(old("desired_timeline", "")); ?>',
            budget_range: '<?php echo e(old("budget_range", "")); ?>',
            // Step 4
            gdpr_consent: <?php echo e(old('gdpr_consent') ? 'true' : 'false'); ?>,
        },

        validateStep() {
            if (this.step === 1) {
                if (!this.form.name || !this.form.email || !this.form.company || !this.form.company_size) {
                    // Trigger native validation on visible required fields
                    const inputs = this.$refs.form.querySelectorAll('[required]');
                    for (const input of inputs) {
                        if (!input.value && input.offsetParent !== null) {
                            input.reportValidity();
                            return false;
                        }
                    }
                    return false;
                }
            }
            if (this.step === 3) {
                if (!this.form.service_type || !this.form.project_description) {
                    const inputs = this.$refs.form.querySelectorAll('[required]');
                    for (const input of inputs) {
                        if (!input.value && input.offsetParent !== null) {
                            input.reportValidity();
                            return false;
                        }
                    }
                    return false;
                }
            }
            return true;
        },

        submitForm() {
            if (!this.form.gdpr_consent) return;
            this.submitting = true;
            this.$refs.form.submit();
        },

        serviceLabel() {
            const map = {
                'strategy': 'AI Strategy & Consulting',
                'development': 'AI Development / Integration',
                'compliance': 'AI Act Compliance',
                'supplychain': 'Supply Chain Optimization',
                'industry40': 'Industry 4.0',
                'llm': 'LLM & Multi-Agent Systems',
                'other': 'Other'
            };
            return map[this.form.service_type] || '—';
        },

        aiUsageLabel() {
            const map = {
                'none': 'None',
                'basic': 'Basic (ChatGPT/similar)',
                'intermediate': 'Intermediate (some automations)',
                'advanced': 'Advanced (integrated in workflows)'
            };
            return map[this.form.current_ai_usage] || '—';
        },

        timelineLabel() {
            const map = {
                'asap': 'As soon as possible',
                '1-3months': '1-3 months',
                '3-6months': '3-6 months',
                '6+months': '6+ months',
                'exploring': 'No rush / exploring'
            };
            return map[this.form.desired_timeline] || '—';
        },

        budgetLabel() {
            const map = {
                'under1k': '< \u20AC1,000',
                '1k-5k': '\u20AC1,000 \u2013 5,000',
                '5k-15k': '\u20AC5,000 \u2013 15,000',
                '15k-50k': '\u20AC15,000 \u2013 50,000',
                'over50k': '\u20AC50,000+',
                'tbd': 'To be defined'
            };
            return map[this.form.budget_range] || '—';
        }
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/pages/contatto.blade.php ENDPATH**/ ?>