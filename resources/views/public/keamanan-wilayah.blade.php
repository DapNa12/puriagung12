@extends('layouts.public')

@section('title', 'Keamanan Wilayah')
@section('meta_description', 'Perangkat pengamanan wilayah RW 12 Puri Agung Permai. Informasi keamanan lingkungan.')
@section('og_title', 'Keamanan Wilayah - Puri Agung Permai RW12')
@section('og_description', 'Perangkat pengamanan wilayah RW 12 Puri Agung Permai.')

@section('content')
<div class="rw-page-head">
    <div class="max-w-7xl mx-auto px-4 py-14 md:py-20">
        <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900">Keamanan Wilayah</h1>
        <p class="mt-3 text-slate-500 text-base md:text-lg">Perangkat pengamanan wilayah RW 12</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-14">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-14">
        <div class="rw-card p-6 text-center">
            <p class="text-3xl md:text-4x1 font-extrabold text-slate-900">1</p>
            <p class="text-slate-650 text-sm mt-1">Regu Keamanan</p>
        </div>
        <div class="rw-card p-6 text-center">
            <p class="text-3xl md:text-4xl font-extrabold text-slate-900">3</p>
            <p class="text-slate-650 text-sm mt-1">Personel</p>
        </div>
        <!-- <div class="rw-card p-6 text-center">
            <p class="text-3xl md:text-4xl font-extrabold text-slate-900">145</p>
            <p class="text-slate-500 text-sm mt-1">Titik CCTV</p>
        </div> -->
        <div class="rw-card p-6 text-center">
            <p class="text-3xl md:text-4xl font-extrabold text-slate-900">24</p>
            <p class="text-slate-650 text-sm mt-1">Jam Patroli</p>
        </div>
    </div>

    <section class="space-y-12">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6">Petugas Keamanan</h2>
            <div class="rw-card p-6 md:p-8">
                <div class="space-y-4 text-slate-600 leading-relaxed">
                    <p>RW 12 Perum Puri Agung Permai memiliki tim keamanan yang terdiri dari 4 orang, yaitu 1 orang koordinator keamanan Bapak AGUS LD, dan 3 personel keamanan yaitu Bapak Endang, Bapak Iwan, dan Bapak Dede. Tim ini bertugas menjaga keamanan dan ketertiban lingkungan, berkoordinasi dengan pengurus RT dan pihak terkait, serta menindaklanjuti laporan warga agar lingkungan tetap aman, tertib, dan kondusif.</p>
                    <p>Dengan jumlah personel yang ada dan sistem keamanan 24 jam, petugas keamanan selalu siap merespons permintaan warga apabila terjadi situasi yang membutuhkan bantuan atau penanganan cepat. Kehadiran para petugas keamanan ini menjadi garda terdepan dalam memastikan lingkungan RW 12 tetap aman, kondusif, dan tertib setiap hari.</p>
                </div>
            </div>
        </div>

        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-slate-900 mb-6">Sistem Pengawasan CCTV</h2>
            <div class="rw-card p-6 md:p-8">
                <div class="space-y-4 text-slate-600 leading-relaxed">
                    <p>Untuk perangkat kemanan CCTV RW 12 sampai saat ini masih bersifat individual, belum ada yang dikolal langsung oleh pihak keamanan RW, tapi dengan seiring waktu berjalan diharapkan bisa tersalurkan perangkat keamanan CCTV yang dikelola oleh keamanan RW 12</p>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
