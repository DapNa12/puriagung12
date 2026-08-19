@extends('layouts.admin')

@section('title', 'Edit Album - ' . $album->judul)

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.galeri.show', $album->id) }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Edit Album</h1>
        <p class="text-sm text-slate-500">Ubah informasi album galeri</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-xl">
    <form action="{{ route('admin.galeri.update', $album->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Album <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $album->judul) }}" class="input-field @error('judul') input-error @enderror">
            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="input-field">{{ old('deskripsi', $album->deskripsi) }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Momen</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $album->tanggal ? $album->tanggal->toDateString() : '') }}" class="input-field">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Tambah Foto Baru</label>
            <input type="file" name="fotos[]" accept="image/*" multiple class="input-field @error('fotos.*') input-error @enderror">
            @error('fotos.*')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            <p class="text-xs text-slate-400 mt-1">Opsional. Bisa pilih banyak sekaligus.</p>
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Simpan</button>
            <a href="{{ route('admin.galeri.show', $album->id) }}" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
@endsection
