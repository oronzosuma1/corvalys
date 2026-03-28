<?php $__env->startSection('title', 'Blog — Insights su AI, PMI e futuro del lavoro | Corvalys'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center mb-12">
            <h1 class="section-title">Insights su AI, PMI e futuro del lavoro</h1>
            <p class="section-sub">Articoli pratici su automazione, AI Act e come le PMI europee possono competere meglio.</p>
        </div>

        
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <a href="<?php echo e(route('blog.index', $category ? ['category' => $category] : [])); ?>"
                class="px-4 py-2 rounded-full text-sm font-medium transition <?php echo e(!$type ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.blog.all">All Posts</span>
            </a>
            <a href="<?php echo e(route('blog.index', array_filter(['type' => 'article', 'category' => $category]))); ?>"
                class="px-4 py-2 rounded-full text-sm font-medium transition <?php echo e($type === 'article' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.blog.articles">Articles</span>
            </a>
            <a href="<?php echo e(route('blog.index', array_filter(['type' => 'case_study', 'category' => $category]))); ?>"
                class="px-4 py-2 rounded-full text-sm font-medium transition <?php echo e($type === 'case_study' ? 'bg-navy text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.blog.case-studies">Case Studies</span>
            </a>
        </div>

        
        <div class="flex flex-wrap justify-center gap-2 mb-12">
            <a href="<?php echo e(route('blog.index', $type ? ['type' => $type] : [])); ?>"
                class="px-4 py-2 rounded-full text-sm font-medium transition <?php echo e(!$category ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                Tutti
            </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['ai-pmi' => 'AI per PMI', 'ai-act' => 'AI Act', 'supply-chain' => 'Supply Chain', 'prodotto' => 'Prodotto', 'case-study' => 'Case Study']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <a href="<?php echo e(route('blog.index', array_filter(['category' => $slug, 'type' => $type]))); ?>"
                    class="px-4 py-2 rounded-full text-sm font-medium transition <?php echo e($category === $slug ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                    <?php echo e($label); ?>

                </a>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
        </div>

        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($articles->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($index === 0 && !$category && $articles->currentPage() === 1): ?>
                        
                        <div class="md:col-span-2 lg:col-span-3">
                            <a href="<?php echo e(route('blog.show', $article)); ?>" class="block card hover:shadow-lg transition group">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="bg-gray-100 rounded-lg h-48 md:h-full flex items-center justify-center text-gray-400">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->cover_image): ?>
                                            <img src="<?php echo e(asset($article->cover_image)); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-full object-cover rounded-lg">
                                        <?php else: ?>
                                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <div class="flex flex-col justify-center">
                                        <span class="inline-block bg-primary-light text-primary text-xs font-semibold px-3 py-1 rounded-full w-fit mb-3"><?php echo e(ucfirst(str_replace('-', ' ', $article->category))); ?></span>
                                        <h2 class="font-heading text-2xl font-bold text-navy group-hover:text-primary transition"><?php echo e($article->title); ?></h2>
                                        <p class="text-gray-600 mt-3 line-clamp-3"><?php echo e($article->excerpt); ?></p>
                                        <div class="flex items-center gap-4 mt-4 text-sm text-gray-400">
                                            <span><?php echo e($article->published_at?->format('d M Y')); ?></span>
                                            <span><?php echo e($article->reading_time_min); ?> min lettura</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php else: ?>
                        
                        <a href="<?php echo e(route('blog.show', $article)); ?>" class="card hover:shadow-lg transition group flex flex-col">
                            <div class="bg-gray-100 rounded-lg h-40 mb-4 flex items-center justify-center text-gray-400">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($article->cover_image): ?>
                                    <img src="<?php echo e(asset($article->cover_image)); ?>" alt="<?php echo e($article->title); ?>" class="w-full h-full object-cover rounded-lg">
                                <?php else: ?>
                                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                            <span class="inline-block bg-primary-light text-primary text-xs font-semibold px-3 py-1 rounded-full w-fit mb-2"><?php echo e(ucfirst(str_replace('-', ' ', $article->category))); ?></span>
                            <h3 class="font-heading text-lg font-bold text-navy group-hover:text-primary transition"><?php echo e($article->title); ?></h3>
                            <p class="text-gray-600 text-sm mt-2 line-clamp-2 flex-1"><?php echo e($article->excerpt); ?></p>
                            <div class="flex items-center gap-4 mt-4 text-xs text-gray-400">
                                <span><?php echo e($article->published_at?->format('d M Y')); ?></span>
                                <span><?php echo e($article->reading_time_min); ?> min</span>
                            </div>
                        </a>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </div>

            
            <div class="mt-12">
                <?php echo e($articles->withQueryString()->links()); ?>

            </div>
        <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">Nessun articolo trovato in questa categoria.</p>
                <a href="<?php echo e(route('blog.index')); ?>" class="btn-outline mt-4 inline-block">Vedi tutti gli articoli</a>
            </div>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/pages/blog/index.blade.php ENDPATH**/ ?>