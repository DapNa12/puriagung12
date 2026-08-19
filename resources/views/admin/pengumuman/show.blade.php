@extends('layouts.admin')

@section('title', 'Detail Pengumuman')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div class="flex items-center gap-4">
        <a href="{{ route('admin.berita.index') }}" class="btn-secondary p-2">
            <i data-lucide="arrow-left" class="w-5 h-5"></i>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Detail Pengumuman</h1>
            <p class="text-sm text-slate-500">Isi pengumuman untuk warga</p>
        </div>
    </div>
    <div class="mt-4 sm:mt-0">
        <a href="{{ route('admin.pengumuman.edit', $pengumuman) }}" class="btn-soft-yellow">
            <i data-lucide="pencil" class="w-4 h-4"></i>
            Edit
        </a>
    </div>
</div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 max-w-xl">
        @if($pengumuman->foto)
        <div class="mb-6 -m-8 -mt-0">
            <img src="{{ asset('storage/'.$pengumuman->foto) }}" class="w-full max-h-64 object-cover rounded-t-2xl border-b border-slate-100">
        </div>
        @endif
        <div class="flex items-center gap-2 text-sm text-slate-500 mb-4">
        <i data-lucide="user" class="w-4 h-4"></i>
        <span>{{ $pengumuman->user->name }}</span>
        <span class="text-gray-300">•</span>
        <span>{{ $pengumuman->created_at->isoFormat('D MMMM Y') }}</span>
    </div>
    <h2 class="text-xl font-bold text-slate-900 mb-4">{{ $pengumuman->judul }}</h2>
    <div class="text-slate-700 leading-relaxed text-sm">{{ $pengumuman->isi }}</div>
</div>
@endsection
