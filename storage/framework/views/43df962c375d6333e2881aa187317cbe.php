<?php $__env->startSection('title', 'Verifikasi Email - Puri Agung Permai RW12'); ?>

<?php $__env->startSection('content'); ?>
<div class="text-center mb-6">
    <div class="mx-auto w-14 h-14 bg-rose-100 rounded-full flex items-center justify-center mb-4">
        <i data-lucide="mail" class="w-7 h-7 text-rose-600"></i>
    </div>
    <h1 class="text-2xl font-bold text-slate-900">Verifikasi Email</h1>
    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
        Silakan verifikasi alamat email Anda dengan mengklik tautan yang kami kirim ke email Anda.
    </p>
</div>

<?php if(session('status') == 'verification-link-sent'): ?>
    <div class="flex items-center gap-2 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-700 mb-4">
        <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
        Tautan verifikasi baru telah dikirim ke email Anda.
    </div>
<?php endif; ?>

<div class="space-y-3">
    <form method="POST" action="<?php echo e(route('verification.send')); ?>">
        <?php echo csrf_field(); ?>
        <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
            <?php echo e(__('Kirim Ulang Email Verifikasi')); ?>

         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
    </form>

    <form method="POST" action="<?php echo e(route('logout')); ?>">
        <?php echo csrf_field(); ?>
        <button type="submit" class="w-full text-center text-sm text-slate-500 hover:text-slate-700 font-medium py-2 transition-colors">
            <?php echo e(__('Keluar')); ?>

        </button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\auth\verify-email.blade.php ENDPATH**/ ?>