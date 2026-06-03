<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Aturan;
use App\Models\Diagnosa;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPenyakit = Penyakit::count();
        $totalGejala = Gejala::count();
        $totalAturan = Aturan::count();
        $totalDiagnosa = Diagnosa::count();

        // Data for Chart (e.g. Diagnosa per Penyakit)
        $diagnosaPerPenyakit = Diagnosa::selectRaw('hasil_penyakit_id, count(*) as total')
                                ->whereNotNull('hasil_penyakit_id')
                                ->groupBy('hasil_penyakit_id')
                                ->with('hasil_penyakit')
                                ->get();

        $chartLabels = [];
        $chartData = [];
        foreach($diagnosaPerPenyakit as $d) {
            $chartLabels[] = $d->hasil_penyakit ? $d->hasil_penyakit->nama_penyakit : 'Tidak Diketahui';
            $chartData[] = $d->total;
        }

        return view('dashboard', compact('totalPenyakit', 'totalGejala', 'totalAturan', 'totalDiagnosa', 'chartLabels', 'chartData'));
    }
}
