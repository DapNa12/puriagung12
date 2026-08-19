<?php $__env->startSection('title', 'Struktur RW'); ?>
<?php $__env->startSection('meta_description', 'Struktur kepengurusan RW 12 Puri Agung Permai. Daftar pengurus RW dan tugas masing-masing.'); ?>
<?php $__env->startSection('og_title', 'Struktur RW - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', 'Struktur kepengurusan RW 12 Puri Agung Permai.'); ?>

<?php $__env->startSection('content'); ?>
<div class="rw-page-head border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-12 md:py-20">
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900">Struktur RW</h1>
        <p class="mt-3 text-slate-600 text-base md:text-lg">
            Struktur kepengurusan RW 12<?php echo e($tahunMulai ? ' masa bakti ' . $tahunMulai . ' - ' . ($tahunSelesai ?: 'Sekarang') : ''); ?>

        </p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8 md:py-14">
    <?php if($pengurusRw->isEmpty()): ?>
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="users" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada data pengurus RW</p>
        <p class="text-slate-400 text-sm mt-1">Data akan ditampilkan setelah struktur kepengurusan RW dilengkapi melalui menu Pengurus.</p>
    </div>
    <?php else: ?>
    <!-- Mobile: Horizontal list -->
    <div class="md:hidden space-y-3 max-w-3xl mx-auto">
        <?php $__currentLoopData = $pengurusRw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="flex items-center gap-4 bg-white rounded-xl border border-slate-200 p-4">
            <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                <?php if($p->foto): ?>
                <img src="<?php echo e(asset('storage/'.$p->foto)); ?>" alt="<?php echo e($p->nama ?? 'Pengurus'); ?>" class="w-full h-full object-cover">
                <?php else: ?>
                <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                    <span class="text-lg font-bold text-rose-700"><?php echo e(substr($p->nama ?? '?', 0, 1)); ?></span>
                </div>
                <?php endif; ?>
            </div>
            <div class="flex-1 min-w-0">
                <span class="block text-[10px] font-bold uppercase tracking-wider text-rose-600 mb-0.5"><?php echo e($p->jabatan); ?></span>
                <h3 class="text-sm font-bold text-slate-900 truncate"><?php echo e($p->nama ?? '-'); ?></h3>
                <?php if($p->periode_mulai): ?>
                <p class="text-xs text-slate-400 mt-0.5"><?php echo e(\Carbon\Carbon::parse($p->periode_mulai)->format('Y')); ?> - <?php echo e($p->periode_selesai ? \Carbon\Carbon::parse($p->periode_selesai)->format('Y') : 'Sekarang'); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Desktop: Grid cards -->
    <div class="hidden md:grid grid-cols-2 lg:grid-cols-4 gap-6">
        <?php $__currentLoopData = $pengurusRw; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="rw-card p-6 text-center">
            <?php if($p->foto): ?>
            <img src="<?php echo e(asset('storage/'.$p->foto)); ?>" class="w-24 h-24 object-cover rounded-full mx-auto mb-4 border-4 border-white shadow-lg">
            <?php else: ?>
            <div class="w-24 h-24 bg-rose-100 rounded-full mx-auto mb-4 flex items-center justify-center border-4 border-white shadow-inner">
                <span class="text-3xl font-bold text-rose-700"><?php echo e(substr($p->nama ?? '?', 0, 1)); ?></span>
            </div>
            <?php endif; ?>
            <h3 class="text-lg font-bold text-slate-900"><?php echo e($p->nama ?? '-'); ?></h3>
            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-rose-50 text-rose-700 text-xs font-semibold mt-2"><?php echo e($p->jabatan); ?></span>
            <?php if($p->periode_mulai): ?>
            <p class="text-xs text-slate-400 mt-2"><?php echo e(\Carbon\Carbon::parse($p->periode_mulai)->format('Y')); ?> - <?php echo e($p->periode_selesai ? \Carbon\Carbon::parse($p->periode_selesai)->format('Y') : 'Sekarang'); ?></p>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views/public/struktur-rw.blade.php ENDPATH**/ ?>