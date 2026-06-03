<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index()
    {
        $penyakits = Penyakit::latest()->paginate(10);
        return view('penyakit.index', compact('penyakits'));
    }

    public function create()
    {
        return view('penyakit.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_penyakit' => 'required|string|max:10|unique:penyakits',
            'nama_penyakit' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'penyebab' => 'nullable|string',
            'solusi' => 'nullable|string',
            'pencegahan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Penyakit::create($request->all());

        return redirect()->route('penyakit.index')->with('success', 'Data Penyakit berhasil ditambahkan.');
    }

    public function show(Penyakit $penyakit)
    {
        return view('penyakit.show', compact('penyakit'));
    }

    public function edit(Penyakit $penyakit)
    {
        return view('penyakit.edit', compact('penyakit'));
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        $request->validate([
            'kode_penyakit' => 'required|string|max:10|unique:penyakits,kode_penyakit,' . $penyakit->id,
            'nama_penyakit' => 'required|string|max:100',
            'deskripsi' => 'nullable|string',
            'penyebab' => 'nullable|string',
            'solusi' => 'nullable|string',
            'pencegahan' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $penyakit->update($request->all());

        return redirect()->route('penyakit.index')->with('success', 'Data Penyakit berhasil diperbarui.');
    }

    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        return redirect()->route('penyakit.index')->with('success', 'Data Penyakit berhasil dihapus.');
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=template_penyakit.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['Kode Penyakit', 'Nama Penyakit', 'Deskripsi', 'Penyebab', 'Solusi', 'Pencegahan', 'Status (aktif/nonaktif)'];

        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            // Contoh data
            fputcsv($file, ['P99', 'Penyakit Contoh', 'Deskripsi singkat', 'Virus/Bakteri', 'Istirahat', 'Cuci tangan', 'aktif']);
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file_csv' => 'required|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('file_csv');
        $fileHandle = fopen($file->getPathname(), 'r');
        $header = fgetcsv($fileHandle); // Skip header

        $imported = 0;
        while (($row = fgetcsv($fileHandle)) !== false) {
            // Asumsi urutan: Kode, Nama, Deskripsi, Penyebab, Solusi, Pencegahan, Status
            if (count($row) >= 2 && !empty($row[0])) {
                Penyakit::updateOrCreate(
                    ['kode_penyakit' => trim($row[0])],
                    [
                        'nama_penyakit' => trim($row[1]),
                        'deskripsi' => $row[2] ?? null,
                        'penyebab' => $row[3] ?? null,
                        'solusi' => $row[4] ?? null,
                        'pencegahan' => $row[5] ?? null,
                        'status' => strtolower(trim($row[6] ?? 'aktif')) == 'nonaktif' ? 'nonaktif' : 'aktif',
                    ]
                );
                $imported++;
            }
        }
        fclose($fileHandle);

        return redirect()->route('penyakit.index')->with('success', "$imported Data Penyakit berhasil diimport.");
    }
}
