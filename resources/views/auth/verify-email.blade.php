@extends('layouts.guest')

@section('title', 'Verifikasi Email - Puri Agung Permai RW12')

@section('content')
<div class="text-center mb-6">
    <div class="mx-auto w-14 h-14 bg-rose-100 rounded-full flex items-center justify-center mb-4">
        <i data-lucide="mail" class="w-7 h-7 text-rose-600"></i>
    </div>
    <h1 class="text-2xl font-bold text-slate-900">Verifikasi Email</h1>
    <p class="text-sm text-slate-500 mt-2 leading-relaxed">
        Silakan verifikasi alamat email Anda dengan mengklik tautan yang kami kirim ke email Anda.
    </p>
</div>

@if (session('status') == 'verification-link-sent')
    <div class="flex items-center gap-2 p-3 rounded-xl bg-emerald-50 border border-emerald-200 text-sm text-emerald-700 mb-4">
        <i data-lucide="check-circle" class="w-4 h-4 flex-shrink-0"></i>
        Tautan verifikasi baru telah dikirim ke email Anda.
    </div>
@endif

<div class="space-y-3">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <x-primary-button>
            {{ __('Kirim Ulang Email Verifikasi') }}
        </x-primary-button>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="w-full text-center text-sm text-slate-500 hover:text-slate-700 font-medium py-2 transition-colors">
            {{ __('Keluar') }}
        </button>
    </form>
</div>
@endsection
