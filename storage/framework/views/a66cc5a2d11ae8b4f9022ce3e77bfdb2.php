<!DOCTYPE html>
<html lang="it" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Admin'); ?> - Corvalys</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="bg-gray-50 min-h-screen flex font-body antialiased">
    
    <aside class="w-64 min-h-screen bg-gradient-to-b from-primary-dark to-navy text-white flex flex-col fixed overflow-y-auto">
        
        <div class="px-5 py-5 border-b border-white/10">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3">
                <img src="<?php echo e(asset('images/logo-corvalys.png')); ?>" alt="Corvalys logo" class="h-[50px] w-[50px] object-contain">
                <div>
                    <span class="text-base font-heading font-bold tracking-wide text-white">Corvalys</span>
                    <span class="block text-[10px] font-medium text-white/50 uppercase tracking-widest">Admin</span>
                </div>
            </a>
        </div>

        <nav class="flex-1 px-3 py-5 space-y-0.5">
            
            <a href="<?php echo e(route('admin.dashboard')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.dashboard') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zm10 0a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/></svg>
                Dashboard
            </a>

            
            <p class="px-3 pt-6 pb-2 text-[11px] font-semibold text-white/30 uppercase tracking-widest">Content</p>

            <a href="<?php echo e(route('admin.articles.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.articles.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                Articoli
            </a>

            <a href="<?php echo e(route('admin.services.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.services.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                Prodotti & Servizi
            </a>

            <a href="<?php echo e(route('admin.pages.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.pages.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Pages
            </a>

            <a href="<?php echo e(route('admin.team-members.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.team-members.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Team
            </a>

            <a href="<?php echo e(route('admin.display-partners.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.display-partners.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                Partners
            </a>

            
            <p class="px-3 pt-6 pb-2 text-[11px] font-semibold text-white/30 uppercase tracking-widest">Leads</p>

            <a href="<?php echo e(route('admin.leads.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.leads.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Lead
            </a>

            <a href="<?php echo e(route('admin.quotazione.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.quotazione.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                Quotazione AI
            </a>

            <a href="<?php echo e(route('admin.partners.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.partners.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                Partner
            </a>

            
            <p class="px-3 pt-6 pb-2 text-[11px] font-semibold text-white/30 uppercase tracking-widest">Finanza</p>

            <a href="<?php echo e(route('admin.invoices.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.invoices.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Fatture
            </a>

            <a href="<?php echo e(route('admin.cashflow.index')); ?>"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium transition-colors
                <?php echo e(request()->routeIs('admin.cashflow.*') ? 'bg-white/15 text-white shadow-sm' : 'text-white/60 hover:bg-white/10 hover:text-white'); ?>">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Cash Flow
            </a>

            
            <p class="px-3 pt-6 pb-2 text-[11px] font-semibold text-white/30 uppercase tracking-widest">Settings</p>

            <span class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium text-white/30 cursor-not-allowed">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.066 2.573c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.573 1.066c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.066-2.573c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Impostazioni
            </span>
        </nav>

        
        <div class="px-3 py-4 border-t border-white/10 space-y-0.5">
            <a href="<?php echo e(route('home')); ?>" target="_blank"
                class="flex items-center px-3 py-2.5 rounded-lg text-sm font-medium text-white/40 hover:text-white hover:bg-white/10 transition-colors">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                View Website
            </a>
            <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit"
                    class="flex items-center w-full px-3 py-2.5 rounded-lg text-sm font-medium text-white/40 hover:text-white hover:bg-white/10 transition-colors">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    
    <main class="flex-1 ml-64">
        
        <div class="sticky top-0 z-10 bg-white/80 backdrop-blur-sm border-b border-gray-200/60 px-8 py-3">
            <div class="flex items-center justify-between">
                <h1 class="text-sm font-heading font-semibold text-primary-dark"><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
                <p class="text-xs text-gray-400"><?php echo e(now()->format('l, d M Y')); ?></p>
            </div>
        </div>

        <div class="px-8 py-6">
            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('success')): ?>
                <div class="bg-primary-light border border-primary/20 text-primary-dark px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-primary flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm"><?php echo e(session('success')); ?></span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-primary/40 hover:text-primary text-lg leading-none">&times;</button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-6 flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        <span class="text-sm"><?php echo e(session('error')); ?></span>
                    </div>
                    <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-red-600 text-lg leading-none">&times;</button>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>

        
        <div class="px-8 py-4 border-t border-gray-100 mt-8">
            <p class="text-xs text-gray-400 text-center">&copy; <?php echo e(date('Y')); ?> Corvalys &middot; Strategy. Experience. Identity.</p>
        </div>
    </main>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/layouts/admin.blade.php ENDPATH**/ ?>