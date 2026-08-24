@extends('layouts.public')

@section('title', $pengumuman->judul)
@section('meta_description', strip_tags(Str::limit($pengumuman->isi, 160)))
@section('meta_keywords', strtolower($pengumuman->judul).', puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, pengumuman rw 12, berita warga')
@section('og_title', $pengumuman->judul . ' - Puri Agung Permai RW12')
@section('og_description', strip_tags(Str::limit($pengumuman->isi, 160)))
@if($pengumuman->foto)
@section('og_image', asset('storage/' . $pengumuman->foto))
@endif

@section('content')
<div class="max-w-4xl mx-auto px-4 py-12">
    <nav class="flex items-center gap-2 text-sm text-slate-400 mb-6" aria-label="Breadcrumb">
        <a href="{{ route('home') }}" class="hover:text-rose-600 transition-colors">Beranda</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <a href="{{ route('pengumuman') }}" class="hover:text-rose-600 transition-colors">Berita</a>
        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
        <span class="text-slate-700 font-medium truncate max-w-[200px]">{{ Str::limit($pengumuman->judul, 30) }}</span>
    </nav>

    <article class="bg-white rounded-2xl shadow-sm border border-slate-100 p-8 md:p-10">
        <div class="flex items-center gap-3 text-sm text-slate-400 mb-4">
            <span>{{ $pengumuman->created_at->isoFormat('D MMMM Y') }}</span>
            <span>&middot;</span>
            <span>{{ $pengumuman->user->name ?? 'Admin' }}</span>
        </div>
        @if($pengumuman->foto)
        <div class="mb-6 overflow-hidden rounded-xl">
            <img src="{{ asset('storage/'.$pengumuman->foto) }}" alt="{{ $pengumuman->judul }}" class="w-full h-auto object-cover">
        </div>
        @endif
        <h1 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6 leading-tight">{{ $pengumuman->judul }}</h1>
        <div class="prose prose-gray max-w-none text-slate-700 leading-relaxed">
            {{ $pengumuman->isi }}
        </div>
    </article>
</div>
@endsection
