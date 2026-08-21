@extends('layouts.public')

@section('title', 'Profil')
@section('meta_description', 'Profil Puri Agung Permai RW12 - Letak geografis, visi dan misi lingkungan di Kelurahan Gelam Jaya, Pasar Kemis, Tangerang.')
@section('og_title', 'Profil - Puri Agung Permai RW12')
@section('og_description', 'Profil Puri Agung Permai RW12 - Letak geografis, visi dan misi lingkungan.')

@section('content')
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
                <p>Letak Geografis RW 12 Perum Puri Agung Permai Rw 12 terletak di kawasan Perum Puri Agung Permai, Kabupaten Tangerang, Banten, yang merupakan bagian dari kawasan penyangga Jakarta dengan akses transportasi yang cukup baik menuju Kota Tangerang, Kabupaten Tangerang, serta DKI Jakarta</p>
                <p>Secara geografis didominasi kawasan permukiman dengan topografi relatif datar yang mendukung aktivitas masyarakat dan pembangunan infrastruktur</p>
                <p>Di Wilayahnya terdapat fasilitas umu seperti tempat ibadah, sarana pendidikan, fasilitas kesehatan, area perdagangan, dan ruang terbuka yang menunjang kebutuhna warga. Posisi RW 12 yang strategis memudahkan mobilitas masyarakat dan mendukung kegiatan sosial, ekonomi, pendidikan, dan kemasyarakatan</p>
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

                    <p class="text-slate-600">Terwujudnya RW12 Perum Puri Agung Permai Sebagai lingkungan yang aman, nyaman, bersih, sehat, rukun, religius, dan berdaya melalui pelayanan yang trasnparan dan partisipatif demi kesejahteraan seluruh warga</p>
                </div>
            </div>

            <div class="rw-card p-6 md:p-8 space-y-5">
                <h3 class="text-xl font-bold text-slate-900">Misi</h3>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Meningkatkan kualitas pelayanan kepada warga secara cepat, ramah, transparan dan akuntabel.</p>
                </div>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Mewujudkan lingkunagn bersih, sehat, hijau dan tertata melalu budaya gotong royong dan kepedulian kebersihan.</p>
                </div>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Memperkuat keamanan dan ketertiban lingkungan bersama pengurus RT, RW, dan Warga</p>
                </div>
                                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Meningkatkan kerukunan dan kepedulian sosial antar warga tanpa membedakan latar belakang</p>
                </div>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Mendukung kegiatan keagamaan, kepemudaan, pendidikan, olahraga, serta pemberdayaan prempuan dan lansia untuk meningkatkan kualitas hidup</p>
                </div>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Mengembangkan kolaborasi dengan pemerintah dan lembaga kemasyarakatan untuk mendukung kemajuan RW12</p>
                </div>
                <div class="rw-list">
                    <span class="rw-list-icon">
                        <i data-lucide="check" class="w-4 h-4 text-slate-900"></i>
                    </span>
                    <p class="text-slate-600">Mendorong pemanfaatan teknologi informasi untuk penyampaian informasi dan pelayanan warga yang lebih efektif</p>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection
