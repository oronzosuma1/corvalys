<?php $__env->startSection('title', 'Lead: ' . $lead->name); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="mb-6">
        <a href="<?php echo e(route('admin.leads.index')); ?>" class="inline-flex items-center text-sm text-gray-500 hover:text-primary transition-colors">
            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Torna ai lead
        </a>
    </div>

    
    <div class="bg-white rounded-xl border border-gray-200/60 p-5 mb-6">
        <div class="flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div>
                    <h1 class="text-xl font-heading font-bold text-gray-900"><?php echo e($lead->name); ?></h1>
                    <p class="text-sm text-gray-500"><?php echo e($lead->company ?? 'No company'); ?> &middot; <?php echo e($lead->created_at->format('d/m/Y H:i')); ?></p>
                </div>
                <?php
                    $statusColors = [
                        'new' => 'bg-blue-100 text-blue-700 border-blue-200',
                        'contacted' => 'bg-amber-100 text-amber-700 border-amber-200',
                        'in_proposta' => 'bg-purple-100 text-purple-700 border-purple-200',
                        'converted' => 'bg-green-100 text-green-700 border-green-200',
                        'lost' => 'bg-gray-100 text-gray-600 border-gray-200',
                        'spam' => 'bg-red-100 text-red-700 border-red-200',
                    ];
                    $color = $statusColors[$lead->status] ?? 'bg-gray-100 text-gray-600 border-gray-200';
                ?>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold border <?php echo e($color); ?>"><?php echo e($lead->status_label); ?></span>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="document.getElementById('proposalModal').classList.remove('hidden')"
                    class="inline-flex items-center px-4 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    Invia proposta
                </button>
                <a href="<?php echo e(route('admin.quotazione.show', $lead)); ?>"
                    class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-dark to-navy text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                    Genera quotazione
                </a>
            </div>
        </div>
    </div>

    
    <div class="bg-white rounded-xl border border-gray-200/60 p-4 mb-6">
        <form method="POST" action="<?php echo e(route('admin.leads.update', $lead)); ?>" class="flex flex-wrap items-end gap-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>
            <div>
                <label for="status" class="block text-xs font-medium text-gray-500 mb-1">Stato</label>
                <select name="status" id="status" class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="new" <?php echo e($lead->status === 'new' ? 'selected' : ''); ?>>New</option>
                    <option value="contacted" <?php echo e($lead->status === 'contacted' ? 'selected' : ''); ?>>Contacted</option>
                    <option value="in_proposta" <?php echo e($lead->status === 'in_proposta' ? 'selected' : ''); ?>>In proposta</option>
                    <option value="converted" <?php echo e($lead->status === 'converted' ? 'selected' : ''); ?>>Converted</option>
                    <option value="lost" <?php echo e($lead->status === 'lost' ? 'selected' : ''); ?>>Lost</option>
                    <option value="spam" <?php echo e($lead->status === 'spam' ? 'selected' : ''); ?>>Spam</option>
                </select>
            </div>
            <div>
                <label for="urgency" class="block text-xs font-medium text-gray-500 mb-1">Urgenza</label>
                <select name="urgency" id="urgency" class="rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    <option value="bassa" <?php echo e($lead->urgency === 'bassa' ? 'selected' : ''); ?>>Bassa</option>
                    <option value="media" <?php echo e($lead->urgency === 'media' ? 'selected' : ''); ?>>Media</option>
                    <option value="alta" <?php echo e($lead->urgency === 'alta' ? 'selected' : ''); ?>>Alta</option>
                    <option value="urgente" <?php echo e($lead->urgency === 'urgente' ? 'selected' : ''); ?>>Urgente</option>
                </select>
            </div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                Aggiorna
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <div class="lg:col-span-2 space-y-6">

            
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Informazioni cliente</h2>
                </div>
                <div class="p-5">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Nome</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->name); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Email</dt>
                            <dd class="mt-1 text-sm"><a href="mailto:<?php echo e($lead->email); ?>" class="text-primary hover:text-primary-dark"><?php echo e($lead->email); ?></a></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Telefono</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->phone ?? '-'); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Azienda</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->company ?? '-'); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Website</dt>
                            <dd class="mt-1 text-sm">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead->website): ?>
                                    <a href="<?php echo e($lead->website); ?>" target="_blank" class="text-primary hover:text-primary-dark"><?php echo e($lead->website); ?></a>
                                <?php else: ?>
                                    <span class="text-gray-400">-</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Dimensione azienda</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->company_size ?? '-'); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Settore</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->industry ?? '-'); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Paese</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->country ?? '-'); ?></dd>
                        </div>
                    </dl>
                </div>
            </div>

            
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Maturita tecnologica</h2>
                </div>
                <div class="p-5">
                    <?php
                        $score = $lead->tech_maturity_score;
                        $label = $lead->getTechMaturityLabel();
                        $scoreColor = match($label) {
                            'Low' => 'bg-red-500',
                            'Medium' => 'bg-amber-500',
                            'High' => 'bg-green-500',
                            default => 'bg-gray-300',
                        };
                        $labelColor = match($label) {
                            'Low' => 'text-red-700 bg-red-100',
                            'Medium' => 'text-amber-700 bg-amber-100',
                            'High' => 'text-green-700 bg-green-100',
                            default => 'text-gray-500 bg-gray-100',
                        };
                    ?>

                    
                    <div class="mb-5">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm font-medium text-gray-700">Score: <?php echo e($score ?? 'N/A'); ?>/10</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold <?php echo e($labelColor); ?>"><?php echo e($label); ?></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="<?php echo e($scoreColor); ?> h-3 rounded-full transition-all duration-300" style="width: <?php echo e(($score ?? 0) * 10); ?>%"></div>
                        </div>
                    </div>

                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <?php
                            $techItems = [
                                ['label' => 'ERP', 'value' => $lead->uses_erp, 'detail' => $lead->erp_name],
                                ['label' => 'Excel', 'value' => $lead->uses_excel, 'detail' => null],
                                ['label' => 'Database', 'value' => $lead->uses_database, 'detail' => $lead->database_name],
                                ['label' => 'Team IT', 'value' => $lead->has_it_team, 'detail' => $lead->it_team_size ? $lead->it_team_size . ' persone' : null],
                                ['label' => 'Cloud', 'value' => $lead->uses_cloud, 'detail' => $lead->cloud_provider],
                                ['label' => 'API Integrations', 'value' => $lead->has_api_integrations, 'detail' => null],
                            ];
                        ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $techItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <div class="flex items-center gap-2 py-1.5">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item['value']): ?>
                                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <?php else: ?>
                                    <svg class="w-5 h-5 text-gray-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <span class="text-sm text-gray-700"><?php echo e($item['label']); ?></span>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item['detail']): ?>
                                    <span class="text-xs text-gray-400">(<?php echo e($item['detail']); ?>)</span>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>

                        <div class="flex items-center gap-2 py-1.5 sm:col-span-2">
                            <svg class="w-5 h-5 text-indigo-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <span class="text-sm text-gray-700">Uso AI: <span class="font-medium"><?php echo e(ucfirst($lead->current_ai_usage ?? 'none')); ?></span></span>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Dettagli progetto</h2>
                </div>
                <div class="p-5">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Tipo servizio</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead->service_type): ?>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-indigo-50 text-indigo-700"><?php echo e($lead->service_type); ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Budget</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->budget_label); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Timeline</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->desired_timeline ?? '-'); ?></dd>
                        </div>
                        <div>
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Volume mensile</dt>
                            <dd class="mt-1 text-sm text-gray-900"><?php echo e($lead->monthly_volume ?? '-'); ?></dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Descrizione progetto</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line"><?php echo e($lead->project_description ?? '-'); ?></dd>
                        </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead->pain_points): ?>
                            <div class="sm:col-span-2">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Pain points</dt>
                                <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line"><?php echo e($lead->pain_points); ?></dd>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead->expected_outcomes): ?>
                            <div class="sm:col-span-2">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wide">Risultati attesi</dt>
                                <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line"><?php echo e($lead->expected_outcomes); ?></dd>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </dl>
                </div>
            </div>

            
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-indigo-50 to-purple-50">
                    <div class="flex items-center justify-between">
                        <h2 class="text-sm font-heading font-semibold text-gray-900">AI Auto-Assessment</h2>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead->claude_auto_assessed_at): ?>
                            <span class="text-xs text-gray-400"><?php echo e($lead->claude_auto_assessed_at->format('d/m/Y H:i')); ?></span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>
                <div class="p-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead->claude_auto_assessment): ?>
                        <?php $aa = $lead->claude_auto_assessment; ?>

                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
                            <div class="bg-primary-light rounded-lg p-4 text-center">
                                <p class="text-xs font-medium text-primary-dark/60 uppercase">Costo stimato</p>
                                <p class="text-lg font-heading font-bold text-primary-dark mt-1">
                                    EUR <?php echo e(number_format($aa['estimated_cost_min'] ?? 0, 0, ',', '.')); ?> - <?php echo e(number_format($aa['estimated_cost_max'] ?? 0, 0, ',', '.')); ?>

                                </p>
                                <p class="text-xs text-primary-dark/50 mt-1"><?php echo e($aa['hourly_rate'] ?? '-'); ?> EUR/h</p>
                            </div>
                            <div class="bg-blue-50 rounded-lg p-4 text-center">
                                <p class="text-xs font-medium text-blue-700/60 uppercase">Ore stimate</p>
                                <p class="text-lg font-heading font-bold text-blue-700 mt-1">
                                    <?php echo e($aa['estimated_hours_min'] ?? '-'); ?> - <?php echo e($aa['estimated_hours_max'] ?? '-'); ?>h
                                </p>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <p class="text-xs font-medium text-gray-500 uppercase">Complessita / Fattibilita</p>
                                <p class="text-lg font-heading font-bold text-gray-900 mt-1">
                                    <?php echo e($aa['complexity'] ?? '-'); ?>/5 &middot;
                                    <span class="<?php if(($aa['feasibility'] ?? '') === 'alta'): ?> text-green-600 <?php elseif(($aa['feasibility'] ?? '') === 'media'): ?> text-amber-600 <?php else: ?> text-red-600 <?php endif; ?>">
                                        <?php echo e(ucfirst($aa['feasibility'] ?? '-')); ?>

                                    </span>
                                </p>
                            </div>
                        </div>

                        
                        <div class="space-y-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($aa['recommended_service_type'])): ?>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Servizio consigliato</p>
                                    <p class="text-sm text-gray-900 mt-1"><?php echo e($aa['recommended_service_type']); ?></p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($aa['tech_readiness_assessment'])): ?>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Tech Readiness</p>
                                    <p class="text-sm text-gray-900 mt-1"><?php echo e($aa['tech_readiness_assessment']); ?></p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($aa['suggested_approach'])): ?>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase">Approccio suggerito</p>
                                    <p class="text-sm text-gray-900 mt-1 whitespace-pre-line"><?php echo e($aa['suggested_approach']); ?></p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($aa['risks']) && count($aa['risks'])): ?>
                                <div>
                                    <p class="text-xs font-medium text-red-500 uppercase mb-2">Rischi</p>
                                    <ul class="space-y-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $aa['risks']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $risk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <li class="flex items-start gap-2 text-sm text-red-700">
                                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                                <?php echo e($risk); ?>

                                            </li>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($aa['next_steps']) && count($aa['next_steps'])): ?>
                                <div>
                                    <p class="text-xs font-medium text-green-600 uppercase mb-2">Prossimi passi</p>
                                    <ul class="space-y-1">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $aa['next_steps']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                            <li class="flex items-start gap-2 text-sm text-green-700">
                                                <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                <?php echo e($step); ?>

                                            </li>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                    </ul>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>

                        
                        <div class="mt-5 pt-4 border-t border-gray-100">
                            <form method="POST" action="<?php echo e(route('admin.leads.auto-assess', $lead)); ?>" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="inline-flex items-center text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                                    Rigenera auto-assessment
                                </button>
                            </form>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-6">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            <p class="text-sm text-gray-500 mb-4">Nessun auto-assessment disponibile</p>
                            <form method="POST" action="<?php echo e(route('admin.leads.auto-assess', $lead)); ?>" class="inline">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-lg hover:bg-indigo-700 transition-colors">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                    Genera auto-assessment
                                </button>
                            </form>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>

            
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Quotazione manuale</h2>
                </div>
                <div class="p-5">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($lastAssessment) && $lastAssessment): ?>
                        <?php $result = $lastAssessment->result ?? []; ?>
                        <div class="mb-4">
                            <div class="flex items-center justify-center gap-4 mb-4">
                                <div class="text-center">
                                    <p class="text-2xl font-heading font-bold text-primary-dark">EUR <?php echo e(number_format($result['min_eur'] ?? 0, 0, ',', '.')); ?></p>
                                    <p class="text-xs text-gray-400">Minimo</p>
                                </div>
                                <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                <div class="text-center">
                                    <p class="text-2xl font-heading font-bold text-navy">EUR <?php echo e(number_format($result['max_eur'] ?? 0, 0, ',', '.')); ?></p>
                                    <p class="text-xs text-gray-400">Massimo</p>
                                </div>
                            </div>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($result['confidence'])): ?>
                                <div class="text-center mb-3">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-light text-primary-dark">Confidenza: <?php echo e($result['confidence']); ?></span>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <p class="text-xs text-gray-400 text-center">Generata il <?php echo e($lastAssessment->created_at->format('d/m/Y H:i')); ?></p>
                        </div>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($result['breakdown']) && $result['breakdown']): ?>
                            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 mb-4">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['analisi' => 'Analisi', 'sviluppo' => 'Sviluppo', 'pm' => 'PM', 'testing' => 'Testing']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lbl): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($result['breakdown'][$key])): ?>
                                        <div class="bg-gray-50 rounded-lg p-2 text-center">
                                            <p class="text-xs text-gray-500"><?php echo e($lbl); ?></p>
                                            <p class="text-sm font-bold text-gray-900"><?php echo e($result['breakdown'][$key]); ?>%</p>
                                        </div>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="text-center pt-3 border-t border-gray-100">
                            <a href="<?php echo e(route('admin.quotazione.show', $lead)); ?>" class="inline-flex items-center text-sm text-primary hover:text-primary-dark font-medium">
                                Rigenera quotazione manuale &rarr;
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <p class="text-sm text-gray-400 mb-3">Nessuna quotazione manuale generata</p>
                            <a href="<?php echo e(route('admin.quotazione.show', $lead)); ?>"
                                class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-primary-dark to-navy text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                                Genera quotazione manuale
                            </a>
                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>

        
        <div class="space-y-6">

            
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Note interne</h2>
                </div>
                <div class="p-5 space-y-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead->internal_notes): ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = array_reverse(explode("\n\n", $lead->internal_notes)); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(trim($note)): ?>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <p class="text-sm text-gray-700 whitespace-pre-line"><?php echo e($note); ?></p>
                                </div>
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php else: ?>
                        <p class="text-sm text-gray-400">Nessuna nota</p>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <form method="POST" action="<?php echo e(route('admin.leads.nota', $lead)); ?>" class="mt-4">
                        <?php echo csrf_field(); ?>
                        <textarea name="nota" rows="3" placeholder="Aggiungi una nota..."
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none"></textarea>
                        <button type="submit" class="mt-2 inline-flex items-center px-3 py-1.5 bg-primary-dark text-white text-xs font-medium rounded-lg hover:bg-primary transition-colors">
                            Aggiungi nota
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h2 class="text-sm font-heading font-semibold text-gray-900">Proposta</h2>
                </div>
                <div class="p-5">
                    <button onclick="document.getElementById('proposalModal').classList.remove('hidden')"
                        class="w-full inline-flex items-center justify-center px-4 py-2.5 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Invia proposta al cliente
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div id="proposalModal" class="hidden fixed inset-0 z-50 overflow-y-auto">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20">
            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="document.getElementById('proposalModal').classList.add('hidden')"></div>

            <div class="relative bg-white rounded-2xl shadow-xl max-w-2xl w-full mx-auto z-10">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="text-lg font-heading font-semibold text-gray-900">Invia proposta a <?php echo e($lead->name); ?></h3>
                    <button onclick="document.getElementById('proposalModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <form method="POST" action="<?php echo e(route('admin.leads.proposal', $lead)); ?>" class="p-6 space-y-4">
                    <?php echo csrf_field(); ?>
                    <div>
                        <label for="proposal_subject" class="block text-xs font-medium text-gray-500 mb-1">Oggetto</label>
                        <input type="text" name="subject" id="proposal_subject"
                            value="Proposta Corvalys per <?php echo e($lead->company ?? $lead->name); ?> - <?php echo e(ucfirst($lead->service_type ?? 'consulenza')); ?>"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                    </div>

                    <div>
                        <label for="proposal_body" class="block text-xs font-medium text-gray-500 mb-1">Messaggio</label>
                        <textarea name="body" id="proposal_body" rows="12"
                            class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">Gentile <?php echo e($lead->name); ?>,

grazie per averci contattato. Dopo un'attenta analisi del progetto descritto, siamo lieti di presentarle la nostra proposta.

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lead->claude_auto_assessment): ?>
<?php $aa = $lead->claude_auto_assessment; ?>
Sulla base della nostra analisi preliminare, stimiamo:
- Ore di lavoro: <?php echo e($aa['estimated_hours_min'] ?? '-'); ?> - <?php echo e($aa['estimated_hours_max'] ?? '-'); ?> ore
- Investimento: EUR <?php echo e(number_format($aa['estimated_cost_min'] ?? 0, 0, ',', '.')); ?> - <?php echo e(number_format($aa['estimated_cost_max'] ?? 0, 0, ',', '.')); ?>


<?php echo e($aa['suggested_approach'] ?? ''); ?>

<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

Restiamo a disposizione per un incontro di approfondimento.

Cordiali saluti,
Enzo - Corvalys</textarea>
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="include_assessment" id="include_assessment" value="1"
                            class="rounded border-gray-300 text-primary focus:ring-primary" <?php echo e($lead->claude_auto_assessment ? 'checked' : ''); ?>>
                        <label for="include_assessment" class="text-sm text-gray-600">Includi dettagli assessment nell'email</label>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" onclick="document.getElementById('proposalModal').classList.add('hidden')"
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-800">
                            Annulla
                        </button>
                        <button type="submit" class="inline-flex items-center px-5 py-2 bg-primary-dark text-white text-sm font-medium rounded-lg hover:bg-primary transition-colors">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Invia proposta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/admin/leads/show.blade.php ENDPATH**/ ?>