@extends('layouts.public')

@section('title', 'Administrasi Kependudukan')
@section('meta_description', 'Layanan administrasi kependudukan di Puri Agung Permai RW12. Surat pengantar dan layanan warga lainnya.')
@section('og_title', 'Administrasi Kependudukan - Puri Agung Permai RW12')
@section('og_description', 'Layanan administrasi kependudukan di Puri Agung Permai RW12.')

@section('content')
<div class="rw-page-head">
    <div class="max-w-7xl mx-auto px-4 py-14 md:py-20">
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900">Administrasi Kependudukan</h1>
        <p class="mt-3 text-slate-500 text-base md:text-lg">Jenis pelayanan administrasi warga</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-14">
    <div class="rw-card p-6 md:p-8 mb-12">
        <p class="text-slate-600 leading-relaxed">Sekretariat RW 12 memberikan pelayanan mulai dari pembayaran iuran bulanan, iuran kebersihan, hingga pembuatan surat pengantar yang dibutuhkan warga untuk mengurus administrasi kependudukan.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Ahli Waris</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pengantar RT</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP Anggota Ahli Waris</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Kartu Keluarga</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Akta Kematian</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Akta Kelahiran</span></li>
            </ul>
        </div>

        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Akta Kelahiran</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pengantar RT</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP Orang Tua</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Kartu Keluarga</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Lahir dari Rumah Sakit/Puskesmas</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Akta Perkawinan</span></li>
            </ul>
        </div>

        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Akta Kematian</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pengantar RT</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP yang Meninggal</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP Pelapor (1 Orang)</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP Saksi (2 Orang)</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Bukti Meninggal dari Dokter/Rumah Sakit</span></li>
            </ul>
        </div>

        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Akta Perceraian</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pengantar RT</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Kartu Keluarga</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Bukti Cerai</span></li>
            </ul>
        </div>

        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Belum Memiliki Rumah</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pengantar RT</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Kartu Keluarga</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Formulir Belum Memiliki Rumah</span></li>
            </ul>
        </div>

        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Izin Domisili Alamat Tinggal</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pengantar RT</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP Pemilik Rumah</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Kartu Keluarga</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP yang Bersangkutan</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Formulir Pernyataan Izin Tinggal Domisili</span></li>
            </ul>
        </div>

        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Izin Usaha KUR</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pengantar RT</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Kartu Keluarga</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pernyataan Usaha di Atas Materai</span></li>
            </ul>
        </div>

        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Kartu Identitas Anak</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Surat Pengantar RT</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP Orang Tua</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Kartu Keluarga</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Akta Kelahiran Anak</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Pas Foto (Ukuran Kartu Pos)</span></li>
            </ul>
        </div>

        <div class="rw-card p-6">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Kartu Keluarga</h3>
            <ul class="space-y-3">
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi KTP</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Akta Perkawinan</span></li>
                <li class="rw-list"><span class="rw-list-icon"><i data-lucide="check" class="w-4 h-4 text-slate-900"></i></span><span class="text-sm text-slate-600">Fotokopi Akta Kelahiran</span></li>
            </ul>
        </div>
    </div>
</div>
@endsection
