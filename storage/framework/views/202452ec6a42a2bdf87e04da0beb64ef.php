<?php $__env->startSection('title', 'Pengurus'); ?>

<?php $__env->startSection('content'); ?>
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Pengurus</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola struktur kepengurusan RT &amp; RW</p>
    </div>
    <div class="mt-4 sm:mt-0 flex items-center gap-2">
        <a href="<?php echo e(route('admin.pengurus.index')); ?>" class="btn-secondary text-xs">Semua</a>
        <a href="<?php echo e(route('admin.pengurus.create')); ?>" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Pengurus
        </a>
    </div>
</div>

<form method="GET" class="mb-6">
    <div class="flex gap-2">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari jabatan atau nama..." class="input-field pl-10">
        </div>
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

<?php if($pengurus->count() > 0): ?>
<div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">RT</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jabatan</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Periode</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__currentLoopData = $pengurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5">
                        <p class="text-sm font-medium text-slate-900"><?php echo e($item->nama ?? '-'); ?></p>
                        <p class="text-xs text-slate-500 sm:hidden"><?php echo e($item->rt ?? '-'); ?> · <?php echo e($item->jabatan); ?></p>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-700"><?php echo e($item->rt ? 'RT '.$item->rt : '-'); ?></td>
                    <td class="px-4 py-3.5 text-sm text-slate-700"><?php echo e($item->jabatan); ?></td>
                    <td class="px-4 py-3.5 text-sm text-slate-700 hidden sm:table-cell"><?php echo e(\Carbon\Carbon::parse($item->periode_mulai)->isoFormat('D MMMM Y')); ?> - <?php echo e($item->periode_selesai ? \Carbon\Carbon::parse($item->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang'); ?></td>
                    <td class="px-4 py-3.5 text-sm text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="<?php echo e(route('admin.pengurus.show', $item->id)); ?>" class="btn-soft-blue">Detail</a>
                            <a href="<?php echo e(route('admin.pengurus.edit', $item->id)); ?>" class="btn-soft-yellow">Edit</a>
                            <form action="<?php echo e(route('admin.pengurus.destroy', $item->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-soft-red">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<div class="sm:hidden space-y-3">
    <?php $__currentLoopData = $pengurus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-2xl border border-slate-100 p-4">
        <div class="flex items-start justify-between mb-2">
            <div class="flex-1 min-w-0 mr-2">
                <p class="text-sm font-semibold text-slate-900"><?php echo e($item->nama ?? '-'); ?></p>
                <p class="text-xs text-slate-500"><?php echo e($item->rt ? 'RT '.$item->rt.' · ' : ''); ?><?php echo e($item->jabatan); ?></p>
            </div>
        </div>
        <p class="text-xs text-slate-500 mb-3">Periode: <?php echo e(\Carbon\Carbon::parse($item->periode_mulai)->isoFormat('D MMMM Y')); ?> — <?php echo e($item->periode_selesai ? \Carbon\Carbon::parse($item->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang'); ?></p>
        <div class="flex items-center gap-1.5 pt-2 border-t border-slate-100 mt-2">
            <a href="<?php echo e(route('admin.pengurus.show', $item->id)); ?>" class="btn-soft-blue">Detail</a>
            <a href="<?php echo e(route('admin.pengurus.edit', $item->id)); ?>" class="btn-soft-yellow">Edit</a>
            <form action="<?php echo e(route('admin.pengurus.destroy', $item->id)); ?>" method="POST" class="inline ml-auto" onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn-soft-red">Hapus</button>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="users" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada pengurus</p>
    <p class="text-slate-400 text-sm mt-1 mb-5">Mulai dengan mengisi struktur kepengurusan RW.</p>
    <a href="<?php echo e(route('admin.pengurus.create')); ?>" class="btn-primary">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Tambah Pengurus
    </a>
</div>
<?php endif; ?>

<?php if($pengurus->hasPages()): ?>
<div class="mt-4 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan <?php echo e($pengurus->firstItem()); ?> - <?php echo e($pengurus->lastItem()); ?> dari <?php echo e($pengurus->total()); ?> data</p>
    <?php echo e($pengurus->onEachSide(1)->links()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\pengurus\index.blade.php ENDPATH**/ ?>