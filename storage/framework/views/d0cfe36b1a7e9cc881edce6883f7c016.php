<?php $__env->startSection('title', 'Statistik Kependudukan'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Statistik Kependudukan</h1>
        <p class="text-sm text-slate-500 mt-0.5">Input data statistik warga per RT. Tidak perlu nama & NIK — cukup isi jumlah per kategori.</p>
    </div>
    <a href="<?php echo e(route('statistik')); ?>" target="_blank" class="btn-secondary text-xs whitespace-nowrap">Lihat Halaman Publik</a>
</div>

<div class="bg-white rounded-2xl border border-slate-200 p-5 mb-8 shadow-sm">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h3 class="text-base font-bold text-slate-900">Jumlah Rumah &amp; Bangunan</h3>
            <p class="text-xs text-slate-500 mt-0.5">Update jumlah rumah &amp; bangunan yang tampil live di halaman publik.</p>
        </div>
        <form action="<?php echo e(route('admin.statistik-rw.update')); ?>" method="POST" class="flex items-center gap-3">
            <?php echo csrf_field(); ?>
            <div>
                <input type="number" name="jumlah_rumah_bangunan" value="<?php echo e(old('jumlah_rumah_bangunan', $statistikRw->jumlah_rumah_bangunan ?? 0)); ?>" class="input-field py-2 text-sm w-44" min="0" placeholder="Jumlah rumah">
            </div>
            <button type="submit" class="px-4 py-2 bg-rose-600 hover:bg-rose-700 text-white rounded-xl text-xs font-bold transition-all shadow-sm">Simpan Jumlah Rumah</button>
        </form>
    </div>
</div>

<div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">
    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
        <div class="flex items-center justify-between mb-5">
            <div>
                <h2 class="text-lg font-bold text-slate-900" id="form-title">Tambah Data Statistik</h2>
                <p class="text-xs text-slate-500 mt-0.5">Total warga dihitung otomatis (Laki + Perempuan).</p>
            </div>
            <span class="text-right">
                <span class="text-[10px] uppercase tracking-wider text-slate-400 font-semibold">Total Warga</span>
                <span id="total-display" class="block text-3xl font-black text-rose-600 leading-none mt-1">0</span>
            </span>
        </div>

        <form id="statistik-form" action="<?php echo e(route('admin.statistik.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="_method" value="POST" id="form-method">
            <input type="hidden" name="statistik_id" id="statistik-id" value="">

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-1">Wilayah RT <span class="text-red-500">*</span></label>
                <input type="text" name="rt" id="field-rt" list="daftar-rt" maxlength="3" value="<?php echo e(old('rt')); ?>" placeholder="Contoh: 001" class="input-field <?php $__errorArgs = ['rt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> input-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                <datalist id="daftar-rt">
                    <?php $__currentLoopData = $daftarRt; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rtItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($rtItem); ?>">RT <?php echo e($rtItem); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </datalist>
                <?php $__errorArgs = ['rt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <?php
                $fields = [
                    'jenis_kelamin' => [
                        'title' => 'Jenis Kelamin',
                        'items' => [['laki', 'Laki-laki'], ['perempuan', 'Perempuan']],
                    ],
                    'usia' => [
                        'title' => 'Kelompok Usia',
                        'items' => [['balita', 'Balita (0-4)'], ['anak', 'Anak (5-14)'], ['remaja', 'Remaja (15-24)'], ['dewasa', 'Dewasa (25-59)'], ['lansia', 'Lansia (60+)']],
                    ],
                    'agama' => [
                        'title' => 'Agama',
                        'items' => [['islam', 'Islam'], ['kristen', 'Kristen'], ['katolik', 'Katolik'], ['budha', 'Budha'], ['hindu', 'Hindu'], ['lainnya', 'Lainnya']],
                    ],
                    'pendidikan' => [
                        'title' => 'Pendidikan',
                        'items' => [['belum_sekolah', 'Belum Sekolah'], ['sd', 'SD'], ['smp', 'SMP'], ['sma', 'SMA'], ['d1', 'D1'], ['d2', 'D2'], ['d3', 'D3'], ['s1', 'S1'], ['s2', 'S2'], ['s3', 'S3']],
                    ],
                    'goldar' => [
                        'title' => 'Golongan Darah',
                        'items' => [['goldar_a', 'A'], ['goldar_b', 'B'], ['goldar_ab', 'AB'], ['goldar_o', 'O']],
                    ],
                ];

                $fieldNames = [];
                foreach ($fields as $group) {
                    foreach ($group['items'] as [$name, $label]) {
                        $fieldNames[] = $name;
                    }
                }
                $fieldNames = array_values(array_unique($fieldNames));
            ?>

            <?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="mb-5">
                    <p class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2"><?php echo e($group['title']); ?></p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                        <?php $__currentLoopData = $group['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$name, $label]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <label class="block text-xs font-medium text-slate-600 mb-1"><?php echo e($label); ?></label>
                                <input type="number" name="<?php echo e($name); ?>" id="field-<?php echo e($name); ?>" value="<?php echo e(old($name, 0)); ?>" min="0" class="input-field py-2 stat-count <?php if(in_array($name, ['laki', 'perempuan'])): ?> stat-gender <?php endif; ?>">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div class="flex items-center gap-3">
                <button type="submit" class="btn-primary px-6">Simpan</button>
                <button type="button" id="reset-form" class="btn-secondary px-6 hidden">Batal Edit</button>
            </div>
        </form>
    </div>

    
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="px-6 py-5 border-b border-slate-100">
            <h2 class="text-lg font-bold text-slate-900">Data Tersimpan per RT</h2>
            <p class="text-xs text-slate-500 mt-0.5">Klik Edit untuk mengubah data, atau Hapus untuk menghapus.</p>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-100">
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">RT</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Laki</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Perempuan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Total</th>
                        <th class="px-4 py-3 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    <?php $__empty_1 = true; $__currentLoopData = $statistik; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-4 py-3 font-bold text-slate-900">RT <?php echo e(sprintf('%02d', $row->rt)); ?></td>
                        <td class="px-4 py-3 text-slate-700"><?php echo e($row->laki); ?></td>
                        <td class="px-4 py-3 text-slate-700"><?php echo e($row->perempuan); ?></td>
                        <td class="px-4 py-3 font-extrabold text-rose-600"><?php echo e($row->total); ?></td>
                        <td class="px-4 py-3">
                            <div class="flex items-center justify-end gap-1.5">
                                <button type="button" onclick="fillEdit(<?php echo \Illuminate\Support\Js::from($row)->toHtml() ?>)" class="btn-soft-yellow">Edit</button>
                                <form action="<?php echo e(route('admin.statistik.destroy', $row)); ?>" method="POST" onsubmit="return confirm('Yakin ingin menghapus statistik RT <?php echo e($row->rt); ?>?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-soft-red">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="px-4 py-12 text-center">
                            <p class="text-slate-400 font-medium">Belum ada data statistik.</p>
                            <p class="text-slate-400 text-sm mt-1">Pilih RT dan isi jumlah warga per kategori di form.</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    const fieldNames = <?php echo json_encode($fieldNames, 15, 512) ?>;

    function recalcTotal() {
        const laki = parseInt(document.getElementById('field-laki').value) || 0;
        const perempuan = parseInt(document.getElementById('field-perempuan').value) || 0;
        document.getElementById('total-display').textContent = laki + perempuan;
    }

    function fillEdit(row) {
        document.getElementById('form-title').textContent = 'Edit Statistik RT ' + row.rt;
        document.getElementById('form-method').value = 'PUT';
        document.getElementById('statistik-id').value = row.id;
        document.getElementById('statistik-form').action = "<?php echo e(route('admin.statistik.update', ['statistik' => '__ID__'])); ?>".replace('__ID__', row.id);
        document.getElementById('field-rt').value = row.rt;
        document.getElementById('field-rt').disabled = true;
        fieldNames.forEach(name => {
            document.getElementById('field-' + name).value = row[name] ?? 0;
        });
        document.getElementById('reset-form').classList.remove('hidden');
        recalcTotal();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function resetForm() {
        document.getElementById('form-title').textContent = 'Tambah Data Statistik';
        document.getElementById('form-method').value = 'POST';
        document.getElementById('statistik-id').value = '';
        document.getElementById('statistik-form').action = "<?php echo e(route('admin.statistik.store')); ?>";
        document.getElementById('field-rt').disabled = false;
        document.getElementById('field-rt').value = '';
        fieldNames.forEach(name => {
            document.getElementById('field-' + name).value = 0;
        });
        document.getElementById('reset-form').classList.add('hidden');
        recalcTotal();
    }

    document.addEventListener('DOMContentLoaded', function() {
        fieldNames.forEach(name => {
            const el = document.getElementById('field-' + name);
            if (el) el.addEventListener('input', recalcTotal);
        });
        recalcTotal();
    });

    document.getElementById('reset-form').addEventListener('click', resetForm);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views/admin/statistik/index.blade.php ENDPATH**/ ?>