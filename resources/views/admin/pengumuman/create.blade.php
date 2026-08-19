@extends('layouts.admin')

@section('title', 'Buat Pengumuman')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.berita.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Buat Pengumuman</h1>
        <p class="text-sm text-slate-500">Buat pengumuman untuk warga</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-xl">
    <form action="{{ route('admin.pengumuman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Berita / Pengumuman <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul') }}" class="input-field @error('judul') input-error @enderror" placeholder="Contoh: Jadwal Donor Darah RW 12">
            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
            <select name="kategori" class="input-field @error('kategori') input-error @enderror">
                <option value="kegiatan" @selected(old('kategori')=='kegiatan')>Kegiatan</option>
                <option value="pemberitahuan" @selected(old('kategori')=='pemberitahuan')>Pemberitahuan</option>
            </select>
            @error('kategori')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Isi <span class="text-red-500">*</span></label>
            <textarea name="isi" rows="6" class="input-field @error('isi') input-error @enderror" placeholder="Tulis isi pengumuman di sini...">{{ old('isi') }}</textarea>
            @error('isi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto</label>
            <input type="file" name="foto" accept="image/*" class="input-field @error('foto') input-error @enderror">
            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 5MB.</p>
            @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tgl Mulai</label>
                <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai') }}" class="input-field">
                <p class="text-xs text-slate-400 mt-1">Kosongi jika langsung aktif</p>
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tgl Selesai</label>
                <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai') }}" class="input-field">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
            <select name="status" class="input-field @error('status') input-error @enderror">
                <option value="aktif" @selected(old('status')=='aktif')>Aktif</option>
                <option value="nonaktif" @selected(old('status')=='nonaktif')>Nonaktif</option>
            </select>
            @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Simpan</button>
            <a href="{{ route('admin.berita.index') }}" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
@endsection
