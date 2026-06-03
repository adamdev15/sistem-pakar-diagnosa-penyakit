<x-app-layout>
    @section('header', 'Dashboard Sistem Pakar')

    @if(Auth::user()->role === 'admin')
        <!-- Admin Dashboard -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Card 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Penyakit</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalPenyakit }}</h3>
                </div>
                <div class="w-14 h-14 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Gejala</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalGejala }}</h3>
                </div>
                <div class="w-14 h-14 rounded-full bg-orange-50 flex items-center justify-center text-orange-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Rule / Aturan</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalAturan }}</h3>
                </div>
                <div class="w-14 h-14 rounded-full bg-purple-50 flex items-center justify-center text-purple-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex items-center justify-between hover:shadow-md transition-shadow">
                <div>
                    <p class="text-sm font-medium text-gray-500 mb-1">Total Diagnosa</p>
                    <h3 class="text-3xl font-bold text-gray-800">{{ $totalDiagnosa }}</h3>
                </div>
                <div class="w-14 h-14 rounded-full bg-green-50 flex items-center justify-center text-green-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Grafik Diagnosa Berdasarkan Penyakit</h3>
            <div class="relative h-80 w-full">
                <canvas id="diagnosaChart"></canvas>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const ctx = document.getElementById('diagnosaChart').getContext('2d');
                const chartLabels = {!! json_encode($chartLabels) !!};
                const chartData = {!! json_encode($chartData) !!};

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: chartLabels.length > 0 ? chartLabels : ['Belum ada data'],
                        datasets: [{
                            label: 'Jumlah Diagnosa',
                            data: chartData.length > 0 ? chartData : [0],
                            backgroundColor: 'rgba(34, 197, 94, 0.5)',
                            borderColor: 'rgb(34, 197, 94)',
                            borderWidth: 2,
                            borderRadius: 6,
                            hoverBackgroundColor: 'rgba(22, 163, 74, 0.7)'
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 1
                                },
                                grid: {
                                    color: '#f3f4f6'
                                }
                            },
                            x: {
                                grid: {
                                    display: false
                                }
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
    @else
        <!-- User Dashboard -->
        <div class="bg-white rounded-2xl p-8 shadow-sm border border-gray-100 text-center max-w-3xl mx-auto mt-10">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-4">Selamat Datang di Sistem Pakar Medis</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Sistem ini menggunakan metode Certainty Factor untuk membantu Anda melakukan diagnosa awal penyakit berdasarkan gejala yang Anda alami. Silakan klik tombol di bawah ini untuk memulai proses diagnosa.
            </p>
            <a href="{{ route('diagnosa.index') }}" class="inline-flex justify-center items-center px-6 py-3 border border-transparent rounded-full shadow-md text-base font-medium text-white bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all transform hover:-translate-y-1">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                Mulai Diagnosa Sekarang
            </a>
        </div>
    @endif
</x-app-layout>
