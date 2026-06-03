<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;

class AturanController extends Controller
{
    public function index()
    {
        $aturans = Aturan::with(['penyakit', 'gejala'])->latest()->paginate(15);
        return view('aturan.index', compact('aturans'));
    }

    public function create()
    {
        $penyakits = Penyakit::where('status', 'aktif')->get();
        $gejalas = Gejala::where('status', 'aktif')->get();
        return view('aturan.create', compact('penyakits', 'gejalas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyakit_id' => 'required|exists:penyakits,id',
            'gejala_id' => 'required|exists:gejalas,id',
            'cf_pakar' => 'required|numeric|min:0|max:1',
        ]);

        // Check if rule already exists
        $exists = Aturan::where('penyakit_id', $request->penyakit_id)
                        ->where('gejala_id', $request->gejala_id)
                        ->first();
                        
        if ($exists) {
            return back()->with('error', 'Aturan untuk Penyakit dan Gejala ini sudah ada.')->withInput();
        }

        Aturan::create($request->all());

        return redirect()->route('aturan.index')->with('success', 'Data Aturan berhasil ditambahkan.');
    }

    public function show(Aturan $aturan)
    {
        return view('aturan.show', compact('aturan'));
    }

    public function edit(Aturan $aturan)
    {
        $penyakits = Penyakit::where('status', 'aktif')->get();
        $gejalas = Gejala::where('status', 'aktif')->get();
        return view('aturan.edit', compact('aturan', 'penyakits', 'gejalas'));
    }

    public function update(Request $request, Aturan $aturan)
    {
        $request->validate([
            'penyakit_id' => 'required|exists:penyakits,id',
            'gejala_id' => 'required|exists:gejalas,id',
            'cf_pakar' => 'required|numeric|min:0|max:1',
        ]);

        // Check if rule already exists but not this one
        $exists = Aturan::where('penyakit_id', $request->penyakit_id)
                        ->where('gejala_id', $request->gejala_id)
                        ->where('id', '!=', $aturan->id)
                        ->first();
                        
        if ($exists) {
            return back()->with('error', 'Aturan untuk Penyakit dan Gejala ini sudah ada.')->withInput();
        }

        $aturan->update($request->all());

        return redirect()->route('aturan.index')->with('success', 'Data Aturan berhasil diperbarui.');
    }

    public function destroy(Aturan $aturan)
    {
        $aturan->delete();
        return redirect()->route('aturan.index')->with('success', 'Data Aturan berhasil dihapus.');
    }
}
