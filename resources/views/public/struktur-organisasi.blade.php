@extends('layouts.public')

@section('title', 'Struktur Organisasi')
@section('meta_description', 'Struktur organisasi kemasyarakatan DKM, KARTAR, PKK, dan Posyandu di Puri Agung Permai RW12.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, dkm rw 12, kartar, pkk, posyandu puri agung permai')
@section('og_title', 'Struktur Organisasi - Puri Agung Permai RW12')
@section('og_description', 'Struktur organisasi kemasyarakatan di lingkungan RW 12 Puri Agung Permai.')

@php
$warna = [
    'DKM'      => ['bg' => 'from-emerald-100 to-emerald-50', 'text' => 'text-emerald-700', 'ring' => 'ring-emerald-200', 'badge' => 'bg-emerald-600', 'initial' => 'from-emerald-200 to-emerald-100'],
    'KARTAR'   => ['bg' => 'from-blue-100 to-blue-50', 'text' => 'text-blue-700', 'ring' => 'ring-blue-200', 'badge' => 'bg-blue-600', 'initial' => 'from-blue-200 to-blue-100'],
    'PKK'      => ['bg' => 'from-rose-100 to-rose-50', 'text' => 'text-rose-700', 'ring' => 'ring-rose-200', 'badge' => 'bg-rose-600', 'initial' => 'from-rose-200 to-rose-100'],
    'Posyandu' => ['bg' => 'from-amber-100 to-amber-50', 'text' => 'text-amber-700', 'ring' => 'ring-amber-200', 'badge' => 'bg-amber-600', 'initial' => 'from-amber-200 to-amber-100'],
];
@endphp

@section('content')
<div class="rw-page-head border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-12 md:py-20">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-semibold mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500" aria-hidden="true"></span> Organisasi Kemasyarakatan
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight">Struktur Organisasi</h1>
            <p class="mt-3 text-slate-600 text-base md:text-lg">
                Struktur kepengurusan organisasi kemasyarakatan di lingkungan RW 12
            </p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-8 md:py-14">
    @if($organisasi->isEmpty())
    <div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
        <i data-lucide="building" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
        <p class="text-slate-400 font-medium">Belum ada data organisasi</p>
        <p class="text-slate-400 text-sm mt-1">Data akan ditampilkan setelah anggota organisasi ditambahkan melalui menu Pengurus.</p>
    </div>
    @else
        @foreach($organisasi as $namaOrg => $anggota)
        @php $w = $warna[$namaOrg] ?? ['bg' => 'from-slate-100 to-slate-50', 'text' => 'text-slate-700', 'ring' => 'ring-slate-200', 'badge' => 'bg-slate-600', 'initial' => 'from-slate-200 to-slate-100']; @endphp
        <div class="mb-12 md:mb-14">
            <div class="flex items-center gap-4 mb-6 md:mb-8">
                <div class="flex-1 h-px bg-slate-200"></div>
                <span class="px-4 py-1.5 rounded-full {{ $w['badge'] }} text-white text-sm font-bold shadow-sm">{{ $namaOrg }}</span>
                <div class="flex-1 h-px bg-slate-200"></div>
            </div>

            <!-- Mobile: Horizontal list -->
            <div class="md:hidden space-y-3 max-w-3xl mx-auto">
                @foreach($anggota as $p)
                <div class="flex items-center gap-4 bg-white rounded-xl border border-slate-200 p-4">
                    <div class="w-14 h-14 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                        @if($p->foto)
                        <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama ?? 'Anggota' }}" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full bg-gradient-to-br {{ $w['initial'] }} flex items-center justify-center">
                            <span class="text-lg font-bold {{ $w['text'] }}">{{ substr($p->nama ?? '?', 0, 1) }}</span>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1 min-w-0">
                        <span class="block text-[10px] font-bold uppercase tracking-wider {{ $w['text'] }} mb-0.5">{{ $p->jabatan }}</span>
                        <h3 class="text-sm font-bold text-slate-900 truncate">{{ $p->nama ?? '-' }}</h3>
                        @if($p->periode_mulai)
                        <p class="text-xs text-slate-400 mt-0.5">{{ \Carbon\Carbon::parse($p->periode_mulai)->format('Y') }} - {{ $p->periode_selesai ? \Carbon\Carbon::parse($p->periode_selesai)->format('Y') : 'Sekarang' }}</p>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Desktop: Grid cards -->
            <div class="hidden md:grid grid-cols-2 lg:grid-cols-3 gap-6 max-w-5xl mx-auto">
                @foreach($anggota as $p)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 text-center hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                    @if($p->foto)
                    <img src="{{ asset('storage/'.$p->foto) }}" class="w-28 h-28 object-cover rounded-full mx-auto mb-4 border-4 border-white shadow-lg">
                    @else
                    <div class="w-28 h-28 bg-gradient-to-br {{ $w['initial'] }} rounded-full mx-auto mb-4 flex items-center justify-center border-4 border-white shadow-lg">
                        <span class="text-3xl font-bold {{ $w['text'] }}">{{ substr($p->nama ?? '?', 0, 1) }}</span>
                    </div>
                    @endif
                    <h3 class="text-lg font-bold text-slate-900">{{ $p->nama ?? '-' }}</h3>
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full {{ $w['bg'] }} {{ $w['text'] }} text-xs font-semibold mt-2">{{ $p->jabatan }}</span>
                    @if($p->periode_mulai)
                    <p class="text-xs text-slate-400 mt-2">{{ \Carbon\Carbon::parse($p->periode_mulai)->format('Y') }} - {{ $p->periode_selesai ? \Carbon\Carbon::parse($p->periode_selesai)->format('Y') : 'Sekarang' }}</p>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    @endif
</div>
@endsection
