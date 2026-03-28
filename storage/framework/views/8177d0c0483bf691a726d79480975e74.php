<div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($success): ?>
        <div class="bg-primary-light text-primary-dark px-4 py-3 rounded-lg text-sm font-medium">
            Iscritto con successo! Ti terremo aggiornato.
        </div>
    <?php else: ?>
        <form wire:submit="subscribe" class="flex gap-2">
            <input type="email" wire:model="email" placeholder="La tua email"
                class="flex-1 px-4 py-3 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-primary focus:border-primary"
                required>
            <button type="submit" class="btn-primary whitespace-nowrap text-sm" wire:loading.attr="disabled">
                <span wire:loading.remove>Iscriviti</span>
                <span wire:loading>...</span>
            </button>
        </form>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
            <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($error): ?>
            <p class="text-red-500 text-xs mt-1"><?php echo e($error); ?></p>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /Users/oronzosuma/Code/lab/corvalys/resources/views/livewire/newsletter-form.blade.php ENDPATH**/ ?>