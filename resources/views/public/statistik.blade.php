@extends('layouts.public')

@section('title', 'Statistik Kependudukan')
@section('meta_description', 'Data statistik kependudukan Puri Agung Permai RW12. Jumlah warga, RT, dan data demografis lainnya.')
@section('meta_keywords', 'puri agung permai, puri agung 12, rw 12 puri agung permai, pasar kemis, gelam jaya, kabupaten tangerang, data penduduk rw 12, jumlah warga, statistik kependudukan')
@section('og_title', 'Statistik Kependudukan - Puri Agung Permai RW12')
@section('og_description', 'Data statistik kependudukan Puri Agung Permai RW12.')

@section('content')
<!-- Header Section -->
<div class="rw-page-head border-b border-slate-200/80">
    <div class="max-w-7xl mx-auto px-4 py-12 md:py-16">
        <div class="max-w-3xl">
            <span class="inline-flex items-center gap-2 px-3 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs font-semibold mb-3">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span> Data Statistik RW 12
            </span>
            <h1 class="text-3xl md:text-5xl font-extrabold text-slate-900 tracking-tight">Statistik Kependudukan</h1>
            <p class="mt-3 text-slate-600 text-base md:text-lg">Demografi kependudukan, kelompok usia, agama, pendidikan, golongan darah, dan sebaran wilayah {{ $selectedRt ? 'RT ' . sprintf('%02d', $selectedRt) : 'RW 12' }}.</p>
        </div>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-10 space-y-8">
    <!-- Filter Bar per RT -->
    <form method="GET" action="{{ route('statistik') }}" class="bg-white p-4 md:p-5 rounded-2xl border border-slate-200 shadow-sm flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-rose-50 rounded-xl flex items-center justify-center text-rose-600 flex-shrink-0">
                <i data-lucide="filter" class="w-5 h-5"></i>
            </div>
            <div>
                <h3 class="text-sm font-bold text-slate-900">Filter Wilayah RT</h3>
                <p class="text-xs text-slate-500">Pilih wilayah RT untuk melihat statistik spesifik</p>
            </div>
        </div>

        <div class="flex items-center gap-3 w-full md:w-auto">
            <select name="rt" onchange="this.form.submit()" class="w-full md:w-64 bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-semibold text-slate-700 focus:outline-none focus:border-rose-500 focus:bg-white transition-all shadow-inner">
                <option value="">-- Seluruh RW 12 (Semua RT) --</option>
                @foreach($daftarRt as $rtItem)
                    <option value="{{ $rtItem }}" @selected($selectedRt == $rtItem)>RT {{ sprintf('%02d', $rtItem) }}</option>
                @endforeach
            </select>
            @if($selectedRt)
                <a href="{{ route('statistik') }}" class="px-3 py-2.5 bg-slate-100 hover:bg-slate-200 text-slate-600 rounded-xl text-xs font-bold transition-all whitespace-nowrap">
                    Reset Filter
                </a>
            @endif
        </div>
    </form>

    @if($selectedRt)
        <div class="bg-rose-50 border border-rose-200 rounded-xl p-4 flex items-center justify-between">
            <p class="text-sm font-medium text-rose-800">Menampilkan statistik khusus wilayah <span class="font-bold">RT {{ sprintf('%02d', $selectedRt) }}</span></p>
            <a href="{{ route('statistik') }}" class="text-xs font-bold text-rose-600 hover:underline">Tampilkan Seluruh RW 12 &rarr;</a>
        </div>
    @endif

    <!-- Top Summary Stat Grid (5 Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
        <!-- Card 1: Rumah & Bangunan -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:border-rose-300 transition-all">
            <div class="w-12 h-12 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 mb-3">
                <i data-lucide="home" class="w-7 h-7"></i>
            </div>
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Rumah & Bangunan</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1"><span data-count="{{ $jumlahRumah }}">0</span></p>
            <p class="text-xs text-slate-500 mt-0.5">Unit Rumah/Bangunan</p>
        </div>

        <!-- Card 2: Total Penduduk -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:border-rose-300 transition-all">
            <div class="w-12 h-12 bg-rose-50 rounded-xl flex items-center justify-center text-rose-600 mb-3">
                <i data-lucide="users" class="w-7 h-7"></i>
            </div>
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Total Penduduk</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1"><span data-count="{{ $totalWarga }}">0</span></p>
            <p class="text-xs text-slate-500 mt-0.5">Jiwa Terdaftar {{ $selectedRt ? 'RT ' . sprintf('%02d', $selectedRt) : '' }}</p>
        </div>

        <!-- Card 3: Laki-laki -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:border-rose-300 transition-all">
            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-3">
                <i data-lucide="user" class="w-7 h-7"></i>
            </div>
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Laki-laki</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1"><span data-count="{{ $wargaLaki }}">0</span></p>
            <p class="text-xs text-slate-500 mt-0.5">Jiwa ({{ $totalWarga > 0 ? round(($wargaLaki / $totalWarga) * 100) : 0 }}%)</p>
        </div>

        <!-- Card 4: Perempuan -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:border-rose-300 transition-all">
            <div class="w-12 h-12 bg-rose-50 rounded-xl flex items-center justify-center text-rose-600 mb-3">
                <i data-lucide="user" class="w-7 h-7"></i>
            </div>
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Perempuan</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1"><span data-count="{{ $wargaPerempuan }}">0</span></p>
            <p class="text-xs text-slate-500 mt-0.5">Jiwa ({{ $totalWarga > 0 ? round(($wargaPerempuan / $totalWarga) * 100) : 0 }}%)</p>
        </div>

        <!-- Card 5: Sebaran RT -->
        <div class="bg-white rounded-2xl border border-slate-200 p-5 shadow-sm hover:border-emerald-300 transition-all">
            <div class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center text-emerald-600 mb-3">
                <i data-lucide="flag" class="w-7 h-7"></i>
            </div>
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider">Wilayah RT</p>
            <p class="text-2xl font-extrabold text-slate-900 mt-1">{{ count($wargaPerRt) }}</p>
            <p class="text-xs text-slate-500 mt-0.5">RT Terdaftar</p>
        </div>
    </div>

    <!-- Navigation Tabs -->
    <div class="bg-white rounded-2xl border border-slate-200 p-2 shadow-sm">
        <div class="flex overflow-x-auto gap-2 no-scrollbar" id="stat-tabs">
            <button onclick="switchTab('usia')" id="tab-usia" class="stat-tab-btn active px-5 py-3 rounded-xl font-bold text-sm whitespace-nowrap transition-all flex items-center gap-2 bg-rose-600 text-white shadow-sm">
                <span>👶</span> Kelompok Usia
            </button>
            <button onclick="switchTab('agama')" id="tab-agama" class="stat-tab-btn px-5 py-3 rounded-xl font-medium text-sm text-slate-600 hover:text-slate-900 hover:bg-slate-100 whitespace-nowrap transition-all flex items-center gap-2">
                <span>🕌</span> Agama
            </button>
            <button onclick="switchTab('pendidikan')" id="tab-pendidikan" class="stat-tab-btn px-5 py-3 rounded-xl font-medium text-sm text-slate-600 hover:text-slate-900 hover:bg-slate-100 whitespace-nowrap transition-all flex items-center gap-2">
                <span>🎓</span> Pendidikan
            </button>
            <button onclick="switchTab('goldar')" id="tab-goldar" class="stat-tab-btn px-5 py-3 rounded-xl font-medium text-sm text-slate-600 hover:text-slate-900 hover:bg-slate-100 whitespace-nowrap transition-all flex items-center gap-2">
                <span>🩸</span> Golongan Darah
            </button>
            <button onclick="switchTab('rt')" id="tab-rt" class="stat-tab-btn px-5 py-3 rounded-xl font-medium text-sm text-slate-600 hover:text-slate-900 hover:bg-slate-100 whitespace-nowrap transition-all flex items-center gap-2">
                <span>🏘️</span> Sebaran Per RT
            </button>
        </div>
    </div>

    <!-- Tab 1: Kelompok Usia -->
    <div id="content-usia" class="tab-content block">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col items-center justify-center">
                <h3 class="text-base font-bold text-slate-900 mb-4 text-center">Grafik Kelompok Usia {{ $selectedRt ? '(RT ' . sprintf('%02d', $selectedRt) . ')' : '' }}</h3>
                <div class="w-full max-w-[260px] h-[260px] flex items-center justify-center">
                    @if($totalWarga > 0)
                        <canvas id="chartUsia"></canvas>
                    @else
                        <div class="text-center text-slate-400 text-sm">
                            <p>Belum ada data warga {{ $selectedRt ? 'di RT ini' : '' }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Rincian Kelompok Usia</h3>
                @php
                    $balitaPct = $totalWarga > 0 ? round(($usiaBalita / $totalWarga) * 100, 1) : 0;
                    $anakPct = $totalWarga > 0 ? round(($usiaAnak / $totalWarga) * 100, 1) : 0;
                    $remajaPct = $totalWarga > 0 ? round(($usiaRemaja / $totalWarga) * 100, 1) : 0;
                    $dewasaPct = $totalWarga > 0 ? round(($usiaDewasa / $totalWarga) * 100, 1) : 0;
                    $lansiaPct = $totalWarga > 0 ? round(($usiaLansia / $totalWarga) * 100, 1) : 0;
                @endphp
                <div class="space-y-4">
                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span class="text-slate-700">Balita (0-4 th)</span>
                            <span class="text-slate-900 font-extrabold">{{ $usiaBalita }} jiwa ({{ $balitaPct }}%)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-amber-400 h-3 rounded-full transition-all duration-500" style="width: {{ max($balitaPct, $usiaBalita > 0 ? 3 : 0) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span class="text-slate-700">Anak-anak (5-14 th)</span>
                            <span class="text-slate-900 font-extrabold">{{ $usiaAnak }} jiwa ({{ $anakPct }}%)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-rose-400 h-3 rounded-full transition-all duration-500" style="width: {{ max($anakPct, $usiaAnak > 0 ? 3 : 0) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span class="text-slate-700">Remaja (15-24 th)</span>
                            <span class="text-slate-900 font-extrabold">{{ $usiaRemaja }} jiwa ({{ $remajaPct }}%)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-teal-500 h-3 rounded-full transition-all duration-500" style="width: {{ max($remajaPct, $usiaRemaja > 0 ? 3 : 0) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span class="text-slate-700">Dewasa (25-59 th)</span>
                            <span class="text-slate-900 font-extrabold">{{ $usiaDewasa }} jiwa ({{ $dewasaPct }}%)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-indigo-600 h-3 rounded-full transition-all duration-500" style="width: {{ max($dewasaPct, $usiaDewasa > 0 ? 3 : 0) }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm font-semibold mb-1">
                            <span class="text-slate-700">Lansia (&ge; 60 th)</span>
                            <span class="text-slate-900 font-extrabold">{{ $usiaLansia }} jiwa ({{ $lansiaPct }}%)</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-3">
                            <div class="bg-rose-500 h-3 rounded-full transition-all duration-500" style="width: {{ max($lansiaPct, $usiaLansia > 0 ? 3 : 0) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 2: Agama -->
    <div id="content-agama" class="tab-content hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col items-center justify-center">
                <h3 class="text-base font-bold text-slate-900 mb-4 text-center">Grafik Agama {{ $selectedRt ? '(RT ' . sprintf('%02d', $selectedRt) . ')' : '' }}</h3>
                <div class="w-full max-w-[260px] h-[260px] flex items-center justify-center">
                    <canvas id="chartAgama"></canvas>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Sebaran Agama</h3>
                @php
                    $listAgama = ['Islam', 'Kristen', 'Katolik', 'Budha', 'Hindu', 'Lainnya'];
                @endphp
                <div class="space-y-4">
                    @foreach($listAgama as $agm)
                        @php
                            $cnt = $statAgama[$agm] ?? 0;
                            $pct = $totalWarga > 0 ? round(($cnt / $totalWarga) * 100, 1) : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between text-sm font-semibold mb-1">
                                <span class="text-slate-700">{{ $agm }}</span>
                                <span class="text-slate-900 font-extrabold">{{ $cnt }} jiwa ({{ $pct }}%)</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-3">
                                <div class="bg-emerald-500 h-3 rounded-full transition-all duration-500" style="width: {{ max($pct, $cnt > 0 ? 3 : 0) }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 3: Pendidikan -->
    <div id="content-pendidikan" class="tab-content hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col items-center justify-center">
                <h3 class="text-base font-bold text-slate-900 mb-4 text-center">Grafik Pendidikan {{ $selectedRt ? '(RT ' . sprintf('%02d', $selectedRt) . ')' : '' }}</h3>
                <div class="w-full max-w-[260px] h-[260px] flex items-center justify-center">
                    <canvas id="chartPendidikan"></canvas>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Tingkat Pendidikan Warga</h3>
                @php
                    $listPendidikan = ['Belum Sekolah', 'SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'];
                @endphp
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($listPendidikan as $pddk)
                        @php
                            $cnt = $statPendidikan[$pddk] ?? 0;
                            $pct = $totalWarga > 0 ? round(($cnt / $totalWarga) * 100, 1) : 0;
                        @endphp
                        <div class="p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="flex justify-between text-sm font-semibold mb-1">
                                <span class="text-slate-700">{{ $pddk }}</span>
                                <span class="text-slate-900 font-extrabold">{{ $cnt }} jiwa</span>
                            </div>
                            <div class="w-full bg-slate-200 rounded-full h-2 mt-2">
                                <div class="bg-rose-600 h-2 rounded-full transition-all duration-500" style="width: {{ max($pct, $cnt > 0 ? 5 : 0) }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 4: Golongan Darah -->
    <div id="content-goldar" class="tab-content hidden">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-1 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col items-center justify-center">
                <h3 class="text-base font-bold text-slate-900 mb-4 text-center">Grafik Golongan Darah {{ $selectedRt ? '(RT ' . sprintf('%02d', $selectedRt) . ')' : '' }}</h3>
                <div class="w-full max-w-[260px] h-[260px] flex items-center justify-center">
                    <canvas id="chartGoldar"></canvas>
                </div>
            </div>

            <div class="lg:col-span-2 bg-white rounded-2xl border border-slate-200 p-6 shadow-sm">
                <h3 class="text-lg font-bold text-slate-900 mb-4">Sebaran Golongan Darah</h3>
                @php
                    $listGoldar = ['A', 'B', 'AB', 'O'];
                @endphp
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    @foreach($listGoldar as $gol)
                        @php
                            $cnt = $statGoldar[$gol] ?? 0;
                            $pct = $totalWarga > 0 ? round(($cnt / $totalWarga) * 100, 1) : 0;
                        @endphp
                        <div class="p-4 bg-rose-50/50 rounded-2xl border border-rose-100 text-center">
                            <span class="inline-flex items-center justify-center w-12 h-12 bg-rose-500 text-white font-extrabold rounded-xl text-lg mb-2 shadow-sm">{{ $gol }}</span>
                            <h4 class="text-2xl font-black text-slate-900">{{ $cnt }} <span class="text-xs font-normal text-slate-500">jiwa</span></h4>
                            <p class="text-xs text-slate-500 mt-1 font-medium">{{ $pct }}% dari total</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Tab 5: Sebaran per RT -->
    <div id="content-rt" class="tab-content hidden">
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Rekapitulasi Penduduk per RT</h3>
                    <p class="text-slate-500 text-sm mt-0.5">Statistik sebaran warga berdasarkan data yang diinput pengurus RW</p>
                </div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-slate-600">
                    <thead class="bg-slate-50 text-slate-900 font-bold border-b border-slate-200 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-4">Wilayah RT</th>
                            <th class="px-6 py-4">Laki-laki</th>
                            <th class="px-6 py-4">Perempuan</th>
                            <th class="px-6 py-4">Total Penduduk</th>
                            <th class="px-6 py-4 w-48">Proporsi Total</th>
                            <th class="px-6 py-4">Aksi Filter</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @php
                            $maxRtTotal = count($wargaPerRt) > 0 ? $wargaPerRt->max('total') : 1;
                        @endphp
                        @forelse($wargaPerRt as $row)
                        <tr class="hover:bg-slate-50 transition-colors @if($selectedRt == $row->rt) bg-rose-50/70 font-semibold @endif">
                            <td class="px-6 py-3.5 font-bold text-slate-900">RT {{ sprintf('%02d', $row->rt) }}</td>
                            <td class="px-6 py-3.5">{{ number_format($row->laki) }} jiwa</td>
                            <td class="px-6 py-3.5">{{ number_format($row->perempuan) }} jiwa</td>
                            <td class="px-6 py-3.5 font-extrabold text-slate-900">{{ number_format($row->total) }} jiwa</td>
                            <td class="px-6 py-3.5">
                                <div class="w-full bg-slate-100 rounded-full h-2">
                                    <div class="bg-rose-600 h-2 rounded-full" style="width: {{ ($row->total / $maxRtTotal) * 100 }}%"></div>
                                </div>
                            </td>
                            <td class="px-6 py-3.5">
                                <a href="{{ route('statistik', ['rt' => $row->rt]) }}" class="inline-flex items-center gap-1 text-xs font-bold text-rose-600 hover:text-rose-800">
                                    Lihat Detail &rarr;
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                Belum ada data statistik. Silakan input data melalui menu Statistik di Admin Dashboard.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    function switchTab(tabName) {
        document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('.stat-tab-btn').forEach(btn => {
            btn.classList.remove('bg-rose-600', 'text-white', 'shadow-sm', 'font-bold');
            btn.classList.add('text-slate-600', 'font-medium');
        });

        document.getElementById('content-' + tabName).classList.remove('hidden');
        var activeBtn = document.getElementById('tab-' + tabName);
        activeBtn.classList.add('bg-rose-600', 'text-white', 'shadow-sm', 'font-bold');
        activeBtn.classList.remove('text-slate-600', 'font-medium');
    }

    document.addEventListener('DOMContentLoaded', function() {
        @if($totalWarga > 0)
        // Chart Usia
        new Chart(document.getElementById('chartUsia'), {
            type: 'doughnut',
            data: {
                labels: ['Balita', 'Anak-anak', 'Remaja', 'Dewasa', 'Lansia'],
                datasets: [{
                    data: [{{ $usiaBalita }}, {{ $usiaAnak }}, {{ $usiaRemaja }}, {{ $usiaDewasa }}, {{ $usiaLansia }}],
                    backgroundColor: ['#fbbf24', '#38bdf8', '#14b8a6', '#4f46e5', '#f43f5e']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });

        // Chart Agama
        new Chart(document.getElementById('chartAgama'), {
            type: 'pie',
            data: {
                labels: ['Islam', 'Kristen', 'Katolik', 'Budha', 'Hindu', 'Lainnya'],
                datasets: [{
                    data: [
                        {{ $statAgama['Islam'] ?? 0 }},
                        {{ $statAgama['Kristen'] ?? 0 }},
                        {{ $statAgama['Katolik'] ?? 0 }},
                        {{ $statAgama['Budha'] ?? 0 }},
                        {{ $statAgama['Hindu'] ?? 0 }},
                        {{ $statAgama['Lainnya'] ?? 0 }}
                    ],
                    backgroundColor: ['#10b981', '#3b82f6', '#8b5cf6', '#f59e0b', '#ef4444', '#64748b']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });

        // Chart Pendidikan
        new Chart(document.getElementById('chartPendidikan'), {
            type: 'bar',
            data: {
                labels: ['Belum', 'SD', 'SMP', 'SMA', 'D1', 'D2', 'D3', 'S1', 'S2', 'S3'],
                datasets: [{
                    label: 'Jumlah Warga',
                    data: [
                        {{ $statPendidikan['Belum Sekolah'] ?? 0 }},
                        {{ $statPendidikan['SD'] ?? 0 }},
                        {{ $statPendidikan['SMP'] ?? 0 }},
                        {{ $statPendidikan['SMA'] ?? 0 }},
                        {{ $statPendidikan['D1'] ?? 0 }},
                        {{ $statPendidikan['D2'] ?? 0 }},
                        {{ $statPendidikan['D3'] ?? 0 }},
                        {{ $statPendidikan['S1'] ?? 0 }},
                        {{ $statPendidikan['S2'] ?? 0 }},
                        {{ $statPendidikan['S3'] ?? 0 }}
                    ],
                    backgroundColor: '#0284c7'
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } } }
        });

        // Chart Goldar
        new Chart(document.getElementById('chartGoldar'), {
            type: 'doughnut',
            data: {
                labels: ['Gol. A', 'Gol. B', 'Gol. AB', 'Gol. O'],
                datasets: [{
                    data: [
                        {{ $statGoldar['A'] ?? 0 }},
                        {{ $statGoldar['B'] ?? 0 }},
                        {{ $statGoldar['AB'] ?? 0 }},
                        {{ $statGoldar['O'] ?? 0 }}
                    ],
                    backgroundColor: ['#ef4444', '#f97316', '#a855f7', '#06b6d4']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { position: 'bottom' } } }
        });
        @endif
    });
</script>
@endsection
