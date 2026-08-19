<?php $__env->startSection('title', 'UMKM'); ?>

<?php $__env->startSection('content'); ?>
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">UMKM</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola data Usaha Mikro Kecil dan Menengah warga</p>
    </div>
    <div class="mt-4 sm:mt-0 flex items-center gap-2">
        <a href="<?php echo e(route('admin.umkm.index')); ?>" class="btn-secondary text-xs">Semua</a>
        <a href="<?php echo e(route('admin.umkm.create')); ?>" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah UMKM
        </a>
    </div>
</div>

<form method="GET" class="mb-6">
    <div class="flex flex-wrap gap-2">
        <div class="relative flex-1 min-w-[200px] max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama usaha atau pemilik..." class="input-field pl-10">
        </div>
        <select name="kategori" onchange="this.form.submit()" class="input-field w-auto">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = \App\Models\Umkm::$kategoriList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($kat); ?>" <?php if(request('kategori') == $kat): echo 'selected'; endif; ?>><?php echo e($kat); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

<?php if($umkm->count() > 0): ?>
<div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Usaha</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Pemilik</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">RT</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Status</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__currentLoopData = $umkm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5">
                        <div class="flex items-center gap-3">
                            <?php if($item->foto): ?>
                            <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->nama); ?>" class="w-10 h-10 rounded-lg object-cover">
                            <?php else: ?>
                            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="store" class="w-5 h-5 text-rose-400"></i>
                            </div>
                            <?php endif; ?>
                            <p class="text-sm font-medium text-slate-900"><?php echo e($item->nama); ?></p>
                        </div>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-700"><?php echo e($item->kategori); ?></td>
                    <td class="px-4 py-3.5 text-sm text-slate-700"><?php echo e($item->nama_pemilik); ?></td>
                    <td class="px-4 py-3.5 text-sm text-slate-700">RT <?php echo e($item->rt); ?></td>
                    <td class="px-4 py-3.5">
                        <span class="inline-flex items-center gap-1 text-xs font-medium px-2 py-0.5 rounded-full <?php echo e($item->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'); ?>">
                            <span class="w-1.5 h-1.5 rounded-full <?php echo e($item->is_active ? 'bg-emerald-500' : 'bg-slate-400'); ?>"></span>
                            <?php echo e($item->is_active ? 'Aktif' : 'Nonaktif'); ?>

                        </span>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="<?php echo e(route('admin.umkm.show', $item->id)); ?>" class="btn-soft-blue">Detail</a>
                            <a href="<?php echo e(route('admin.umkm.edit', $item->id)); ?>" class="btn-soft-yellow">Edit</a>
                            <form action="<?php echo e(route('admin.umkm.destroy', $item->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
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
    <?php $__currentLoopData = $umkm; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="bg-white rounded-2xl border border-slate-100 p-4">
        <div class="flex items-start gap-3 mb-2">
            <?php if($item->foto): ?>
            <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->nama); ?>" class="w-12 h-12 rounded-lg object-cover flex-shrink-0">
            <?php else: ?>
            <div class="w-12 h-12 rounded-lg bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center flex-shrink-0">
                <i data-lucide="store" class="w-6 h-6 text-rose-400"></i>
            </div>
            <?php endif; ?>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-900"><?php echo e($item->nama); ?></p>
                <p class="text-xs text-slate-500"><?php echo e($item->kategori); ?> · RT <?php echo e($item->rt); ?></p>
            </div>
            <span class="inline-flex items-center gap-1 text-[10px] font-medium px-2 py-0.5 rounded-full <?php echo e($item->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'); ?>">
                <?php echo e($item->is_active ? 'Aktif' : 'Nonaktif'); ?>

            </span>
        </div>
        <p class="text-xs text-slate-500 mb-3">Pemilik: <?php echo e($item->nama_pemilik); ?></p>
        <div class="flex items-center gap-1.5 pt-2 border-t border-slate-100">
            <a href="<?php echo e(route('admin.umkm.show', $item->id)); ?>" class="btn-soft-blue">Detail</a>
            <a href="<?php echo e(route('admin.umkm.edit', $item->id)); ?>" class="btn-soft-yellow">Edit</a>
            <form action="<?php echo e(route('admin.umkm.destroy', $item->id)); ?>" method="POST" class="inline ml-auto" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn-soft-red">Hapus</button>
            </form>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php else: ?>
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="store" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada UMKM</p>
    <p class="text-slate-400 text-sm mt-1 mb-5">Mulai dengan menambahkan data UMKM warga.</p>
    <a href="<?php echo e(route('admin.umkm.create')); ?>" class="btn-primary">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Tambah UMKM
    </a>
</div>
<?php endif; ?>

<?php if($umkm->hasPages()): ?>
<div class="mt-4 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan <?php echo e($umkm->firstItem()); ?> - <?php echo e($umkm->lastItem()); ?> dari <?php echo e($umkm->total()); ?> data</p>
    <?php echo e($umkm->onEachSide(1)->links()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\umkm\index.blade.php ENDPATH**/ ?>