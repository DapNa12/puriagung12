@extends('layouts.admin')

@section('title', 'Detail Pengurus')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.pengurus.index') }}" class="btn-secondary p-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detail Pengurus</h1>
            <p class="text-sm text-slate-500">{{ $pengurus->jabatan }}</p>
        </div>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('admin.pengurus.edit', $pengurus->id) }}" class="btn-soft-yellow">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit
        </a>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:col-span-1">
        @if($pengurus->foto)
        <img src="{{ asset('storage/'.$pengurus->foto) }}" class="w-full max-w-48 mx-auto aspect-square object-cover rounded-2xl border border-slate-200">
        @else
        <div class="w-48 h-48 mx-auto bg-rose-100 rounded-2xl flex items-center justify-center border border-slate-200">
            <span class="text-5xl font-bold text-rose-600">{{ substr($pengurus->nama ?? 'P', 0, 1) }}</span>
        </div>
        @endif
        <div class="text-center mt-4">
            <h2 class="text-xl font-bold text-slate-900">{{ $pengurus->nama ?? '-' }}</h2>
            <p class="text-rose-600 font-medium">{{ $pengurus->jabatan }}</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:col-span-2">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Informasi Kepengurusan</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Periode Mulai</p>
                <p class="text-sm font-medium text-slate-900 mt-1">{{ \Carbon\Carbon::parse($pengurus->periode_mulai)->isoFormat('D MMMM Y') }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Periode Selesai</p>
                <p class="text-sm font-medium text-slate-900 mt-1">{{ $pengurus->periode_selesai ? \Carbon\Carbon::parse($pengurus->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang (masih menjabat)' }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Nama</p>
                <p class="text-sm font-medium text-slate-900 mt-1">{{ $pengurus->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">RT</p>
                <p class="text-sm font-medium text-slate-900 mt-1">{{ $pengurus->rt ? 'RT '.$pengurus->rt : 'RW (tanpa RT)' }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Organisasi</p>
                <p class="text-sm font-medium text-slate-900 mt-1">{{ $pengurus->organisasi ?: '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
