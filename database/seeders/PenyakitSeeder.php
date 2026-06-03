<?php

namespace Database\Seeders;

use App\Models\Penyakit;
use Illuminate\Database\Seeder;

class PenyakitSeeder extends Seeder
{
    public function run(): void
    {
        $penyakits = [
            [
                'kode_penyakit' => 'P01',
                'nama_penyakit' => 'Demam Berdarah Dengue (DBD)',
                'deskripsi' => 'Penyakit infeksi yang disebabkan oleh virus Dengue dan ditularkan melalui gigitan nyamuk Aedes aegypti.',
                'penyebab' => 'Virus Dengue tipe 1, 2, 3, dan 4.',
                'solusi' => 'Banyak minum cairan, istirahat cukup, minum obat penurun panas (paracetamol), dan segera ke rumah sakit jika kondisi memburuk.',
                'pencegahan' => 'Melakukan 3M Plus (Menguras, Menutup, Mengubur tempat penampungan air) dan menggunakan anti nyamuk.',
                'status' => 'aktif',
            ],
            [
                'kode_penyakit' => 'P02',
                'nama_penyakit' => 'Tifus (Demam Tifoid)',
                'deskripsi' => 'Penyakit infeksi bakteri pada usus dan aliran darah.',
                'penyebab' => 'Bakteri Salmonella typhi yang menyebar melalui makanan atau air yang terkontaminasi.',
                'solusi' => 'Pemberian antibiotik oleh dokter, istirahat total, dan konsumsi makanan lunak.',
                'pencegahan' => 'Menjaga kebersihan makanan dan minuman, mencuci tangan sebelum makan, dan vaksinasi tifoid.',
                'status' => 'aktif',
            ],
            [
                'kode_penyakit' => 'P03',
                'nama_penyakit' => 'Malaria',
                'deskripsi' => 'Penyakit mematikan yang ditularkan melalui gigitan nyamuk yang terinfeksi parasit.',
                'penyebab' => 'Parasit Plasmodium yang ditularkan melalui gigitan nyamuk Anopheles betina.',
                'solusi' => 'Pemberian obat antimalaria (seperti ACT) sesuai resep dokter.',
                'pencegahan' => 'Tidur menggunakan kelambu, memakai losion anti nyamuk, dan membersihkan sarang nyamuk.',
                'status' => 'aktif',
            ]
        ];

        foreach ($penyakits as $penyakit) {
            Penyakit::create($penyakit);
        }
    }
}
