<?php $__env->startSection('title', 'Pencarian'); ?>
<?php $__env->startSection('meta_description', 'Cari informasi seputar Puri Agung Permai RW12. Temukan berita, kegiatan, dan galeri.'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto mb-10">
        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Pencarian</h1>
        <form method="GET" action="<?php echo e(route('search')); ?>" class="relative">
            <input type="search" name="q" value="<?php echo e($query); ?>" placeholder="Cari berita, kegiatan, atau galeri..."
                   class="w-full bg-white border border-slate-200 rounded-2xl px-5 py-4 pl-12 text-base text-slate-800 focus:outline-none focus:border-rose-500 focus:ring-2 focus:ring-rose-200 transition-all shadow-sm"
                   autofocus>
            <i data-lucide="search" class="w-5 h-5 text-slate-400 absolute left-4 top-4.5"></i>
            <button type="submit" class="absolute right-3 top-2 bg-rose-600 text-white px-5 py-2 rounded-xl text-sm font-semibold hover:bg-rose-700 transition-colors">
                Cari
            </button>
        </form>
    </div>

    <?php if($query && strlen($query) < 2): ?>
    <div class="text-center py-12">
        <i data-lucide="alert-circle" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
        <p class="text-slate-500">Masukkan minimal 2 karakter untuk pencarian.</p>
    </div>
    <?php elseif($query): ?>
    <p class="text-sm text-slate-500 mb-8">
        Ditemukan <span class="font-bold text-slate-900"><?php echo e($totalResults); ?></span> hasil untuk
        "<span class="font-semibold text-rose-600"><?php echo e($query); ?></span>"
    </p>

    <?php if($pengumuman->count()): ?>
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-5">
            <i data-lucide="clipboard-list" class="w-5 h-5 text-rose-600"></i>
            <h2 class="text-xl font-bold text-slate-900">Berita dan Pengumuman</h2>
            <span class="bg-rose-100 text-rose-700 text-xs font-bold px-2 py-0.5 rounded-full"><?php echo e($pengumuman->count()); ?></span>
        </div>
        <div class="space-y-4">
            <?php $__currentLoopData = $pengumuman; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('pengumuman.show', $item)); ?>" class="block bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:border-rose-200 transition-all group">
                <div class="flex items-start gap-4">
                    <?php if($item->foto): ?>
                    <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->judul); ?>" class="w-20 h-20 rounded-lg object-cover shrink-0">
                    <?php else: ?>
                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center shrink-0">
                        <i data-lucide="file-text" class="w-8 h-8 text-rose-300"></i>
                    </div>
                    <?php endif; ?>
                    <div class="flex-1 min-w-0">
                        <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-1"><?php echo e($item->judul); ?></h3>
                        <p class="text-sm text-slate-500 mt-1 line-clamp-2"><?php echo e(Str::limit(strip_tags($item->isi), 120)); ?></p>
                        <span class="text-xs text-slate-400 mt-2 inline-block"><?php echo e($item->created_at->isoFormat('D MMMM Y')); ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if($kegiatan->count()): ?>
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-5">
            <i data-lucide="calendar-check" class="w-5 h-5 text-blue-600"></i>
            <h2 class="text-xl font-bold text-slate-900">Kegiatan</h2>
            <span class="bg-blue-100 text-blue-700 text-xs font-bold px-2 py-0.5 rounded-full"><?php echo e($kegiatan->count()); ?></span>
        </div>
        <div class="space-y-4">
            <?php $__currentLoopData = $kegiatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('kegiatan.show', $item)); ?>" class="block bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:border-rose-200 transition-all group">
                <div class="flex items-start gap-4">
                    <?php if($item->foto): ?>
                    <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->nama_kegiatan); ?>" class="w-20 h-20 rounded-lg object-cover shrink-0">
                    <?php else: ?>
                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center shrink-0">
                        <i data-lucide="calendar" class="w-8 h-8 text-blue-300"></i>
                    </div>
                    <?php endif; ?>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-1"><?php echo e($item->nama_kegiatan); ?></h3>
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full
                                <?php echo e($item->status === 'akan_datang' ? 'bg-blue-50 text-blue-700' : 'bg-emerald-50 text-emerald-700'); ?>">
                                <?php echo e($item->status === 'akan_datang' ? 'Akan Datang' : ucfirst($item->status)); ?>

                            </span>
                        </div>
                        <p class="text-sm text-slate-500"><?php echo e(\Carbon\Carbon::parse($item->tanggal)->isoFormat('D MMMM Y')); ?></p>
                        <?php if($item->tempat): ?>
                        <p class="text-xs text-slate-400 mt-1"><?php echo e($item->tempat); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if($albums->count()): ?>
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-5">
            <i data-lucide="image" class="w-5 h-5 text-emerald-600"></i>
            <h2 class="text-xl font-bold text-slate-900">Galeri</h2>
            <span class="bg-emerald-100 text-emerald-700 text-xs font-bold px-2 py-0.5 rounded-full"><?php echo e($albums->count()); ?></span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('galeri.show', $item->id)); ?>" class="block bg-white rounded-xl border border-slate-200 overflow-hidden hover:shadow-md hover:border-rose-200 transition-all group">
                <div class="h-36 bg-slate-100 relative overflow-hidden">
                    <?php if($item->cover): ?>
                    <img src="<?php echo e(asset('storage/'.$item->cover)); ?>" alt="<?php echo e($item->judul); ?>" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    <?php else: ?>
                    <div class="w-full h-full bg-gradient-to-br from-emerald-100 to-emerald-50 flex items-center justify-center">
                        <i data-lucide="image" class="w-10 h-10 text-emerald-300"></i>
                    </div>
                    <?php endif; ?>
                    <span class="absolute top-2 right-2 bg-black/60 text-white text-[10px] font-bold px-2 py-0.5 rounded-full"><?php echo e($item->fotos_count); ?> foto</span>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-1"><?php echo e($item->judul); ?></h3>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if(isset($umkmResults) && $umkmResults->count()): ?>
    <section class="mb-12">
        <div class="flex items-center gap-2 mb-5">
            <i data-lucide="store" class="w-5 h-5 text-purple-600"></i>
            <h2 class="text-xl font-bold text-slate-900">UMKM</h2>
            <span class="bg-purple-100 text-purple-700 text-xs font-bold px-2 py-0.5 rounded-full"><?php echo e($umkmResults->count()); ?></span>
        </div>
        <div class="space-y-4">
            <?php $__currentLoopData = $umkmResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('umkm.show', $item->slug)); ?>" class="block bg-white rounded-xl border border-slate-200 p-5 hover:shadow-md hover:border-rose-200 transition-all group">
                <div class="flex items-start gap-4">
                    <?php if($item->foto): ?>
                    <img src="<?php echo e(asset('storage/'.$item->foto)); ?>" alt="<?php echo e($item->nama); ?>" class="w-20 h-20 rounded-lg object-cover shrink-0">
                    <?php else: ?>
                    <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-purple-100 to-purple-50 flex items-center justify-center shrink-0">
                        <i data-lucide="store" class="w-8 h-8 text-purple-300"></i>
                    </div>
                    <?php endif; ?>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center gap-2 mb-1">
                            <h3 class="font-bold text-slate-900 group-hover:text-rose-600 transition-colors line-clamp-1"><?php echo e($item->nama); ?></h3>
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold px-2 py-0.5 rounded-full bg-purple-50 text-purple-700">
                                <?php echo e($item->kategori); ?>

                            </span>
                        </div>
                        <p class="text-sm text-slate-500 line-clamp-1"><?php echo e($item->nama_pemilik); ?> · RT <?php echo e($item->rt); ?></p>
                        <p class="text-xs text-slate-400 mt-1 line-clamp-1"><?php echo e(Str::limit($item->deskripsi, 100)); ?></p>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    <?php if($totalResults === 0): ?>
    <div class="text-center py-16">
        <i data-lucide="search-x" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <h3 class="text-lg font-bold text-slate-700 mb-1">Tidak ada hasil ditemukan</h3>
        <p class="text-slate-500 text-sm">Coba kata kunci yang berbeda atau periksa ejaan Anda.</p>
    </div>
    <?php endif; ?>

    <?php elseif(!empty($query)): ?>
    <div class="text-center py-16">
        <i data-lucide="search" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <h3 class="text-lg font-bold text-slate-700 mb-1">Ketik kata kunci untuk mulai mencari</h3>
        <p class="text-slate-500 text-sm">Temukan berita, kegiatan, dan galeri di Puri Agung Permai RW12.</p>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views\public\search.blade.php ENDPATH**/ ?>