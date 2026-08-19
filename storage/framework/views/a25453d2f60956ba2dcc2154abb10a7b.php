<?php $__env->startSection('title', 'Berita'); ?>

<?php $__env->startSection('content'); ?>
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Berita</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola pengumuman dan kegiatan warga dalam satu halaman</p>
    </div>
    <div class="mt-4 sm:mt-0 flex items-center gap-2">
        <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Pengumuman
        </a>
        <a href="<?php echo e(route('admin.kegiatan.create')); ?>" class="btn-secondary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Kegiatan
        </a>
    </div>
</div>

<form method="GET" class="mb-6">
    <div class="flex gap-2">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari pengumuman atau kegiatan..." class="input-field pl-10">
        </div>
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

<?php if($berita->count() > 0): ?>
<div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Judul</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden md:table-cell">Tanggal</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5">
                        <div class="flex items-center gap-2 mb-1">
                            <?php if($b['tipe'] === 'pengumuman'): ?>
                            <span class="badge bg-rose-50 text-rose-700">Pengumuman</span>
                            <?php else: ?>
                            <span class="badge bg-violet-50 text-violet-700">Kegiatan</span>
                            <?php endif; ?>
                        </div>
                        <p class="text-sm font-medium text-slate-900"><?php echo e($b['judul']); ?></p>
                        <p class="text-xs text-slate-500 md:hidden"><?php echo e(\Carbon\Carbon::parse($b['tanggal'])->isoFormat('D MMMM Y')); ?></p>
                    </td>
                    <td class="px-4 py-3.5">
                        <?php if($b['tipe'] === 'pengumuman'): ?>
                        <span class="badge <?php echo e($b['status'] === 'aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600'); ?>">
                            <span class="badge-dot <?php echo e($b['status'] === 'aktif' ? 'bg-emerald-500' : 'bg-slate-400'); ?>"></span>
                            <?php echo e(ucfirst($b['status'])); ?>

                        </span>
                        <?php else: ?>
                        <?php $statusBadge = match($b['status']) {
                            'selesai' => 'bg-emerald-50 text-emerald-700',
                            'dibatalkan' => 'bg-red-50 text-red-600',
                            default => 'bg-rose-50 text-rose-700',
                        }; ?>
                        <span class="badge <?php echo e($statusBadge); ?>">
                            <span class="badge-dot <?php echo e($b['status'] === 'selesai' ? 'bg-emerald-500' : ($b['status'] === 'dibatalkan' ? 'bg-red-500' : 'bg-rose-500')); ?>"></span>
                            <?php echo e(ucwords(str_replace('_', ' ', $b['status']))); ?>

                        </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-700 hidden md:table-cell">
                        <?php echo e(\Carbon\Carbon::parse($b['tanggal'])->isoFormat('D MMMM Y')); ?>

                        <?php if($b['tipe'] === 'kegiatan' && $b['waktu']): ?>
                        <span class="text-slate-400">· <?php echo e(\Carbon\Carbon::parse($b['waktu'])->format('H.i')); ?> WIB</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-right">
                        <div class="flex items-center justify-end gap-1">
                            <?php if($b['tipe'] === 'pengumuman'): ?>
                            <a href="<?php echo e(route('admin.pengumuman.show', $b['id'])); ?>" class="btn-soft-blue">Detail</a>
                            <a href="<?php echo e(route('admin.pengumuman.edit', $b['id'])); ?>" class="btn-soft-yellow">Edit</a>
                            <form action="<?php echo e(route('admin.pengumuman.destroy', $b['id'])); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-soft-red">Hapus</button>
                            </form>
                            <?php else: ?>
                            <a href="<?php echo e(route('admin.kegiatan.show', $b['id'])); ?>" class="btn-soft-blue">Detail</a>
                            <a href="<?php echo e(route('admin.kegiatan.edit', $b['id'])); ?>" class="btn-soft-yellow">Edit</a>
                            <form action="<?php echo e(route('admin.kegiatan.destroy', $b['id'])); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn-soft-red">Hapus</button>
                            </form>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>

<div class="sm:hidden space-y-3">
    <?php $__currentLoopData = $berita; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-2xl border border-slate-100 p-4">
        <div class="flex items-start justify-between mb-2">
            <div class="flex-1 min-w-0 mr-2">
                <div class="mb-1">
                    <?php if($b['tipe'] === 'pengumuman'): ?>
                    <span class="badge bg-rose-50 text-rose-700">Pengumuman</span>
                    <?php else: ?>
                    <span class="badge bg-violet-50 text-violet-700">Kegiatan</span>
                    <?php endif; ?>
                </div>
                <p class="text-sm font-semibold text-slate-900 truncate"><?php echo e($b['judul']); ?></p>
                <p class="text-xs text-slate-500"><?php echo e(\Carbon\Carbon::parse($b['tanggal'])->isoFormat('D MMMM Y')); ?></p>
            </div>
            <?php if($b['tipe'] === 'pengumuman'): ?>
            <span class="badge flex-shrink-0 <?php echo e($b['status'] === 'aktif' ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-600'); ?>">
                <span class="badge-dot <?php echo e($b['status'] === 'aktif' ? 'bg-emerald-500' : 'bg-slate-400'); ?>"></span>
                <?php echo e(ucfirst($b['status'])); ?>

            </span>
            <?php else: ?>
            <?php $statusBadge = match($b['status']) {
                'selesai' => 'bg-emerald-50 text-emerald-700',
                'dibatalkan' => 'bg-red-50 text-red-600',
                default => 'bg-rose-50 text-rose-700',
            }; ?>
            <span class="badge flex-shrink-0 <?php echo e($statusBadge); ?>">
                <span class="badge-dot <?php echo e($b['status'] === 'selesai' ? 'bg-emerald-500' : ($b['status'] === 'dibatalkan' ? 'bg-red-500' : 'bg-rose-500')); ?>"></span>
                <?php echo e(ucwords(str_replace('_', ' ', $b['status']))); ?>

            </span>
            <?php endif; ?>
        </div>
        <p class="text-xs text-slate-500 line-clamp-2 mb-3"><?php echo e(strip_tags($b['konten'])); ?></p>
        <div class="flex items-center gap-1.5 pt-2 border-t border-slate-100">
            <?php if($b['tipe'] === 'pengumuman'): ?>
            <a href="<?php echo e(route('admin.pengumuman.show', $b['id'])); ?>" class="btn-soft-blue">Detail</a>
            <a href="<?php echo e(route('admin.pengumuman.edit', $b['id'])); ?>" class="btn-soft-yellow">Edit</a>
            <form action="<?php echo e(route('admin.pengumuman.destroy', $b['id'])); ?>" method="POST" class="inline ml-auto" onsubmit="return confirm('Yakin ingin menghapus pengumuman ini?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn-soft-red">Hapus</button>
            </form>
            <?php else: ?>
            <a href="<?php echo e(route('admin.kegiatan.show', $b['id'])); ?>" class="btn-soft-blue">Detail</a>
            <a href="<?php echo e(route('admin.kegiatan.edit', $b['id'])); ?>" class="btn-soft-yellow">Edit</a>
            <form action="<?php echo e(route('admin.kegiatan.destroy', $b['id'])); ?>" method="POST" class="inline ml-auto" onsubmit="return confirm('Yakin ingin menghapus kegiatan ini?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn-soft-red">Hapus</button>
            </form>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="megaphone" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada berita</p>
    <p class="text-slate-400 text-sm mt-1 mb-5">Mulai dengan menambahkan pengumuman atau kegiatan pertama.</p>
    <div class="flex items-center justify-center gap-2">
        <a href="<?php echo e(route('admin.pengumuman.create')); ?>" class="btn-primary">Tambah Pengumuman</a>
        <a href="<?php echo e(route('admin.kegiatan.create')); ?>" class="btn-secondary">Tambah Kegiatan</a>
    </div>
</div>
<?php endif; ?>

<?php if($berita->hasPages()): ?>
<div class="mt-4 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan <?php echo e($berita->firstItem()); ?> - <?php echo e($berita->lastItem()); ?> dari <?php echo e($berita->total()); ?> data</p>
    <?php echo e($berita->onEachSide(1)->links()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\berita\index.blade.php ENDPATH**/ ?>