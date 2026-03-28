
<nav class="bg-white border-b border-gray-200 sticky top-16 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-1 overflow-x-auto py-3 scrollbar-hide">
            <a href="<?php echo e(route('chi-siamo')); ?>"
               class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition <?php echo e(request()->routeIs('chi-siamo') && !request()->routeIs('chi-siamo.*') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.chi-siamo">About Us</span>
            </a>
            <a href="<?php echo e(route('chi-siamo.missione')); ?>"
               class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition <?php echo e(request()->routeIs('chi-siamo.missione') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.missione">Our Mission</span>
            </a>
            <a href="<?php echo e(route('chi-siamo.valori')); ?>"
               class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition <?php echo e(request()->routeIs('chi-siamo.valori') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.valori">Values</span>
            </a>
            <a href="<?php echo e(route('chi-siamo.cosa-facciamo')); ?>"
               class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition <?php echo e(request()->routeIs('chi-siamo.cosa-facciamo') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.cosa-facciamo">What We Do</span>
            </a>
            <a href="<?php echo e(route('chi-siamo.team')); ?>"
               class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition <?php echo e(request()->routeIs('chi-siamo.team') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.team">Our Team</span>
            </a>
            <a href="<?php echo e(route('chi-siamo.partners')); ?>"
               class="px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition <?php echo e(request()->routeIs('chi-siamo.partners') ? 'bg-primary text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200'); ?>">
                <span data-i18n="nav.partners">Partners</span>
            </a>
        </div>
    </div>
</nav>
<?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/pages/chi-siamo/_subnav.blade.php ENDPATH**/ ?>