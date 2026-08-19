@extends('layouts.admin')

@section('title', 'Detail Kegiatan')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.berita.index') }}" class="btn-secondary p-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detail Kegiatan</h1>
            <p class="text-sm text-slate-500">Informasi lengkap kegiatan RW</p>
        </div>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('admin.kegiatan.edit', $kegiatan) }}" class="btn-soft-yellow">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit
        </a>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden max-w-xl">
    @if($kegiatan->foto)
    <img src="{{ asset('storage/'.$kegiatan->foto) }}" alt="{{ $kegiatan->nama_kegiatan }}" class="w-full h-56 object-cover">
    @endif
    <div class="p-6">
        <span class="badge
            {{ $kegiatan->status === 'akan_datang' ? 'bg-rose-50 text-rose-700' : ($kegiatan->status === 'selesai' ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700') }}">
            <span class="badge-dot {{ $kegiatan->status === 'akan_datang' ? 'bg-rose-500' : ($kegiatan->status === 'selesai' ? 'bg-emerald-500' : 'bg-red-500') }}"></span>
            {{ str_replace('_', ' ', ucfirst($kegiatan->status)) }}
        </span>
        <h2 class="text-xl font-bold text-slate-900 mt-3">{{ $kegiatan->nama_kegiatan }}</h2>
        <div class="text-slate-600 mt-4 space-y-2 text-sm">
            <div class="flex items-center gap-2">
                <i data-lucide="calendar" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                <span><span class="font-medium text-slate-700">Tanggal:</span> {{ \Carbon\Carbon::parse($kegiatan->tanggal)->isoFormat('D MMMM Y') }}</span>
            </div>
            @if($kegiatan->waktu)
            <div class="flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                <span><span class="font-medium text-slate-700">Waktu:</span> {{ $kegiatan->waktu_formatted }} WIB</span>
            </div>
            @endif
            @if($kegiatan->tempat)
            <div class="flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 flex-shrink-0"></i>
                <span><span class="font-medium text-slate-700">Tempat:</span> {{ $kegiatan->tempat }}</span>
            </div>
            @endif
        </div>
        @if($kegiatan->deskripsi)
        <div class="mt-5 pt-4 border-t border-slate-100 text-slate-700 text-sm leading-relaxed">{{ $kegiatan->deskripsi }}</div>
        @endif
    </div>
</div>
@endsection
