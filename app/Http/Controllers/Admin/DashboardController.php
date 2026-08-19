<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\Pengumuman;
use App\Models\Pengurus;
use App\Models\StatistikRw;
use App\Models\StatistikRwDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DashboardController extends Controller
{
    public function index()
    {
        $statistikDetail = StatistikRwDetail::orderBy('rt')->get();
        $totalWarga = $statistikDetail->sum('total');
        $wargaLaki = $statistikDetail->sum('laki');
        $wargaPerempuan = $statistikDetail->sum('perempuan');
        $wargaPerRt = $statistikDetail->map(function ($row) {
            return (object) [
                'rt' => $row->rt,
                'total' => $row->total,
            ];
        });
        $maxRt = $wargaPerRt->max('total') ?: 1;

        $totalUsers = User::count();
        $pengumumanAktif = Pengumuman::where('status', 'aktif')->count();
        $totalPengumuman = Pengumuman::count();
        $kegiatanMendatang = Kegiatan::where('status', 'akan_datang')->count();
        $kegiatanSelesai = Kegiatan::where('status', 'selesai')->count();
        $totalKegiatan = Kegiatan::count();
        $recentPengumuman = Pengumuman::latest()->take(5)->get();
        $recentKegiatan = Kegiatan::latest()->take(5)->get();
        $pengurusList = Pengurus::latest()->take(5)->get();
        $totalPengurus = Pengurus::count();
        $role = auth()->user()?->role ?? 'guest';

        $statistikRw = null;
        if (Schema::hasTable('statistik_rw')) {
            $statistikRw = StatistikRw::find(1);
        }

        return view('admin.dashboard', compact(
            'totalWarga', 'totalUsers',
            'pengumumanAktif', 'totalPengumuman',
            'kegiatanMendatang', 'kegiatanSelesai', 'totalKegiatan',
            'recentPengumuman', 'recentKegiatan', 'role',
            'wargaPerRt', 'maxRt',
            'wargaLaki', 'wargaPerempuan', 'statistikRw',
            'pengurusList', 'totalPengurus'
        ));
    }

    public function updateStatistikRw(Request $request)
    {
        $validated = $request->validate([
            'jumlah_rumah_bangunan' => 'required|integer|min:0',
        ]);

        $statistik = StatistikRw::firstOrCreate(['id' => 1], ['jumlah_rumah_bangunan' => 0]);
        $statistik->update($validated);

        return redirect()->back()->with('success', 'Jumlah rumah & bangunan berhasil diperbarui!');
    }
}
