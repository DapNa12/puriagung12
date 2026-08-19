@extends('layouts.guest')

@section('title', 'Masuk - Puri Agung Permai RW12')

@section('content')
<div class="text-center mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Selamat Datang</h1>
    <p class="text-sm text-slate-500 mt-1">Silakan masuk ke akun Anda</p>
</div>

<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('login') }}">
    @csrf

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="admin@rwdusun.id" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="flex items-center justify-between mt-4">
        <label for="remember_me" class="inline-flex items-center gap-2">
            <input id="remember_me" type="checkbox" class="rounded-lg border-slate-300 text-rose-600 shadow-sm focus:ring-rose-500" name="remember">
            <span class="text-sm text-slate-600">{{ __('Ingat saya') }}</span>
        </label>

        @if (Route::has('password.request'))
            <a class="text-sm text-rose-600 hover:text-rose-700 font-medium" href="{{ route('password.request') }}">
                {{ __('Lupa password?') }}
            </a>
        @endif
    </div>

    <div class="mt-6">
        <x-primary-button>
            {{ __('Masuk') }}
        </x-primary-button>
    </div>

</form>
@endsection
