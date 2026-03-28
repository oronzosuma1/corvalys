<!DOCTYPE html>
<html lang="it" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Corvalys Admin</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-primary-dark to-navy font-body antialiased">
    <div class="w-full max-w-sm mx-4">
        
        <div class="text-center mb-8">
            <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-3">
                <img src="<?php echo e(asset('images/logo-corvalys.png')); ?>" alt="Corvalys logo" class="h-[50px] w-[50px] object-contain">
                <div class="text-left">
                    <span class="text-xl font-heading font-bold text-white">Corvalys</span>
                    <span class="block text-[10px] font-medium text-white/50 uppercase tracking-widest">Admin Panel</span>
                </div>
            </a>
        </div>

        
        <div class="bg-white rounded-2xl shadow-xl p-6">
            <h2 class="text-lg font-heading font-semibold text-gray-900 mb-1">Accedi</h2>
            <p class="text-sm text-gray-500 mb-6">Inserisci le tue credenziali per accedere al pannello admin.</p>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(session('error')): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                    <?php echo e(session('error')); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 text-sm">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <p><?php echo e($error); ?></p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <form method="POST" action="<?php echo e(route('admin.login.submit')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <div>
                    <label for="email" class="block text-xs font-medium text-gray-500 mb-1">Email</label>
                    <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>" required autofocus
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary"
                        placeholder="admin@corvalys.eu">
                </div>

                <div>
                    <label for="password" class="block text-xs font-medium text-gray-500 mb-1">Password</label>
                    <input type="password" name="password" id="password" required
                        class="w-full rounded-lg border-gray-300 text-sm focus:border-primary focus:ring-primary"
                        placeholder="La tua password">
                </div>

                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember" class="rounded border-gray-300 text-primary focus:ring-primary">
                        <span class="text-sm text-gray-600">Ricordami</span>
                    </label>
                </div>

                <button type="submit" class="w-full py-2.5 bg-gradient-to-r from-primary-dark to-navy text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity">
                    Accedi
                </button>
            </form>
        </div>

        <p class="text-center text-xs text-white/30 mt-6">&copy; <?php echo e(date('Y')); ?> Corvalys &middot; Strategy. Experience. Identity.</p>
    </div>
</body>
</html>
<?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/admin/auth/login.blade.php ENDPATH**/ ?>