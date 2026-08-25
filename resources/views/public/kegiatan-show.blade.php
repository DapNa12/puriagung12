@extends('layouts.public')

@section('title', $kegiatan->nama_kegiatan)
@section('meta_description', $kegiatan->deskripsi ?: $kegiatan->nama_kegiatan . ' - Kegiatan di Puri Agung Permai RW12.')
@section('meta_keywords', strtolower($kegiatan->nama_kegiatan).', puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, kegiatan warga rw 12, agenda rw 12')
@section('og_title', $kegiatan->nama_kegiatan . ' - Puri Agung Permai RW12')
@section('og_description', $kegiatan->deskripsi ?: $kegiatan->nama_kegiatan)
@if($kegiatan->foto)
@section('og_image', asset('storage/' . $kegiatan->foto))
@endif

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-rose-600 transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="{{ route('kegiatan') }}" class="hover:text-rose-600 transition-colors">Kegiatan</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-slate-700 font-medium truncate max-w-[200px]">{{ Str::limit($kegiatan->nama_kegiatan, 30) }}</span>
    </nav>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        @if($kegiatan->foto)
        <img src="{{ asset('storage/'.$kegiatan->foto) }}" alt="{{ $kegiatan->nama_kegiatan }}" class="w-full h-64 md:h-80 object-cover">
        @endif
        <div class="p-8 md:p-10">
            <div class="flex items-center gap-2 mb-4">
                <span class="inline-flex items-center gap-1 text-xs font-medium px-2.5 py-1 rounded-full
                    {{ $kegiatan->status === 'akan_datang' ? 'bg-blue-50 text-blue-700' : ($kegiatan->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
                    <span class="w-1.5 h-1.5 rounded-full {{ $kegiatan->status === 'akan_datang' ? 'bg-blue-500' : ($kegiatan->status === 'selesai' ? 'bg-emerald-500' : 'bg-red-500') }}"></span>
                    {{ $kegiatan->status === 'akan_datang' ? 'Akan Datang' : ucfirst($kegiatan->status) }}
                </span>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6">{{ $kegiatan->nama_kegiatan }}</h1>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="flex items-start gap-3 bg-slate-50 rounded-xl p-4">
                    <i data-lucide="calendar" class="w-5 h-5 text-rose-600 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-slate-500">Tanggal</p>
                        <p class="text-sm font-medium text-slate-900">{{ \Carbon\Carbon::parse($kegiatan->tanggal)->isoFormat('D MMMM Y') }}</p>
                    </div>
                </div>
                @if($kegiatan->waktu)
                <div class="flex items-start gap-3 bg-slate-50 rounded-xl p-4">
                    <i data-lucide="clock" class="w-5 h-5 text-rose-600 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-slate-500">Waktu</p>
                        <p class="text-sm font-medium text-slate-900">{{ $kegiatan->waktu_formatted }} WIB</p>
                    </div>
                </div>
                @endif
                @if($kegiatan->tempat)
                <div class="flex items-start gap-3 bg-slate-50 rounded-xl p-4">
                    <i data-lucide="map-pin" class="w-5 h-5 text-rose-600 mt-0.5 flex-shrink-0"></i>
                    <div>
                        <p class="text-xs text-slate-500">Tempat</p>
                        <p class="text-sm font-medium text-slate-900">{{ $kegiatan->tempat }}</p>
                    </div>
                </div>
                @endif
            </div>
            @if($kegiatan->deskripsi)
            <div class="text-slate-700 leading-relaxed whitespace-pre-line break-words [overflow-wrap:anywhere]">
                {{ $kegiatan->deskripsi }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
