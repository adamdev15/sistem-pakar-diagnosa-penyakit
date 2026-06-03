<?php

namespace Database\Seeders;

use App\Models\Aturan;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Database\Seeder;

class AturanSeeder extends Seeder
{
    public function run(): void
    {
        // Pastikan tabel Penyakit dan Gejala sudah terisi
        $p_dbd = Penyakit::where('kode_penyakit', 'P01')->first();
        $p_tifus = Penyakit::where('kode_penyakit', 'P02')->first();
        $p_malaria = Penyakit::where('kode_penyakit', 'P03')->first();

        $g = [];
        for ($i = 1; $i <= 13; $i++) {
            $kode = 'G' . str_pad($i, 2, '0', STR_PAD_LEFT);
            $g[$kode] = Gejala::where('kode_gejala', $kode)->first()->id;
        }

        $aturans = [
            // Aturan DBD
            ['penyakit_id' => $p_dbd->id, 'gejala_id' => $g['G01'], 'cf_pakar' => 0.8],
            ['penyakit_id' => $p_dbd->id, 'gejala_id' => $g['G02'], 'cf_pakar' => 0.4],
            ['penyakit_id' => $p_dbd->id, 'gejala_id' => $g['G03'], 'cf_pakar' => 0.8],
            ['penyakit_id' => $p_dbd->id, 'gejala_id' => $g['G04'], 'cf_pakar' => 0.6],
            ['penyakit_id' => $p_dbd->id, 'gejala_id' => $g['G05'], 'cf_pakar' => 0.9],
            ['penyakit_id' => $p_dbd->id, 'gejala_id' => $g['G06'], 'cf_pakar' => 0.4],

            // Aturan Tifus
            ['penyakit_id' => $p_tifus->id, 'gejala_id' => $g['G07'], 'cf_pakar' => 0.8],
            ['penyakit_id' => $p_tifus->id, 'gejala_id' => $g['G08'], 'cf_pakar' => 0.7],
            ['penyakit_id' => $p_tifus->id, 'gejala_id' => $g['G09'], 'cf_pakar' => 0.6],
            ['penyakit_id' => $p_tifus->id, 'gejala_id' => $g['G10'], 'cf_pakar' => 0.9],
            ['penyakit_id' => $p_tifus->id, 'gejala_id' => $g['G02'], 'cf_pakar' => 0.5],
            ['penyakit_id' => $p_tifus->id, 'gejala_id' => $g['G06'], 'cf_pakar' => 0.5],

            // Aturan Malaria
            ['penyakit_id' => $p_malaria->id, 'gejala_id' => $g['G11'], 'cf_pakar' => 0.9],
            ['penyakit_id' => $p_malaria->id, 'gejala_id' => $g['G12'], 'cf_pakar' => 0.8],
            ['penyakit_id' => $p_malaria->id, 'gejala_id' => $g['G01'], 'cf_pakar' => 0.6],
            ['penyakit_id' => $p_malaria->id, 'gejala_id' => $g['G02'], 'cf_pakar' => 0.6],
            ['penyakit_id' => $p_malaria->id, 'gejala_id' => $g['G06'], 'cf_pakar' => 0.4],
            ['penyakit_id' => $p_malaria->id, 'gejala_id' => $g['G13'], 'cf_pakar' => 0.7],
        ];

        foreach ($aturans as $aturan) {
            Aturan::create($aturan);
        }
    }
}
