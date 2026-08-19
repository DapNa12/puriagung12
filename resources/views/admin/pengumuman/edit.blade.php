@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.berita.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Edit Pengumuman</h1>
        <p class="text-sm text-slate-500">Perbarui pengumuman</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-xl">
    <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Judul Berita / Pengumuman <span class="text-red-500">*</span></label>
            <input type="text" name="judul" value="{{ old('judul', $pengumuman->judul) }}" class="input-field @error('judul') input-error @enderror">
            @error('judul')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Kategori <span class="text-red-500">*</span></label>
            <select name="kategori" class="input-field @error('kategori') input-error @enderror">
                <option value="kegiatan" @selected(old('kategori', $pengumuman->kategori)=='kegiatan')>Kegiatan</option>
                <option value="pemberitahuan" @selected(old('kategori', $pengumuman->kategori)=='pemberitahuan')>Pemberitahuan</option>
            </select>
            @error('kategori')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Isi <span class="text-red-500">*</span></label>
            <textarea name="isi" rows="6" class="input-field @error('isi') input-error @enderror">{{ old('isi', $pengumuman->isi) }}</textarea>
            @error('isi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto</label>
            @if($pengumuman->foto)
            <div class="mb-2 relative inline-block" id="foto-preview-wrapper">
                <img src="{{ asset('storage/'.$pengumuman->foto) }}" id="foto-preview-img" class="w-32 h-24 object-cover rounded-xl border border-slate-200 transition-all duration-200">
                <button type="button" id="btn-remove-foto" onclick="toggleRemoveFoto()" class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white rounded-full flex items-center justify-center hover:bg-red-600 shadow-sm transition-all duration-200" title="Hapus foto">
                    <i data-lucide="x" class="w-3 h-3 pointer-events-none"></i>
                </button>
                <input type="hidden" name="remove_foto" id="remove-foto-input" value="0">
                <p class="text-xs text-slate-400 mt-1" id="foto-status-text">Foto saat ini</p>
            </div>
            <script>
            function toggleRemoveFoto() {
                var img = document.getElementById('foto-preview-img');
                var btn = document.getElementById('btn-remove-foto');
                var input = document.getElementById('remove-foto-input');
                var text = document.getElementById('foto-status-text');
                if (input.value === '1') {
                    input.value = '0';
                    img.classList.remove('opacity-0', 'scale-95');
                    btn.classList.remove('bg-gray-400', 'hover:bg-gray-500');
                    btn.classList.add('bg-red-500', 'hover:bg-red-600');
                    text.textContent = 'Foto saat ini';
                    text.className = 'text-xs text-slate-400 mt-1';
                } else {
                    input.value = '1';
                    img.classList.add('opacity-0', 'scale-95');
                    btn.classList.remove('bg-red-500', 'hover:bg-red-600');
                    btn.classList.add('bg-gray-400', 'hover:bg-gray-500');
                    text.textContent = 'Foto akan dihapus';
                    text.className = 'text-xs text-red-500 font-medium mt-1';
                }
            }
            document.getElementById('foto-upload-input')?.addEventListener('change', function() {
                if (this.files.length > 0 && document.getElementById('remove-foto-input').value === '1') {
                    toggleRemoveFoto();
                }
            });
            </script>
            @endif
            <input type="file" name="foto" id="foto-upload-input" accept="image/*" class="input-field @error('foto') input-error @enderror">
            <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG. Maksimal 5MB. Upload file untuk mengganti foto.</p>
            @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tgl Mulai</label>
                <input type="date" name="tgl_mulai" value="{{ old('tgl_mulai', $pengumuman->tgl_mulai) }}" class="input-field">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Tgl Selesai</label>
                <input type="date" name="tgl_selesai" value="{{ old('tgl_selesai', $pengumuman->tgl_selesai) }}" class="input-field">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
            <select name="status" class="input-field @error('status') input-error @enderror">
                <option value="aktif" @selected(old('status', $pengumuman->status)=='aktif')>Aktif</option>
                <option value="nonaktif" @selected(old('status', $pengumuman->status)=='nonaktif')>Nonaktif</option>
            </select>
            @error('status')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Update</button>
            <a href="{{ route('admin.berita.index') }}" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>
@endsection
