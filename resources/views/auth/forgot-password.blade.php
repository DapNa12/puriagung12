@extends('layouts.guest')

@section('title', 'Lupa Password - Puri Agung Permai RW12')

@section('content')
<div class="text-center mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Lupa Password</h1>
    <p class="text-sm text-slate-500 mt-1">Masukkan email Anda, kami akan kirim tautan reset password</p>
</div>

<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus placeholder="email@contoh.com" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-primary-button>
            {{ __('Kirim Tautan Reset') }}
        </x-primary-button>
    </div>

    <p class="text-center text-sm text-slate-500 mt-6">
        <a href="{{ route('login') }}" class="text-rose-600 hover:text-rose-700 font-medium">&larr; Kembali ke login</a>
    </p>
</form>
@endsection
