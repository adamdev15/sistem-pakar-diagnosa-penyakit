<?php

namespace Database\Seeders;

use App\Models\Gejala;
use Illuminate\Database\Seeder;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        $gejalas = [
            ['kode_gejala' => 'G01', 'nama_gejala' => 'Demam tinggi mendadak', 'deskripsi' => 'Suhu tubuh > 38.5 C', 'status' => 'aktif'],
            ['kode_gejala' => 'G02', 'nama_gejala' => 'Sakit kepala', 'deskripsi' => 'Nyeri pada bagian kepala', 'status' => 'aktif'],
            ['kode_gejala' => 'G03', 'nama_gejala' => 'Nyeri di belakang mata', 'deskripsi' => 'Sakit saat bola mata digerakkan', 'status' => 'aktif'],
            ['kode_gejala' => 'G04', 'nama_gejala' => 'Nyeri otot dan sendi', 'deskripsi' => 'Badan terasa pegal linu berat', 'status' => 'aktif'],
            ['kode_gejala' => 'G05', 'nama_gejala' => 'Bintik merah pada kulit', 'deskripsi' => 'Ruam kemerahan yang tidak hilang saat ditekan', 'status' => 'aktif'],
            ['kode_gejala' => 'G06', 'nama_gejala' => 'Mual dan muntah', 'deskripsi' => 'Perut terasa tidak nyaman dan ingin muntah', 'status' => 'aktif'],
            ['kode_gejala' => 'G07', 'nama_gejala' => 'Demam perlahan', 'deskripsi' => 'Suhu tubuh naik perlahan terutama malam hari', 'status' => 'aktif'],
            ['kode_gejala' => 'G08', 'nama_gejala' => 'Gangguan pencernaan', 'deskripsi' => 'Diare atau sembelit', 'status' => 'aktif'],
            ['kode_gejala' => 'G09', 'nama_gejala' => 'Nyeri perut', 'deskripsi' => 'Perut terasa sakit atau kram', 'status' => 'aktif'],
            ['kode_gejala' => 'G10', 'nama_gejala' => 'Lidah putih', 'deskripsi' => 'Bagian tengah lidah berwarna putih', 'status' => 'aktif'],
            ['kode_gejala' => 'G11', 'nama_gejala' => 'Badan menggigil', 'deskripsi' => 'Gemetar dan merasa sangat kedinginan', 'status' => 'aktif'],
            ['kode_gejala' => 'G12', 'nama_gejala' => 'Berkeringat banyak', 'deskripsi' => 'Keringat berlebih setelah demam turun', 'status' => 'aktif'],
            ['kode_gejala' => 'G13', 'nama_gejala' => 'Kelelahan', 'deskripsi' => 'Merasa sangat lemas dan tidak bertenaga', 'status' => 'aktif'],
        ];

        foreach ($gejalas as $gejala) {
            Gejala::create($gejala);
        }
    }
}
