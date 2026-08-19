@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Log Aktivitas</h1>
    <p class="text-sm text-slate-500 mt-0.5">Catatan seluruh aktivitas perubahan data di panel admin</p>
</div>

<form method="GET" class="mb-6">
    <div class="flex flex-wrap gap-2">
        <div class="relative flex-1 min-w-[200px] max-w-md">
            <i data-lucide="search" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama data atau deskripsi..." class="input-field pl-10">
        </div>
        <select name="action" onchange="this.form.submit()" class="input-field w-auto min-w-[120px]">
            <option value="">Semua Aksi</option>
            <option value="create" {{ request('action') === 'create' ? 'selected' : '' }}>Dibuat</option>
            <option value="update" {{ request('action') === 'update' ? 'selected' : '' }}>Diperbarui</option>
            <option value="delete" {{ request('action') === 'delete' ? 'selected' : '' }}>Dihapus</option>
        </select>
        <select name="model" onchange="this.form.submit()" class="input-field w-auto min-w-[130px]">
            <option value="">Semua Model</option>
            @foreach($modelTypes as $m)
            <option value="{{ $m }}" {{ request('model') === $m ? 'selected' : '' }}>{{ $m }}</option>
            @endforeach
        </select>
        <select name="user" onchange="this.form.submit()" class="input-field w-auto min-w-[130px]">
            <option value="">Semua User</option>
            @foreach($users as $u)
            <option value="{{ $u->id }}" {{ request('user') == $u->id ? 'selected' : '' }}>{{ $u->name }}</option>
            @endforeach
        </select>
        <input type="date" name="dari" value="{{ request('dari') }}" class="input-field w-auto" onchange="this.form.submit()">
        <input type="date" name="sampai" value="{{ request('sampai') }}" class="input-field w-auto" onchange="this.form.submit()">
        <button type="submit" class="btn-primary">Cari</button>
    </div>
</form>

@if($logs->count() > 0)
<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="bg-slate-50 border-b border-slate-100">
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Waktu</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">User</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Aksi</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider hidden sm:table-cell">Model</th>
                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Nama Data</th>
                    <th class="px-4 py-3.5 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Detail</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($logs as $log)
                <tr class="hover:bg-slate-50 transition-colors">
                    <td class="px-4 py-3.5 text-sm text-slate-500 whitespace-nowrap">{{ $log->created_at->diffForHumans() }}</td>
                    <td class="px-4 py-3.5">
                        <p class="text-sm font-medium text-slate-900">{{ $log->user->name }}</p>
                        <p class="text-xs text-slate-500 capitalize sm:hidden">{{ $log->user->role }}</p>
                    </td>
                    <td class="px-4 py-3.5">
                        @if($log->action === 'create')
                        <span class="badge bg-emerald-50 text-emerald-700 border border-emerald-200">
                            <span class="badge-dot bg-emerald-500"></span>
                            Dibuat
                        </span>
                        @elseif($log->action === 'update')
                        <span class="badge bg-amber-50 text-amber-700 border border-amber-200">
                            <span class="badge-dot bg-amber-500"></span>
                            Diperbarui
                        </span>
                        @else
                        <span class="badge bg-red-50 text-red-700 border border-red-200">
                            <span class="badge-dot bg-red-500"></span>
                            Dihapus
                        </span>
                        @endif
                    </td>
                    <td class="px-4 py-3.5 text-sm text-slate-500 hidden sm:table-cell">{{ $log->model_type }}</td>
                    <td class="px-4 py-3.5">
                        <p class="text-sm text-slate-900 max-w-[300px] truncate" title="{{ $log->model_name }}">{{ $log->model_name }}</p>
                    </td>
                    <td class="px-4 py-3.5 text-sm text-right">
                        <a href="{{ route('admin.activity-log.show', $log->id) }}" class="btn-soft-blue">Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="bg-white rounded-2xl border border-slate-100 p-12 text-center">
    <i data-lucide="clock" class="w-16 h-16 text-slate-200 mx-auto mb-4"></i>
    <p class="text-slate-400 font-medium">Belum ada log aktivitas</p>
    <p class="text-slate-400 text-sm mt-1">Log akan muncul setelah ada aktivitas perubahan data.</p>
</div>
@endif

@if($logs->hasPages())
<div class="mt-4 flex items-center justify-between">
    <p class="text-sm text-slate-500">Menampilkan {{ $logs->firstItem() }} - {{ $logs->lastItem() }} dari {{ $logs->total() }} data</p>
    {{ $logs->onEachSide(1)->links() }}
</div>
@endif
@endsection
