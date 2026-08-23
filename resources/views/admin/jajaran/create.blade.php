@extends('layouts.admin')

@section('title', 'Tambah Jajaran & RT')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.jajaran.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Tambah Jajaran & RT</h1>
        <p class="text-sm text-slate-500">Tambah data seksi atau pengurus RT baru</p>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-lg">
    <form action="{{ route('admin.jajaran.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Nama <span class="text-red-500">*</span></label>
            <input type="text" name="nama" value="{{ old('nama') }}" placeholder="Nama lengkap" class="input-field @error('nama') input-error @enderror">
            @error('nama')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium text-slate-700 mb-1">Tipe <span class="text-red-500">*</span></label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="tipe" value="seksi" {{ old('tipe') == 'seksi' ? 'checked' : '' }} class="text-rose-600 focus:ring-rose-500">
                    <span class="text-sm text-slate-700">Seksi</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="tipe" value="rt" {{ old('tipe') == 'rt' ? 'checked' : '' }} class="text-rose-600 focus:ring-rose-500">
                    <span class="text-sm text-slate-700">RT</span>
                </label>
            </div>
            @error('tipe')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4" id="field-seksi" style="{{ old('tipe') != 'seksi' ? 'display:none' : '' }}">
            <label class="block text-sm font-medium text-slate-700 mb-1">Seksi</label>
            <select name="seksi" id="input-seksi" class="input-field @error('seksi') input-error @enderror">
                <option value="">-- Pilih Seksi --</option>
                @foreach($daftarSeksi as $s)
                <option value="{{ $s }}" @selected(old('seksi')==$s)>{{ $s }}</option>
                @endforeach
            </select>
            @error('seksi')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="mb-4" id="field-rt" style="{{ old('tipe') != 'rt' ? 'display:none' : '' }}">
            <label class="block text-sm font-medium text-slate-700 mb-1">RT</label>
            <select name="rt" id="input-rt" class="input-field @error('rt') input-error @enderror">
                <option value="">-- Pilih RT --</option>
                @foreach($daftarRt as $rt)
                <option value="{{ $rt }}" @selected(old('rt')==$rt)>RT {{ $rt }}</option>
                @endforeach
            </select>
            @error('rt')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode Mulai <span class="text-red-500">*</span></label>
                <input type="date" name="periode_mulai" value="{{ old('periode_mulai') }}" class="input-field @error('periode_mulai') input-error @enderror">
                @error('periode_mulai')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Periode Selesai</label>
                <input type="date" name="periode_selesai" value="{{ old('periode_selesai') }}" class="input-field">
                <p class="text-xs text-slate-400 mt-1">Kosongi jika masih menjabat</p>
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-medium text-slate-700 mb-1">Foto</label>
            <input type="file" name="foto" accept="image/*" class="input-field @error('foto') input-error @enderror">
            <p class="text-xs text-slate-400 mt-1">JPG/PNG, maks 5MB.</p>
            @error('foto')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
        </div>

        <div class="flex space-x-3">
            <button type="submit" class="btn-primary px-6">Simpan</button>
            <a href="{{ route('admin.jajaran.index') }}" class="btn-secondary px-6">Batal</a>
        </div>
    </form>
</div>

<script>
(function() {
    var radios = document.querySelectorAll('input[name="tipe"]');
    var fieldSeksi = document.getElementById('field-seksi');
    var fieldRt = document.getElementById('field-rt');

    radios.forEach(function(radio) {
        radio.addEventListener('change', function() {
            fieldSeksi.style.display = this.value === 'seksi' ? '' : 'none';
            fieldRt.style.display = this.value === 'rt' ? '' : 'none';
        });
    });
})();
</script>
@endsection
