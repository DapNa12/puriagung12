<?php $__env->startSection('title', 'Log Aktivitas'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Log Aktivitas</h1>
    <p class="text-sm text-slate-500 mt-0.5">Catatan seluruh aktivitas perubahan data di panel admin</p>
</div>

<form method="GET" class="mb-6">
    <div class="flex flex-wrap gap-2">
        <div class="relative flex-1 min-w-[200px] max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama data atau deskripsi..." class="input-field pl-10">
        </div>
        <select name="action" onchange="this.form.submit()" class="input-field w-auto min-w-[120px]">
            <option value="">Semua Aksi</option>
            <option value="create" <?php echo e(request('action') === 'create' ? 'selected' : ''); ?>>Dibuat</option>
            <option value="update" <?php echo e(request('action') === 'update' ? 'selected' : ''); ?>>Diperbarui</option>
            <option value="delete" <?php echo e(request('action') === 'delete' ? 'selected' : ''); ?>>Dihapus</option>
        </select>
        <select name="model" onchange="this.form.submit()" class="input-field w-auto min-w-[130px]">
            <option value="">Semua Model</option>
            <?php $__currentLoopData = $modelTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($m); ?>" <?php echo e(request('model') === $m ? 'selected' : ''); ?>><?php echo e($m); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="user" onchange="this.form.submit()" class="input-field w-auto min-w-[130px]">
            <option value="">Semua User</option>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <option value="<?php echo e($u->id); ?>" <?php echo e(request('user') == $u->id ? 'selected' : ''); ?>><?php echo e($u->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input type="date" name="dari" value="<?php echo e(request('dari')); ?>" class="input-field w-auto" onchange="this.form.submit()">
        <input type="date" name="sampai" value="<?php echo e(request('sampai')); ?>" class="input-field w-auto" onchange="this.form.submit()">
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

<?php if($logs->count() > 0): ?>
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">User</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Model</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Data</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                <?php $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5 text-sm text-slate-500 whitespace-nowrap"><?php echo e($log->created_at->diffForHumans()); ?></td>
                    <td class="px-4 py-3.5">
                        <p class="text-sm font-medium text-slate-900"><?php echo e($log->user->name); ?></p>
                        <p class="text-xs text-slate-500 capitalize sm:hidden"><?php echo e($log->user->role); ?></p>
                    </td>
                    <td class="px-4 py-3.5">
                        <?php if($log->action === 'create'): ?>
                        <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="badge-dot bg-emerald-500"></span>
                            Dibuat
                        </span>
                        <?php elseif($log->action === 'update'): ?>
                        <span class="badge bg-amber-50 text-amber-700 border border-amber-200">
                            <span class="badge-dot bg-amber-500"></span>
                            Diperbarui
                        </span>
                        <?php else: ?>
                        <span class="badge bg-red-50 text-red-700 border border-red-200">
                            <span class="badge-dot bg-red-500"></span>
                            Dihapus
                        </span>
                        <?php endif; ?>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-500 hidden sm:table-cell"><?php echo e($log->model_type); ?></td>
                    <td class="px-4 py-3.5">
                        <p class="text-sm text-slate-900 max-w-[300px] truncate" title="<?php echo e($log->model_name); ?>"><?php echo e($log->model_name); ?></p>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-right">
                        <a href="<?php echo e(route('admin.activity-log.show', $log->id)); ?>" class="btn-soft-blue">Detail</a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php else: ?>
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="clock" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada log aktivitas</p>
    <p class="text-slate-400 text-sm mt-1">Log akan muncul setelah ada aktivitas perubahan data.</p>
</div>
<?php endif; ?>

<?php if($logs->hasPages()): ?>
<div class="mt-4 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan <?php echo e($logs->firstItem()); ?> - <?php echo e($logs->lastItem()); ?> dari <?php echo e($logs->total()); ?> data</p>
    <?php echo e($logs->onEachSide(1)->links()); ?>

</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\admin\activity-log\index.blade.php ENDPATH**/ ?>