<?php $__env->startSection('title', $umkm->nama); ?>

<?php $__env->startSection('content'); ?>
<div class="flex items-center gap-4 mb-6">
    <a href="<?php echo e(route('admin.umkm.index')); ?>" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div class="flex-1">
        <h1 class="text-2xl font-bold text-slate-900"><?php echo e($umkm->nama); ?></h1>
        <p class="text-sm text-slate-500"><?php echo e($umkm->kategori); ?></p>
    </div>
    <div class="flex items-center gap-2">
        <a href="<?php echo e(route('admin.umkm.edit', $umkm->id)); ?>" class="btn-secondary">
            <i data-lucide="pencil" class="w-4 h-4"></i> Edit
        </a>
        <form action="<?php echo e(route('admin.umkm.destroy', $umkm->id)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
            <button type="submit" class="btn-soft-red">
                <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
            </button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Informasi Usaha</h2>
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Usaha</dt>
                    <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->nama); ?></dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Kategori</dt>
                    <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->kategori); ?></dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pemilik</dt>
                    <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->nama_pemilik); ?></dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">RT</dt>
                    <dd class="text-sm text-slate-900 mt-1">RT <?php echo e($umkm->rt); ?></dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">No. HP / WhatsApp</dt>
                    <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->no_hp); ?></dd>
                </div>
                <div>
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Jam Operasional</dt>
                    <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->jam_operasional ?? '-'); ?></dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Alamat</dt>
                    <dd class="text-sm text-slate-900 mt-1"><?php echo e($umkm->alamat); ?></dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Deskripsi</dt>
                    <dd class="text-sm text-slate-700 mt-1 leading-relaxed"><?php echo e($umkm->deskripsi); ?></dd>
                </div>
                <?php if($umkm->maps_link): ?>
                <div class="sm:col-span-2">
                    <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Google Maps</dt>
                    <dd class="mt-1">
                        <a href="<?php echo e($umkm->maps_link); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1 text-sm text-rose-600 hover:text-rose-700">
                            <i data-lucide="map-pin" class="w-4 h-4"></i> Lihat di Maps
                        </a>
                    </dd>
                </div>
                <?php endif; ?>
            </dl>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Status</h2>
            <div class="space-y-3">
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Status</span>
                    <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full <?php echo e($umkm->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-slate-100 text-slate-500'); ?>">
                        <span class="w-1.5 h-1.5 rounded-full <?php echo e($umkm->is_active ? 'bg-emerald-500' : 'bg-slate-400'); ?>"></span>
                        <?php echo e($umkm->is_active ? 'Aktif' : 'Nonaktif'); ?>

                    </span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Dibuat</span>
                    <span class="text-sm text-slate-900"><?php echo e($umkm->created_at->isoFormat('D MMMM Y')); ?></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm text-slate-600">Diperbarui</span>
                    <span class="text-sm text-slate-900"><?php echo e($umkm->updated_at->isoFormat('D MMMM Y')); ?></span>
                </div>
            </div>
        </div>

        <?php if($umkm->foto): ?>
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
            <h2 class="text-lg font-bold text-slate-900 mb-4">Foto</h2>
            <img src="<?php echo e(asset('storage/'.$umkm->foto)); ?>" alt="<?php echo e($umkm->nama); ?>" class="w-full rounded-xl object-cover">
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\umkm\show.blade.php ENDPATH**/ ?>