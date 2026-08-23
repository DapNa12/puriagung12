@extends('layouts.admin')

@section('title', 'Organisasi')

@section('content')
<div class="sm:flex sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-2xl font-bold text-slate-900">Organisasi</h1>
        <p class="text-sm text-slate-500 mt-0.5">Kelola anggota organisasi kemasyarakatan</p>
    </div>
    <div class="mt-4 sm:mt-0 flex items-center gap-2">
        <a href="{{ route('admin.organisasi.create') }}" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Tambah Anggota
        </a>
    </div>
</div>

<div class="flex flex-wrap gap-2 mb-6">
    <a href="{{ route('admin.organisasi.index') }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all {{ !request('filter') ? 'bg-rose-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">Semua</a>
    @foreach(['DKM', 'KARTAR', 'PKK', 'Posyandu'] as $org)
    <a href="{{ route('admin.organisasi.index', ['filter' => $org]) }}" class="px-3 py-1.5 rounded-lg text-sm font-medium transition-all {{ request('filter') === $org ? 'bg-rose-600 text-white' : 'bg-white text-slate-600 border border-slate-200 hover:bg-slate-50' }}">{{ $org }}</a>
    @endforeach
</div>

<form method="GET" class="mb-6">
    <div class="flex gap-2">
        <div class="relative flex-1 max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau jabatan..." class="input-field pl-10">
            @if(request('filter'))<input type="hidden" name="filter" value="{{ request('filter') }}">@endif
        </div>
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

@if($pengurus->count() > 0)
<div class="hidden sm:block bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Organisasi</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Jabatan</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Periode</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($pengurus as $item)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                                @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                                @else
                                <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                                    <span class="text-sm font-bold text-rose-700">{{ substr($item->nama ?? '?', 0, 1) }}</span>
                                </div>
                                @endif
                            </div>
                            <p class="text-sm font-medium text-slate-900">{{ $item->nama ?? '-' }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3.5">
                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold">{{ $item->organisasi }}</span>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-700">{{ $item->jabatan }}</td>
                    <td class="px-4 py-3.5 text-sm text-slate-700 hidden sm:table-cell">{{ \Carbon\Carbon::parse($item->periode_mulai)->isoFormat('D MMMM Y') }} - {{ $item->periode_selesai ? \Carbon\Carbon::parse($item->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang' }}</td>
                    <td class="px-4 py-3.5 text-sm text-right">
                        <div class="flex items-center justify-end gap-1">
                            <a href="{{ route('admin.organisasi.show', $item->id) }}" class="btn-soft-blue">Detail</a>
                            <a href="{{ route('admin.organisasi.edit', $item->id) }}" class="btn-soft-yellow">Edit</a>
                            <form action="{{ route('admin.organisasi.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-soft-red">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="sm:hidden space-y-3">
    @foreach($pengurus as $item)
    <div class="bg-white rounded-2xl border border-slate-100 p-4">
        <div class="flex items-start gap-3 mb-2">
            <div class="w-12 h-12 rounded-lg overflow-hidden flex-shrink-0 bg-slate-100">
                @if($item->foto)
                <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
                @else
                <div class="w-full h-full bg-gradient-to-br from-rose-100 to-rose-50 flex items-center justify-center">
                    <span class="text-base font-bold text-rose-700">{{ substr($item->nama ?? '?', 0, 1) }}</span>
                </div>
                @endif
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-semibold text-slate-900">{{ $item->nama ?? '-' }}</p>
                <p class="text-xs text-slate-500">{{ $item->organisasi }} · {{ $item->jabatan }}</p>
            </div>
        </div>
        <p class="text-xs text-slate-500 mb-3">Periode: {{ \Carbon\Carbon::parse($item->periode_mulai)->isoFormat('D MMMM Y') }} — {{ $item->periode_selesai ? \Carbon\Carbon::parse($item->periode_selesai)->isoFormat('D MMMM Y') : 'Sekarang' }}</p>
        <div class="flex items-center gap-1.5 pt-2 border-t border-slate-100 mt-2">
            <a href="{{ route('admin.organisasi.show', $item->id) }}" class="btn-soft-blue">Detail</a>
            <a href="{{ route('admin.organisasi.edit', $item->id) }}" class="btn-soft-yellow">Edit</a>
            <form action="{{ route('admin.organisasi.destroy', $item->id) }}" method="POST" class="inline ml-auto" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-soft-red">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="building" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada anggota organisasi</p>
    <p class="text-slate-400 text-sm mt-1 mb-5">Mulai dengan menambahkan anggota organisasi kemasyarakatan.</p>
    <a href="{{ route('admin.organisasi.create') }}" class="btn-primary">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Tambah Anggota
    </a>
</div>
@endif

@if($pengurus->hasPages())
<div class="mt-4 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan {{ $pengurus->firstItem() }} - {{ $pengurus->lastItem() }} dari {{ $pengurus->total() }} data</p>
    {{ $pengurus->onEachSide(1)->links() }}
</div>
@endif
@endsection
