@extends('layouts.admin')

@section('title', 'Detail Jajaran & RT')

@section('content')
<div class="flex items-center gap-4 mb-6">
    <a href="{{ route('admin.jajaran.index') }}" class="btn-secondary p-2">
        <i data-lucide="arrow-left" class="w-5 h-5"></i>
    </a>
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Detail Jajaran & RT</h1>
    </div>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 max-w-lg">
    <div class="flex items-center gap-4 mb-6">
        <div class="w-20 h-20 rounded-xl overflow-hidden flex-shrink-0 bg-slate-100">
            @if($pengurus->foto)
            <img src="{{ asset('storage/'.$pengurus->foto) }}" alt="{{ $pengurus->nama }}" class="w-full h-full object-cover">
            @else
            <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                <span class="text-2xl font-bold text-rose-700">{{ substr($pengurus->nama ?? '?', 0, 1) }}</span>
            </div>
            @endif
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900">{{ $pengurus->nama ?? '-' }}</h2>
            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full {{ $pengurus->kategori === 'seksi' ? 'bg-blue-50 text-blue-700' : 'bg-rose-50 text-rose-700' }} text-xs font-medium mt-1">
                {{ $pengurus->kategori === 'seksi' ? 'Seksi' : 'RT' }}
            </span>
        </div>
    </div>

    <dl class="grid grid-cols-2 gap-4 text-sm">
        <div>
            <dt class="text-slate-500 font-medium">Lokasi</dt>
            <dd class="text-slate-900 font-semibold mt-1">{{ $pengurus->kategori === 'seksi' ? $pengurus->organisasi : 'RT '.$pengurus->rt }}</dd>
        </div>
        <div>
            <dt class="text-slate-500 font-medium">Periode Mulai</dt>
            <dd class="text-slate-900 font-semibold mt-1">{{ $pengurus->periode_mulai ? \Carbon\Carbon::parse($pengurus->periode_mulai)->isoFormat('D MMMM Y') : '-' }}</dd>
        </div>
        <div>
            <dt class="text-slate-500 font-medium">Periode Selesai</dt>
            <dd class="text-slate-900 font-semibold mt-1">{{ $pengurus->periode_selesai ? \Carbon\Carbon::parse($pengurus->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang' }}</dd>
        </div>
    </dl>

    <div class="flex space-x-3 mt-6 pt-4 border-t border-slate-100">
        <a href="{{ route('admin.jajaran.edit', $pengurus->id) }}" class="btn-soft-yellow">
            <i data-lucide="pencil" class="w-4 h-4"></i> Edit
        </a>
        <form action="{{ route('admin.jajaran.destroy', $pengurus->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-soft-red">
                <i data-lucide="trash-2" class="w-4 h-4"></i> Hapus
            </button>
        </form>
    </div>
</div>
@endsection
