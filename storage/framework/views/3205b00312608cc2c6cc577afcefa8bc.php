<?php $__env->startSection('title', 'Pengurus RT'); ?>
<?php $__env->startSection('meta_description', 'Daftar pengurus RT di Puri Agung Permai RW12. Struktur kepengurusan RT setiap blok.'); ?>
<?php $__env->startSection('og_title', 'Pengurus RT - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', 'Daftar pengurus RT di Puri Agung Permai RW12.'); ?>

<?php $__env->startSection('content'); ?>
<div class="rw-page-head border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-12 md:py-16">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-rose-100 text-rose-800 rounded-full text-xs font-semibold mb-3">
                <span class="w-2 h-2 rounded-full bg-rose-500" aria-hidden="true"></span> Kepengurusan RW 12
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight">Pengurus RT</h1>
            <p class="mt-3 text-slate-600 text-base md:text-lg">
                Struktur kepengurusan RT<?php echo e($tahunMulai ? ' masa bakti ' . $tahunMulai . ' - ' . ($tahunSelesai ?: 'Sekarang') : ''); ?>

            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8 md:py-14">
    <?php if($grouped->isEmpty()): ?>
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="users" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada data pengurus RT</p>
        <p class="text-slate-400 text-sm mt-1">Data akan ditampilkan setelah pengurus RT dilengkapi melalui menu Pengurus.</p>
    </div>
    <?php else: ?>
        <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rt => $pengurus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="mb-12 md:mb-14">
            <div class="flex items-center gap-4 mb-6 md:mb-8">
                <div class="flex-1 h-px bg-slate-200"></div>
                <span class="px-4 py-1.5 rounded-full bg-rose-600 text-white text-sm font-bold shadow-sm">RT <?php echo e($rt); ?></span>
                <div class="flex-1 h-px bg-slate-200"></div>
            </div>

            <!-- Mobile: Horizontal list -->
            <div class="md:hidden space-y-3 max-w-3xl mx-auto">
                <?php $__currentLoopData = $pengurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
            <div class="hidden md:grid grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <?php $__currentLoopData = $pengurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    <?php if($p->foto): ?>
                    <img src="<?php echo e(asset('storage/'.$p->foto)); ?>" class="w-28 h-28 object-cover rounded-full mx-auto mb-4 border-4 border-white shadow-lg">
                    <?php else: ?>
                    <div class="w-28 h-28 bg-gradient-to-br from-rose-100 to-rose-50 rounded-full mx-auto mb-4 flex items-center justify-center border-4 border-white shadow-lg">
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
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views/public/pengurus-rt.blade.php ENDPATH**/ ?>