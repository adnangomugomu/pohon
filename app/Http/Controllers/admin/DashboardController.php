<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\Pohon;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'header' => 'Dashboard',
            'breadcrumb' => ['Dashboard', 'index']
        ];

        $data['total_user'] = User::count();
        $data['total_pohon'] = Pohon::count();
        $data['total_laporan'] = Laporan::count();

        $data['bulan'] = [
            'Januari' => 1,
            'Februari' => 2,
            'Maret' => 3,
            'April' => 4,
            'Mei' => 5,
            'Juni' => 6,
            'Juli' => 7,
            'Agustus' => 8,
            'September' => 9,
            'Oktober' => 10,
            'November' => 11,
            'Desember' => 12,
        ];

        $data['tahun'] = [2023, 2024, 2025];
        return view('admin.dashboard', $data);
    }

    public function grafik_laporan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;

        $grafik = Laporan::selectRaw('count(1) as total, date(created_at) as waktu')
            ->whereRaw("month(created_at) = '$bulan' and year(created_at) = '$tahun'")
            ->groupBy('waktu')
            ->orderBy('waktu', 'asc')
            ->get();

        $kategori = [];
        $series = [];
        foreach ($grafik as $dt) {
            $kategori[] = $dt->waktu;
            $series[] = (int)$dt->total;
        }

        echo json_encode([
            'status' => 'success',
            'grafik' => [
                'kategori' => $kategori,
                'series' => $series,
            ]
        ]);
    }
}
