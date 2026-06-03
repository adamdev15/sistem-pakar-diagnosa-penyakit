<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Hasil Diagnosa - {{ $diagnosa->kode_diagnosa }}</title>
    <style>
        body { font-family: 'Helvetica', 'Arial', sans-serif; font-size: 14px; color: #333; line-height: 1.6; margin: 0; padding: 20px; }
        .header { text-align: center; border-bottom: 2px solid #22c55e; padding-bottom: 20px; margin-bottom: 30px; }
        .logo { font-size: 28px; font-weight: bold; color: #166534; margin: 0; }
        .subtitle { font-size: 14px; color: #666; margin: 5px 0 0; }
        .section-title { font-size: 16px; font-weight: bold; color: #15803d; border-bottom: 1px solid #e5e7eb; padding-bottom: 5px; margin-top: 30px; margin-bottom: 15px; }
        .info-table { width: 100%; margin-bottom: 20px; }
        .info-table td { padding: 5px 0; }
        .info-table .label { font-weight: bold; width: 150px; color: #4b5563; }
        table.data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.data-table th, table.data-table td { border: 1px solid #e5e7eb; padding: 10px; text-align: left; }
        table.data-table th { background-color: #f0fdf4; color: #166534; font-weight: bold; }
        .result-box { background-color: #f0fdf4; border: 1px solid #22c55e; padding: 20px; text-align: center; border-radius: 8px; margin-top: 20px; }
        .result-title { font-size: 18px; color: #15803d; margin: 0 0 10px 0; }
        .result-value { font-size: 32px; font-weight: bold; color: #166534; margin: 0; }
        .footer { margin-top: 50px; text-align: right; }
        .signature { margin-top: 80px; font-weight: bold; text-decoration: underline; }
    </style>
</head>
<body>

    <div class="header">
        <img src="{{ public_path('images/logo-pakar.png') }}" style="width: 50px; height: auto; margin-bottom: 5px;" alt="Logo">
        <h1 class="logo">PakarMedis</h1>
        <p class="subtitle">Sistem Pakar Diagnosa Penyakit Menggunakan Metode Certainty Factor</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Kode Diagnosa</td>
            <td>: {{ $diagnosa->kode_diagnosa }}</td>
            <td class="label">Tanggal</td>
            <td>: {{ \Carbon\Carbon::parse($diagnosa->tanggal_diagnosa)->format('d F Y, H:i') }}</td>
        </tr>
        <tr>
            <td class="label">Nama Pasien</td>
            <td>: {{ $diagnosa->nama_pasien }}</td>
            <td class="label">Umur</td>
            <td>: {{ $diagnosa->umur }} Tahun</td>
        </tr>
        <tr>
            <td class="label">Jenis Kelamin</td>
            <td>: {{ $diagnosa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
            <td colspan="2"></td>
        </tr>
    </table>

    <div class="result-box">
        <h3 class="result-title">Hasil Diagnosa Penyakit: {{ $diagnosa->hasil_penyakit->nama_penyakit }}</h3>
        <p class="result-value">{{ $diagnosa->persentase }}%</p>
    </div>

    <h3 class="section-title">Gejala yang Dialami</h3>
    <table class="data-table">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="45%">Gejala</th>
                <th width="15%" style="text-align: center;">CF Pakar</th>
                <th width="15%" style="text-align: center;">CF User</th>
                <th width="20%" style="text-align: center;">Nilai (H,E)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diagnosa->details as $index => $detail)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ $detail->gejala->nama_gejala }}</td>
                    <td style="text-align: center;">{{ $detail->cf_pakar }}</td>
                    <td style="text-align: center;">{{ $detail->cf_user }}</td>
                    <td style="text-align: center;">{{ $detail->cf_hasil }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3 class="section-title">Saran Penanganan / Solusi</h3>
    <p style="text-align: justify;">{{ $diagnosa->hasil_penyakit->solusi ?? '-' }}</p>

    <div style="page-break-inside: avoid;">
        <h3 class="section-title">Kemungkinan Penyakit Lainnya</h3>
        <table class="data-table">
            <thead>
                <tr>
                    <th width="10%" style="text-align: center;">Ranking</th>
                    <th width="70%">Nama Penyakit</th>
                    <th width="20%" style="text-align: center;">Persentase</th>
                </tr>
            </thead>
            <tbody>
                @foreach($diagnosa->hasil_diagnosas as $hasil)
                    <tr>
                        <td style="text-align: center;">{{ $hasil->ranking }}</td>
                        <td>{{ $hasil->penyakit->nama_penyakit }}</td>
                        <td style="text-align: center;">{{ $hasil->persentase }}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Dicetak pada: {{ now()->format('d F Y') }}</p>
        <p class="signature">Sistem PakarMedis</p>
    </div>

</body>
</html>
