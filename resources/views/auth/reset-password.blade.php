@extends('layouts.guest')

@section('title', 'Reset Password - Puri Agung Permai RW12')

@section('content')
<div class="text-center mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Reset Password</h1>
    <p class="text-sm text-slate-500 mt-1">Buat password baru Anda</p>
</div>

<form method="POST" action="{{ route('password.store') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username" readonly class="bg-gray-50 cursor-not-allowed" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="password" :value="__('Password Baru')" />
        <x-text-input id="password" type="password" name="password" required autocomplete="new-password" placeholder="Minimal 8 karakter" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mt-4">
        <x-input-label for="password_confirmation" :value="__('Konfirmasi Password Baru')" />
        <x-text-input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Ulangi password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-primary-button>
            {{ __('Reset Password') }}
        </x-primary-button>
    </div>
</form>
@endsection
