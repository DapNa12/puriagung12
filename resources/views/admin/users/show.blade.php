@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6 flex items-center justify-between">
        <h1 class="text-2xl font-bold text-slate-900">Detail User</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-soft-yellow">
                <i data-lucide="pencil" class="w-4 h-4"></i> Edit
            </a>
            <a href="{{ route('admin.users.index') }}" class="btn-secondary">Kembali</a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200 p-6">
        <div class="flex items-center gap-4 mb-6">
            <div class="w-16 h-16 bg-rose-100 rounded-full flex items-center justify-center">
                <span class="text-2xl font-bold text-rose-700">{{ substr($user->name, 0, 1) }}</span>
            </div>
            <div>
                <h2 class="text-xl font-bold text-slate-900">{{ $user->name }}</h2>
                <p class="text-sm text-slate-500">{{ $user->email }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-6">
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Role</p>
                <p class="text-sm font-medium text-slate-900 mt-1 capitalize">{{ $user->role }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Status</p>
                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold mt-1 {{ $user->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-red-50 text-red-700' }}">
                    {{ $user->is_active ? 'Aktif' : 'Non-Aktif' }}
                </span>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Email Verified</p>
                <p class="text-sm font-medium text-slate-900 mt-1">{{ $user->email_verified_at ? $user->email_verified_at->isoFormat('D MMMM Y') : 'Belum diverifikasi' }}</p>
            </div>
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-wider font-semibold">Terdaftar</p>
                <p class="text-sm font-medium text-slate-900 mt-1">{{ $user->created_at->isoFormat('D MMMM Y') }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
