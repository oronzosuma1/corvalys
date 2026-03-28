<?php $__env->startSection('title', 'Quotazione AI'); ?>

<?php $__env->startSection('content'); ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($lastAssessment) && $lastAssessment && $lastAssessment->result): ?>
        <?php $r = $lastAssessment->result; ?>
        
        <div class="space-y-6 mb-10">
            <div class="flex items-center justify-between">
                <h2 class="text-lg font-heading font-bold text-gray-900">Ultima quotazione generata</h2>
                <span class="text-xs text-gray-400"><?php echo e($lastAssessment->created_at->format('d/m/Y H:i')); ?>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($lastAssessment->lead): ?>
                        &mdash; Lead: <?php echo e($lastAssessment->lead->name); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </span>
            </div>

            
            <div class="bg-white rounded-xl border border-gray-200/60 p-6">
                <div class="text-center mb-6">
                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wide mb-2">Range stimato</p>
                    <div class="flex items-center justify-center gap-4">
                        <div>
                            <p class="text-3xl font-heading font-bold text-primary-dark">&euro;<?php echo e(number_format($r['min_eur'] ?? 0, 0, ',', '.')); ?></p>
                            <p class="text-xs text-gray-400">Minimo</p>
                        </div>
                        <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        <div>
                            <p class="text-3xl font-heading font-bold text-navy">&euro;<?php echo e(number_format($r['max_eur'] ?? 0, 0, ',', '.')); ?></p>
                            <p class="text-xs text-gray-400">Massimo</p>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-center gap-4">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['confidence'])): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                <?php echo e($r['confidence'] === 'alta' ? 'bg-green-100 text-green-700' : ($r['confidence'] === 'media' ? 'bg-amber-100 text-amber-700' : 'bg-red-100 text-red-700')); ?>">
                                Confidenza: <?php echo e(ucfirst($r['confidence'])); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['hourly_rate'])): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                &euro;<?php echo e(number_format($r['hourly_rate'], 0, ',', '.')); ?>/h
                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['contract_type'])): ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-primary-light text-primary-dark">
                                <?php echo e(str_replace('_', ' ', ucfirst($r['contract_type']))); ?>

                            </span>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['hours_min']) && isset($r['hours_max'])): ?>
                    <div class="text-center text-sm text-gray-500">
                        Ore stimate: <span class="font-semibold text-gray-900"><?php echo e($r['hours_min']); ?> &ndash; <?php echo e($r['hours_max']); ?> ore</span>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['breakdown']) && is_array($r['breakdown'])): ?>
                <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h3 class="text-sm font-heading font-semibold text-gray-900">Breakdown costi</h3>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['analisi' => 'Analisi', 'sviluppo' => 'Sviluppo', 'pm' => 'Project Mgmt', 'testing' => 'Testing']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['breakdown'][$key])): ?>
                                    <div class="bg-gray-50 rounded-lg p-3 text-center">
                                        <p class="text-xs font-medium text-gray-500"><?php echo e($label); ?></p>
                                        <p class="text-lg font-heading font-bold text-gray-900 mt-1"><?php echo e($r['breakdown'][$key]); ?>%</p>
                                        <div class="mt-2 w-full bg-gray-200 rounded-full h-1.5">
                                            <div class="bg-primary rounded-full h-1.5" style="width: <?php echo e($r['breakdown'][$key]); ?>%"></div>
                                        </div>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['suggested_contract_type']) && $r['suggested_contract_type']): ?>
                <div class="bg-white rounded-xl border border-blue-200 overflow-hidden">
                    <div class="px-5 py-4 border-b border-blue-100 bg-blue-50">
                        <h3 class="text-sm font-heading font-semibold text-blue-700">Contratto suggerito</h3>
                    </div>
                    <div class="p-5 text-sm text-gray-700"><?php echo e($r['suggested_contract_type']); ?></div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['warnings']) && is_array($r['warnings']) && count($r['warnings'])): ?>
                    <div class="bg-white rounded-xl border border-red-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-red-100 bg-red-50">
                            <h3 class="text-sm font-heading font-semibold text-red-700">&#9888; Warnings</h3>
                        </div>
                        <div class="p-5">
                            <ul class="space-y-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $r['warnings']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warning): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <li class="flex items-start gap-2 text-sm text-red-700">
                                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.34 16.5c-.77.833.192 2.5 1.732 2.5z"/></svg>
                                        <?php echo e($warning); ?>

                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['strengths']) && is_array($r['strengths']) && count($r['strengths'])): ?>
                    <div class="bg-white rounded-xl border border-green-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-green-100 bg-green-50">
                            <h3 class="text-sm font-heading font-semibold text-green-700">&#10003; Punti di forza</h3>
                        </div>
                        <div class="p-5">
                            <ul class="space-y-2">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $r['strengths']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $strength): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                    <li class="flex items-start gap-2 text-sm text-green-700">
                                        <svg class="w-4 h-4 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <?php echo e($strength); ?>

                                    </li>
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['negotiation_notes']) && $r['negotiation_notes']): ?>
                <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h3 class="text-sm font-heading font-semibold text-gray-900">&#128172; Note negoziazione</h3>
                    </div>
                    <div class="p-5 text-sm text-gray-700 leading-relaxed whitespace-pre-line"><?php echo e($r['negotiation_notes']); ?></div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($r['proposal_highlights']) && $r['proposal_highlights']): ?>
                <div class="bg-white rounded-xl border border-primary/20 overflow-hidden">
                    <div class="px-5 py-4 border-b border-primary/10 bg-primary-light">
                        <h3 class="text-sm font-heading font-semibold text-primary-dark">&#127775; Highlights proposta</h3>
                    </div>
                    <div class="p-5 text-sm text-gray-700 leading-relaxed whitespace-pre-line"><?php echo e($r['proposal_highlights']); ?></div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

    
    <div class="bg-white rounded-xl border border-gray-200/60 overflow-hidden">
        <div class="px-5 py-4 border-b border-gray-100 bg-gradient-to-r from-primary-dark to-navy">
            <h2 class="text-sm font-heading font-semibold text-white flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <?php echo e(isset($lastAssessment) && $lastAssessment ? 'Genera nuova quotazione' : 'Genera quotazione con Claude AI'); ?>

            </h2>
        </div>
        <form method="POST" action="<?php echo e(route('admin.quotazione.generate-standalone')); ?>" class="p-5">
            <?php echo csrf_field(); ?>

            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($leads->count()): ?>
                <div class="mb-5 p-4 bg-gray-50 rounded-lg">
                    <label for="lead_id" class="block text-xs font-medium text-gray-500 mb-1">Collega a un lead (opzionale)</label>
                    <select name="lead_id" id="lead_id" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="">— Nessun lead —</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $leads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lead): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($lead->id); ?>"><?php echo e($lead->name); ?> — <?php echo e($lead->company ?? $lead->email); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </select>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                
                <div>
                    <label for="service_type" class="block text-xs font-medium text-gray-500 mb-1">Tipo servizio *</label>
                    <select name="service_type" id="service_type" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary" required>
                        <option value="consulenza">Consulenza strategica</option>
                        <option value="sviluppo">Sviluppo software / AI</option>
                        <option value="ai-integration">Integrazione AI</option>
                        <option value="compliance">AI Act Compliance</option>
                        <option value="supply-chain">Supply Chain Optimization</option>
                        <option value="industry40">Industry 4.0</option>
                        <option value="formazione">Formazione</option>
                        <option value="audit">Audit & Assessment</option>
                    </select>
                </div>

                
                <div>
                    <label for="sector" class="block text-xs font-medium text-gray-500 mb-1">Settore *</label>
                    <input type="text" name="sector" id="sector" placeholder="es. manifattura, servizi, retail, finanza..." required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>

                
                <div>
                    <label for="complexity" class="block text-xs font-medium text-gray-500 mb-1">Complessit&agrave; tecnica (1-5)</label>
                    <input type="range" name="complexity" id="complexity" min="1" max="5" value="3"
                        class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-primary"
                        oninput="document.getElementById('complexity_val').textContent = this.value">
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>1 — Semplice</span>
                        <span class="font-semibold text-primary" id="complexity_val">3</span>
                        <span>5 — Molto complessa</span>
                    </div>
                </div>

                
                <div>
                    <label for="domain_expertise" class="block text-xs font-medium text-gray-500 mb-1">Familiarit&agrave; dominio</label>
                    <select name="domain_expertise" id="domain_expertise" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="alta">Alta — gi&agrave; lavorato in questo settore</option>
                        <option value="media" selected>Media — conosco il contesto</option>
                        <option value="bassa">Bassa — settore nuovo</option>
                    </select>
                </div>

                
                <div>
                    <label for="output_type" class="block text-xs font-medium text-gray-500 mb-1">Output atteso *</label>
                    <input type="text" name="output_type" id="output_type" placeholder="es. webapp, dashboard, API, report, PoC..." required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>

                
                <div>
                    <label for="timeline" class="block text-xs font-medium text-gray-500 mb-1">Timeline cliente</label>
                    <select name="timeline" id="timeline" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="urgente">&lt; 2 settimane (urgente)</option>
                        <option value="1-2 settimane">1-2 settimane</option>
                        <option value="1 mese" selected>~1 mese</option>
                        <option value="2-3 mesi">2-3 mesi</option>
                        <option value="3-6 mesi">3-6 mesi</option>
                        <option value="flessibile">Flessibile</option>
                    </select>
                </div>

                
                <div>
                    <label for="hours_estimate" class="block text-xs font-medium text-gray-500 mb-1">Stima ore (tua) *</label>
                    <input type="text" name="hours_estimate" id="hours_estimate" placeholder="es. 40-80, oppure 120" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>

                
                <div>
                    <label for="client_team" class="block text-xs font-medium text-gray-500 mb-1">Team lato cliente</label>
                    <input type="text" name="client_team" id="client_team" placeholder="es. 1 PM + 2 dev, nessuno, CTO..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                </div>

                
                <div>
                    <label for="budget_alignment" class="block text-xs font-medium text-gray-500 mb-1">Budget del cliente vs tua stima</label>
                    <select name="budget_alignment" id="budget_alignment" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="non_dichiarato" selected>Non dichiarato</option>
                        <option value="allineato">Allineato</option>
                        <option value="sopra">Cliente ha budget superiore</option>
                        <option value="sotto">Cliente ha budget inferiore</option>
                    </select>
                </div>

                
                <div>
                    <label for="scope_clarity" class="block text-xs font-medium text-gray-500 mb-1">Chiarezza dello scope</label>
                    <select name="scope_clarity" id="scope_clarity" class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary">
                        <option value="chiaro">Chiaro — requisiti definiti</option>
                        <option value="medio" selected>Medio — idea chiara, dettagli da definire</option>
                        <option value="vago">Vago — solo un'idea generica</option>
                    </select>
                </div>

                
                <div class="sm:col-span-2">
                    <label for="risk_flags" class="block text-xs font-medium text-gray-500 mb-1">Flag rischio</label>
                    <textarea name="risk_flags" id="risk_flags" rows="2" placeholder="Rischi identificati: es. tecnologia nuova, deadline stretta, stakeholder multipli, integrazioni legacy..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none"></textarea>
                </div>

                
                <div class="sm:col-span-2">
                    <label for="client_description" class="block text-xs font-medium text-gray-500 mb-1">Descrizione progetto del cliente</label>
                    <textarea name="client_description" id="client_description" rows="3" placeholder="Copia qui la descrizione originale del cliente, email, brief..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none"></textarea>
                </div>

                
                <div class="sm:col-span-2">
                    <label for="notes" class="block text-xs font-medium text-gray-500 mb-1">Tue note interne</label>
                    <textarea name="notes" id="notes" rows="2" placeholder="Contesto aggiuntivo, preferenze contrattuali, considerazioni..."
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary resize-none"></textarea>
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between">
                <p class="text-xs text-gray-400">Powered by Claude AI &mdash; i risultati sono suggerimenti, non preventivi definitivi.</p>
                <button type="submit" class="inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-primary-dark to-navy text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    Genera quotazione
                </button>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/admin/quotazione/index.blade.php ENDPATH**/ ?>