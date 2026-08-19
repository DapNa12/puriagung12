@extends('layouts.admin')

@section('title', 'Detail Log Aktivitas')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.activity-log.index') }}" class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-rose-600 transition-colors mb-3">
        <i data-lucide="arrow-left" class="w-4 h-4"></i>
        Kembali ke Log Aktivitas
    </a>
    <h1 class="text-2xl font-bold text-slate-900">Detail Log Aktivitas</h1>
</div>

<div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Waktu</p>
            <p class="text-sm text-slate-900">{{ $log->created_at->format('d M Y, H:i:s') }}</p>
            <p class="text-xs text-slate-500 mt-0.5">{{ $log->created_at->diffForHumans() }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">User</p>
            <p class="text-sm font-medium text-slate-900">{{ $log->user->name }}</p>
            <p class="text-xs text-slate-500 capitalize">{{ $log->user->role }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Aksi</p>
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
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Model</p>
            <p class="text-sm text-slate-900">{{ $log->model_type }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">ID Data</p>
            <p class="text-sm text-slate-900 font-mono">#{{ $log->model_id }}</p>
        </div>
        <div>
            <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">IP Address</p>
            <p class="text-sm text-slate-900 font-mono">{{ $log->ip_address ?? '-' }}</p>
        </div>
    </div>

    <div class="mb-4 p-4 bg-slate-50 rounded-xl">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nama Data</p>
        <p class="text-sm text-slate-900">{{ $log->model_name }}</p>
    </div>

    <div class="mb-4 p-4 bg-slate-50 rounded-xl">
        <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Deskripsi</p>
        <p class="text-sm text-slate-900">{{ $log->description }}</p>
    </div>

    @if($log->old_values)
    <div class="mb-4">
        <h3 class="text-sm font-semibold text-slate-700 mb-3">Data Lama</h3>
        <div class="bg-slate-900 rounded-xl p-4 overflow-x-auto">
            <pre class="text-xs text-slate-300 whitespace-pre-wrap">{{ json_encode($log->old_values, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        </div>
    </div>
    @endif

@endsection

