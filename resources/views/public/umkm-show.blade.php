@extends('layouts.public')

@section('title', $umkm->nama . ' - UMKM')
@section('meta_description', $umkm->deskripsi ? Str::limit(strip_tags($umkm->deskripsi), 160) : 'UMKM ' . $umkm->nama . ' di Puri Agung Permai RW12.')
@section('meta_keywords', strtolower($umkm->nama).', puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, umkm tangerang, usaha warga')
@section('og_title', $umkm->nama . ' - UMKM RW12')
@section('og_description', $umkm->deskripsi ? Str::limit(strip_tags($umkm->deskripsi), 160) : 'UMKM ' . $umkm->nama)

@section('content')
<!-- Breadcrumbs -->
<div class="bg-white border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-4">
        <nav class="flex items-center gap-2 text-xs text-slate-500" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-rose-600 transition-colors">Beranda</a>
            <i data-lucide="chevron-right" class="w-3 h-3" aria-hidden="true"></i>
            <a href="{{ route('umkm') }}" class="hover:text-rose-600 transition-colors">UMKM</a>
            <i data-lucide="chevron-right" class="w-3 h-3" aria-hidden="true"></i>
            <span class="text-slate-900 font-medium">{{ $umkm->nama }}</span>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 overflow-hidden shadow-sm">
                @if($umkm->foto)
                <div class="h-64 md:h-80 overflow-hidden">
                    <img src="{{ asset('storage/'.$umkm->foto) }}" alt="{{ $umkm->nama }}" class="w-full h-full object-cover">
                </div>
                @endif

                <div class="p-6 md:p-8">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <span class="inline-block px-3 py-1 bg-rose-100 text-rose-700 rounded-full text-xs font-semibold mb-3">
                                {{ $umkm->kategori }}
                            </span>
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-900">{{ $umkm->nama }}</h1>
                        </div>
                    </div>

                    <div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 mb-6">
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="user" class="w-4 h-4 text-rose-500"></i>
                            {{ $umkm->nama_pemilik }}
                        </span>
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="map-pin" class="w-4 h-4 text-rose-500"></i>
                            RT {{ $umkm->rt }}
                        </span>
                        @if($umkm->jam_operasional)
                        <span class="flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-4 h-4 text-rose-500"></i>
                            {{ $umkm->jam_operasional }}
                        </span>
                        @endif
                    </div>

                    <div class="prose prose-slate max-w-none">
                        {!! nl2br(e($umkm->deskripsi)) !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm">
                <h2 class="text-lg font-bold text-slate-900 mb-4">Informasi Kontak</h2>
                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Pemilik</dt>
                        <dd class="text-sm text-slate-900 mt-1">{{ $umkm->nama_pemilik }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Alamat</dt>
                        <dd class="text-sm text-slate-900 mt-1">{{ $umkm->alamat }}, RT {{ $umkm->rt }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">No. HP / WhatsApp</dt>
                        <dd class="mt-1">
                            <a href="https://wa.me/{{ ltrim($umkm->no_hp, '0') }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-sm text-emerald-600 hover:text-emerald-700 font-medium">
                                <i data-lucide="phone" class="w-4 h-4"></i>
                                {{ $umkm->no_hp }}
                            </a>
                        </dd>
                    </div>
                    @if($umkm->jam_operasional)
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Jam Operasional</dt>
                        <dd class="text-sm text-slate-900 mt-1">{{ $umkm->jam_operasional }}</dd>
                    </div>
                    @endif
                    @if($umkm->maps_link)
                    <div>
                        <dt class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Lokasi</dt>
                        <dd class="mt-1">
                            <a href="{{ $umkm->maps_link }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-sm text-rose-600 hover:text-rose-700 font-medium">
                                <i data-lucide="map" class="w-4 h-4"></i>
                                Lihat di Google Maps
                            </a>
                        </dd>
                    </div>
                    @endif
                </dl>
            </div>

            <a href="{{ route('umkm') }}" class="flex items-center justify-center gap-2 w-full px-4 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 rounded-xl text-sm font-semibold transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                Kembali ke Daftar UMKM
            </a>
        </div>
    </div>
</div>
@endsection