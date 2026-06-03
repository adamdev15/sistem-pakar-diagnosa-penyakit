<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index()
    {
        $gejalas = Gejala::latest()->paginate(10);
        return view('gejala.index', compact('gejalas'));
    }

    public function create()
    {
        return view('gejala.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_gejala' => 'required|string|max:10|unique:gejalas',
            'nama_gejala' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Gejala::create($request->all());

        return redirect()->route('gejala.index')->with('success', 'Data Gejala berhasil ditambahkan.');
    }

    public function show(Gejala $gejala)
    {
        return view('gejala.show', compact('gejala'));
    }

    public function edit(Gejala $gejala)
    {
        return view('gejala.edit', compact('gejala'));
    }

    public function update(Request $request, Gejala $gejala)
    {
        $request->validate([
            'kode_gejala' => 'required|string|max:10|unique:gejalas,kode_gejala,' . $gejala->id,
            'nama_gejala' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $gejala->update($request->all());

        return redirect()->route('gejala.index')->with('success', 'Data Gejala berhasil diperbarui.');
    }

    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return redirect()->route('gejala.index')->with('success', 'Data Gejala berhasil dihapus.');
    }

    public function downloadTemplate()
    {
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=template_gejala.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0'
        ];

        $columns = ['Kode Gejala', 'Nama Gejala', 'Deskripsi', 'Status (aktif/nonaktif)'];

        $callback = function() use($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);
            fputcsv($file, ['G99', 'Gejala Contoh', 'Deskripsi singkat', 'aktif']);
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
        $header = fgetcsv($fileHandle);

        $imported = 0;
        while (($row = fgetcsv($fileHandle)) !== false) {
            if (count($row) >= 2 && !empty($row[0])) {
                Gejala::updateOrCreate(
                    ['kode_gejala' => trim($row[0])],
                    [
                        'nama_gejala' => trim($row[1]),
                        'deskripsi' => $row[2] ?? null,
                        'status' => strtolower(trim($row[3] ?? 'aktif')) == 'nonaktif' ? 'nonaktif' : 'aktif',
                    ]
                );
                $imported++;
            }
        }
        fclose($fileHandle);

        return redirect()->route('gejala.index')->with('success', "$imported Data Gejala berhasil diimport.");
    }
}
