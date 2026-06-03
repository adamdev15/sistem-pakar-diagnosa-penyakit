<x-app-layout>
    @section('header', 'Hasil Diagnosa')

    <div class="max-w-6xl mx-auto space-y-6">
        <!-- Ringkasan Header -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
            <div class="absolute top-0 right-0 p-8 opacity-10 hidden md:block">
                <svg class="w-48 h-48 text-green-500" fill="currentColor" viewBox="0 0 24 24"><path d="M11 2v4c0 1.1-.9 2-2 2H5v14h14v-8h4V2H11zm-2 4H5V4h4v2zm12 4h-4v-2h4v2z"/></svg>
            </div>
            
            <div class="p-8 md:p-10 relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center">
                <div class="mb-6 md:mb-0">
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold tracking-wide uppercase mb-3">{{ $diagnosa->kode_diagnosa }}</span>
                    <h2 class="text-3xl font-bold text-gray-800 mb-1">Pasien: {{ $diagnosa->nama_pasien }}</h2>
                    <p class="text-gray-500 flex items-center">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        {{ \Carbon\Carbon::parse($diagnosa->tanggal_diagnosa)->translatedFormat('l, d F Y H:i') }}
                        <span class="mx-3 border-l border-gray-300 h-4"></span>
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        {{ $diagnosa->umur }} Tahun ({{ $diagnosa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }})
                    </p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-2xl p-6 text-center shadow-inner min-w-[250px]">
                    <p class="text-green-800 font-semibold text-sm mb-1 uppercase tracking-wider">Hasil Diagnosa Utama</p>
                    <h3 class="text-3xl font-extrabold text-green-700 mb-1">{{ $diagnosa->hasil_penyakit->nama_penyakit }}</h3>
                    <div class="flex items-center justify-center">
                        <span class="text-4xl font-black text-gray-900 mr-1">{{ $diagnosa->persentase }}</span>
                        <span class="text-xl font-bold text-gray-600">%</span>
                    </div>
                </div>
            </div>
            
            <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-end">
                <a href="{{ route('laporan.show', $diagnosa->id) }}" target="_blank" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                    <svg class="w-4 h-4 mr-2 text-red-500" fill="currentColor" viewBox="0 0 24 24"><path d="M11.362 2c4.156 0 2.638 6 2.638 6s6-1.65 6 2.457v11.543h-16v-20h7.362zm.827-2h-10.189v24h20v-14.386c0-2.391-6.648-9.614-9.811-9.614zm4.811 13h-2.628v3.686h.907v-1.472h1.49v-.732h-1.49v-.698h1.721v-.784zm-4.9 0h-1.599v3.686h1.599c.537 0 .961-.181 1.262-.535.555-.658.587-2.034-.062-2.692-.298-.3-.712-.459-1.2-.459zm-.692.783h.496c.473 0 .802.173.915.299.25.253.207 1.144.026 1.487-.14.269-.475.334-.941.334h-.496v-2.12zm-3.408-.783h-2v3.686h.897v-1.22h1.103c.513 0 .937-.156 1.222-.449.278-.285.421-.692.421-1.196 0-.528-.153-.941-.448-1.218-.288-.271-.703-.403-1.195-.403zm-1.103.702h.931c.338 0 .584.072.721.206.136.13.207.348.207.63 0 .285-.069.5-.202.628-.135.13-.377.201-.709.201h-.948v-1.665z"/></svg>
                    Cetak PDF
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column: Penanganan & Gejala -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Info Penyakit -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800">Detail Penyakit & Saran Penanganan</h3>
                    </div>
                    <div class="p-6 prose prose-green max-w-none text-sm">
                        <div class="mb-4">
                            <h4 class="text-gray-900 font-bold mb-1">Deskripsi</h4>
                            <p class="text-gray-600">{{ $diagnosa->hasil_penyakit->deskripsi ?? 'Tidak ada deskripsi tersedia.' }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-gray-900 font-bold mb-1">Penyebab</h4>
                            <p class="text-gray-600">{{ $diagnosa->hasil_penyakit->penyebab ?? 'Tidak ada data penyebab tersedia.' }}</p>
                        </div>
                        <div class="mb-4">
                            <h4 class="text-gray-900 font-bold mb-1">Solusi / Pengobatan</h4>
                            <div class="p-4 bg-green-50 rounded-lg text-green-800 border border-green-100">
                                {{ $diagnosa->hasil_penyakit->solusi ?? 'Sebaiknya segera konsultasikan ke dokter atau fasilitas kesehatan terdekat.' }}
                            </div>
                        </div>
                        <div>
                            <h4 class="text-gray-900 font-bold mb-1">Pencegahan</h4>
                            <p class="text-gray-600">{{ $diagnosa->hasil_penyakit->pencegahan ?? 'Terapkan pola hidup sehat dan bersih.' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Gejala Dipilih -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800">Gejala yang Dipilih & Perhitungan CF</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm">
                            <thead class="bg-gray-50 text-gray-600 font-medium border-b border-gray-100">
                                <tr>
                                    <th class="py-3 px-4">No</th>
                                    <th class="py-3 px-4">Gejala</th>
                                    <th class="py-3 px-4 text-center">CF Pakar</th>
                                    <th class="py-3 px-4 text-center">CF User</th>
                                    <th class="py-3 px-4 text-center">Hasil (H,E)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($diagnosa->details as $index => $detail)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4">{{ $index + 1 }}</td>
                                        <td class="py-3 px-4 font-medium text-gray-800">{{ $detail->gejala->nama_gejala }}</td>
                                        <td class="py-3 px-4 text-center"><span class="bg-gray-100 px-2 py-1 rounded text-gray-600">{{ $detail->cf_pakar }}</span></td>
                                        <td class="py-3 px-4 text-center"><span class="bg-blue-50 text-blue-700 px-2 py-1 rounded">{{ $detail->cf_user }}</span></td>
                                        <td class="py-3 px-4 text-center font-bold text-green-600">{{ $detail->cf_hasil }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Column: Ranking & Chart -->
            <div class="space-y-6">
                <!-- Ranking Penyakit -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800">Kemungkinan Penyakit Lain</h3>
                    </div>
                    <div class="p-4 space-y-4">
                        @foreach($diagnosa->hasil_diagnosas as $hasil)
                            <div class="flex items-center justify-between p-3 rounded-xl {{ $hasil->ranking == 1 ? 'bg-green-50 border border-green-200' : 'bg-gray-50 border border-transparent' }}">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold text-sm mr-3 {{ $hasil->ranking == 1 ? 'bg-green-600 text-white shadow-md' : 'bg-gray-200 text-gray-600' }}">
                                        {{ $hasil->ranking }}
                                    </div>
                                    <div>
                                        <p class="font-bold {{ $hasil->ranking == 1 ? 'text-green-800' : 'text-gray-700' }}">{{ $hasil->penyakit->nama_penyakit }}</p>
                                        <p class="text-xs text-gray-500">Nilai CF: {{ $hasil->nilai_cf }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="font-black text-lg {{ $hasil->ranking == 1 ? 'text-green-600' : 'text-gray-800' }}">{{ $hasil->persentase }}%</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <!-- Radar Chart -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-6 border-b border-gray-100">
                        <h3 class="text-lg font-bold text-gray-800">Grafik Keyakinan</h3>
                    </div>
                    <div class="p-4 h-64 relative">
                        <canvas id="rankingChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Setup -->
    @php
        $labels = $diagnosa->hasil_diagnosas->pluck('penyakit.nama_penyakit');
        $data = $diagnosa->hasil_diagnosas->pluck('persentase');
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('rankingChart').getContext('2d');
            const labels = {!! json_encode($labels) !!};
            const data = {!! json_encode($data) !!};

            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Persentase Keyakinan',
                        data: data,
                        backgroundColor: 'rgba(34, 197, 94, 0.2)',
                        borderColor: 'rgba(34, 197, 94, 1)',
                        pointBackgroundColor: 'rgba(34, 197, 94, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(34, 197, 94, 1)',
                        borderWidth: 2,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        r: {
                            angleLines: {
                                display: true
                            },
                            suggestedMin: 0,
                            suggestedMax: 100
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
