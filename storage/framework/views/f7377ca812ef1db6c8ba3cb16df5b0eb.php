<?php $__env->startSection('title', 'Profil'); ?>
<?php $__env->startSection('meta_description', 'Profil Puri Agung Permai RW12 - Letak geografis, visi dan misi lingkungan di Kelurahan Gelam Jaya, Pasar Kemis, Tangerang.'); ?>
<?php $__env->startSection('og_title', 'Profil - Puri Agung Permai RW12'); ?>
<?php $__env->startSection('og_description', 'Profil Puri Agung Permai RW12 - Letak geografis, visi dan misi lingkungan.'); ?>

<?php $__env->startSection('content'); ?>
<div class="rw-page-head">
    <div class="max-w-7xl mx-auto px-4 py-14 md:py-20">
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900">Profil</h1>
        <p class="mt-3 text-slate-500 text-base md:text-lg">Letak geografis serta visi dan misi</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-14 space-y-16">
    <section>
        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-8">Letak Geografis</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
            <div class="space-y-4 text-slate-600 leading-relaxed">
                <p>Kawasan RW 12 terletak di Kelurahan Gelam Jaya, Kecamatan Pasar Kemis, Kabupaten Tangerang, Banten. Terbentang di lahan seluas 12 hektar, mulai dari blok A hingga blok G. Kawasan ini ditentukan oleh batas-batas geografis tertentu.</p>
                <p>Di sisi Utara dibatasi oleh Jl. Gelam Jaya. Di sisi Timur dibatasi oleh Jl. Pasar Kemis Raya. Di sisi Barat dibatasi oleh Jl. Raya Serpong.</p>
                <p>Kawasan RW 12 merupakan kawasan hunian yang terdiri atas 7 RT, dilengkapi fasilitas umum seperti lapangan olahraga, pos keamanan, serta sarana ibadah yang dikelola bersama warga.</p>
            </div>
            <div class="aspect-video rounded-md overflow-hidden border border-slate-200">
                <iframe 
                    src="https://maps.google.com/maps?q=-6.1579242,106.5796569&t=&z=17&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="100%" 
                    style="border:0; min-height: 300px;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </section>

    <section>
        <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-8">Visi dan Misi</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-stretch">
            <div class="rw-card p-6 md:p-8 space-y-5">
                <h3 class="text-xl font-bold text-slate-900">Visi</h3>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Menciptakan lingkungan yang sehat, hijau, aman, tertib, asri dan serasi.</p>
                </div>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Melakukan digitalisasi pelayanan kepada warga sebagai pilihan alternatif, seiring dengan perkembangan zaman.</p>
                </div>
            </div>

            <div class="rw-card p-6 md:p-8 space-y-5">
                <h3 class="text-xl font-bold text-slate-900">Misi</h3>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Pengelolaan kebersihan lingkungan secara mandiri yang dilakukan setiap hari.</p>
                </div>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Pemasangan CCTV di titik-titik strategis untuk memudahkan pemantauan keamanan wilayah.</p>
                </div>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Pengembangan aplikasi untuk memenuhi kebutuhan warga akan pelayanan dan informasi.</p>
                </div>
            </div>
        </div>
    </section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.public', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\david\Downloads\web-rw12\web-rw12\web-rw12\resources\views/public/profil.blade.php ENDPATH**/ ?>