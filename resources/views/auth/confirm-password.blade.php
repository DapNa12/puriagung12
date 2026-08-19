@extends('layouts.guest')

@section('title', 'Konfirmasi Password - Puri Agung Permai RW12')

@section('content')
<div class="text-center mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Konfirmasi Password</h1>
    <p class="text-sm text-slate-500 mt-1">Ini adalah area aman. Harap konfirmasi password Anda sebelum melanjutkan.</p>
</div>

<form method="POST" action="{{ route('password.confirm') }}">
    @csrf

    <div>
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mt-6">
        <x-primary-button>
            {{ __('Konfirmasi') }}
        </x-primary-button>
    </div>
</form>
@endsection
