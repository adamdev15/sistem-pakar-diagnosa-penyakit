<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Penyakit;
use App\Models\Diagnosa;
use App\Models\DiagnosaDetail;
use App\Models\HasilDiagnosa;
use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DiagnosaController extends Controller
{
    protected $cfService;

    public function __construct(CertaintyFactorService $cfService)
    {
        $this->cfService = $cfService;
    }

    public function index()
    {
        $gejalas = Gejala::where('status', 'aktif')->get();
        
        // Options for "Tingkat Keyakinan"
        $keyakinan = [
            ['nilai' => 0, 'label' => 'Tidak'],
            ['nilai' => 0.4, 'label' => 'Cukup Yakin'],
            ['nilai' => 0.6, 'label' => 'Yakin'],
            ['nilai' => 1.0, 'label' => 'Sangat Yakin'],
        ];

        return view('diagnosa.index', compact('gejalas', 'keyakinan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pasien' => 'required|string|max:100',
            'jenis_kelamin' => 'required|in:L,P',
            'umur' => 'required|integer|min:1',
            'gejala' => 'required|array',
        ]);

        // Filter out symptoms with 0 confidence
        $userInputs = [];
        foreach ($request->gejala as $gejalaId => $cfUser) {
            if ($cfUser > 0) {
                $userInputs[$gejalaId] = (float) $cfUser;
            }
        }

        if (empty($userInputs)) {
            return back()->with('error', 'Anda harus memilih minimal satu gejala dengan tingkat keyakinan.')->withInput();
        }

        // Calculate CF
        $hasilPerhitungan = $this->cfService->calculate($userInputs);

        if (empty($hasilPerhitungan)) {
            return back()->with('error', 'Tidak dapat mendiagnosa penyakit berdasarkan gejala yang dipilih.')->withInput();
        }

        // Top result
        $topResult = $hasilPerhitungan[0];

        // Save to Database
        $diagnosa = Diagnosa::create([
            'kode_diagnosa' => 'DG-' . strtoupper(Str::random(6)),
            'nama_pasien' => $request->nama_pasien,
            'jenis_kelamin' => $request->jenis_kelamin,
            'umur' => $request->umur,
            'tanggal_diagnosa' => now(),
            'hasil_penyakit_id' => $topResult['penyakit_id'],
            'nilai_cf' => $topResult['nilai_cf'],
            'persentase' => $topResult['persentase']
        ]);

        // Save Hasil Ranking
        foreach ($hasilPerhitungan as $index => $hasil) {
            HasilDiagnosa::create([
                'diagnosa_id' => $diagnosa->id,
                'penyakit_id' => $hasil['penyakit_id'],
                'nilai_cf' => $hasil['nilai_cf'],
                'persentase' => $hasil['persentase'],
                'ranking' => $index + 1
            ]);

            // Save details only for the top result or all? The blueprint implies details are saved for the top result
            if ($index == 0) {
                foreach ($hasil['gejala_dipilih'] as $detail) {
                    DiagnosaDetail::create([
                        'diagnosa_id' => $diagnosa->id,
                        'gejala_id' => $detail['gejala_id'],
                        'cf_user' => $detail['cf_user'],
                        'cf_pakar' => $detail['cf_pakar'],
                        'cf_hasil' => $detail['cf_hasil'],
                    ]);
                }
            }
        }

        return redirect()->route('diagnosa.show', $diagnosa->id)->with('success', 'Diagnosa berhasil dilakukan.');
    }

    public function show(Diagnosa $diagnosa)
    {
        $diagnosa->load(['hasil_penyakit', 'details.gejala', 'hasil_diagnosas.penyakit']);
        return view('diagnosa.show', compact('diagnosa'));
    }
}
