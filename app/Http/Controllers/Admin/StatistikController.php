<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\StatistikRw;
use App\Models\StatistikRwDetail;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class StatistikController extends Controller
{
    protected const FIELDS = [
        'laki', 'perempuan',
        'balita', 'anak', 'remaja', 'dewasa', 'lansia',
        'islam', 'kristen', 'katolik', 'budha', 'hindu', 'lainnya',
        'belum_sekolah', 'sd', 'smp', 'sma', 'd1', 'd2', 'd3', 's1', 's2', 's3',
        'goldar_a', 'goldar_b', 'goldar_ab', 'goldar_o',
    ];

    public function index()
    {
        $statistik = StatistikRwDetail::orderBy('rt')->get();
        $daftarRt = Warga::select('rt')->whereNotNull('rt')->where('rt', '!=', '')->distinct()->pluck('rt')
            ->merge(StatistikRwDetail::query()->pluck('rt'))
            ->unique()
            ->sort(SORT_NATURAL)
            ->values();

        $statistikRw = null;
        if (Schema::hasTable('statistik_rw')) {
            $statistikRw = StatistikRw::firstOrCreate(['id' => 1], ['jumlah_rumah_bangunan' => 0]);
        }

        return view('admin.statistik.index', compact('statistik', 'daftarRt', 'statistikRw'));
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['rt'] = $request->validate(['rt' => 'required|string|max:3|unique:statistik_rw_detail,rt'])['rt'];

        $statistik = StatistikRwDetail::create($data);

        ActivityLog::log('create', $statistik, 'Statistik RT '.$statistik->rt, null, $statistik->only(array_merge(['rt'], self::FIELDS)));

        return redirect()->route('admin.statistik.index')->with('success', 'Statistik RT '.$statistik->rt.' berhasil ditambahkan.');
    }

    public function update(Request $request, StatistikRwDetail $statistik)
    {
        $data = $this->validated($request);

        $old = $statistik->only(self::FIELDS);
        $statistik->update($data);

        ActivityLog::log('update', $statistik, 'Statistik RT '.$statistik->rt, $old, $statistik->only(array_keys($data)));

        return redirect()->route('admin.statistik.index')->with('success', 'Statistik RT '.$statistik->rt.' berhasil diperbarui.');
    }

    public function destroy(StatistikRwDetail $statistik)
    {
        $old = $statistik->only(array_merge(['rt'], self::FIELDS));

        ActivityLog::log('delete', $statistik, 'Statistik RT '.$statistik->rt, $old, null);

        $statistik->delete();

        return redirect()->route('admin.statistik.index')->with('success', 'Statistik RT '.$statistik->rt.' berhasil dihapus.');
    }

    protected function validated(Request $request): array
    {
        $rules = [];
        foreach (self::FIELDS as $field) {
            $rules[$field] = 'nullable|integer|min:0';
        }

        return $request->validate($rules, [], array_fill_keys(self::FIELDS, ''));
    }
}
