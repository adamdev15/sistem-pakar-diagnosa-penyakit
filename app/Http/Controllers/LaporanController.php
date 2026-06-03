<?php

namespace App\Http\Controllers;

use App\Models\Diagnosa;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Diagnosa::with('hasil_penyakit')->latest()->paginate(15);
        return view('laporan.index', compact('laporans'));
    }

    public function show($id)
    {
        $diagnosa = Diagnosa::with(['hasil_penyakit', 'details.gejala', 'hasil_diagnosas.penyakit'])->findOrFail($id);
        
        $pdf = Pdf::loadView('laporan.pdf', compact('diagnosa'));
        
        // Optional: you can return download or stream. Stream opens in browser.
        return $pdf->stream('Hasil_Diagnosa_' . $diagnosa->kode_diagnosa . '.pdf');
    }
}
