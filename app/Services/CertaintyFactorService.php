<?php

namespace App\Services;

use App\Models\Penyakit;
use App\Models\Aturan;

class CertaintyFactorService
{
    /**
     * Calculate Certainty Factor based on user inputs.
     * 
     * @param array $userInputs Array of gejala_id => cf_user
     * @return array
     */
    public function calculate(array $userInputs)
    {
        $penyakits = Penyakit::where('status', 'aktif')->get();
        $results = [];
        $detailPerhitungan = [];

        foreach ($penyakits as $penyakit) {
            // Get all rules for this penyakit
            $aturans = Aturan::where('penyakit_id', $penyakit->id)->get();
            
            if ($aturans->isEmpty()) {
                continue;
            }

            $cfKombinasi = 0;
            $cfLama = 0;
            $gejalaPenyakitDipilih = [];

            foreach ($aturans as $index => $aturan) {
                // If user didn't select this gejala, cf_user is 0
                $cfUser = isset($userInputs[$aturan->gejala_id]) ? $userInputs[$aturan->gejala_id] : 0;
                
                if ($cfUser > 0) {
                    // CF(H,E) = CF_pakar * CF_user
                    $cfHasil = $aturan->cf_pakar * $cfUser;

                    $gejalaPenyakitDipilih[] = [
                        'gejala_id' => $aturan->gejala_id,
                        'cf_user' => $cfUser,
                        'cf_pakar' => $aturan->cf_pakar,
                        'cf_hasil' => $cfHasil
                    ];

                    // Kombinasi CF
                    if ($cfLama == 0) {
                        $cfLama = $cfHasil;
                        $cfKombinasi = $cfHasil;
                    } else {
                        $cfKombinasi = $cfLama + $cfHasil * (1 - $cfLama);
                        $cfLama = $cfKombinasi;
                    }
                }
            }

            if ($cfKombinasi > 0) {
                $results[] = [
                    'penyakit_id' => $penyakit->id,
                    'nama_penyakit' => $penyakit->nama_penyakit,
                    'nilai_cf' => $cfKombinasi,
                    'persentase' => round($cfKombinasi * 100, 2),
                    'gejala_dipilih' => $gejalaPenyakitDipilih
                ];
            }
        }

        // Urutkan dari yang terbesar ke terkecil berdasarkan nilai_cf
        usort($results, function($a, $b) {
            return $b['nilai_cf'] <=> $a['nilai_cf'];
        });

        return $results;
    }
}
