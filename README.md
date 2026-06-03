<div align="center">
  <img src="public/images/logo-pakar.png" alt="PakarMedis Logo" width="150" height="auto" />
  <h1>PakarMedis - Sistem Pakar Diagnosa Penyakit</h1>
  <p><em>Implementasi Metode Certainty Factor Berbasis Web</em></p>
  
  [![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
  [![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
  [![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
  [![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
  [![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
</div>

---

## 📖 Deskripsi Proyek

**PakarMedis** merupakan aplikasi sistem pakar berbasis web yang dirancang untuk membantu pengguna dalam melakukan diagnosa awal terhadap penyakit tropis atau gejala penyakit umum. Sistem ini mengadopsi konsep kecerdasan buatan (Sistem Pakar) dengan memanfaatkan pengetahuan dari pakar (dokter/tenaga medis) yang direpresentasikan dalam bentuk aturan (_rule_) dan nilai probabilitas berbasis **Certainty Factor (CF)**.

Pengguna dapat memilih gejala yang dirasakan serta menentukan tingkat keyakinan (seberapa yakin/pasti) terhadap setiap gejala yang dialami. Hasil dari sistem berupa **persentase keyakinan penyakit**, _ranking_ kemungkinan penyakit lainnya, hingga saran penanganan awal dan dapat dicetak dalam bentuk dokumen **PDF**.

---

## 🛠 Teknologi yang Digunakan

| Komponen | Teknologi |
| :--- | :--- |
| **Framework** | Laravel |
| **Database** | MySQL |
| **Frontend** | Tailwind CSS & Alpine.js |
| **Authentication** | Laravel Breeze |
| **PDF Generator** | DomPDF |
| **Data Visualization** | Chart.js |

---

## ✨ Fitur Utama

Sistem ini memiliki dua peran utama dengan fitur masing-masing:

### 👨‍💻 Administrator
- **Login Terotorisasi:** Akses panel admin dengan keamanan bawaan Laravel Breeze.
- **Kelola Data Penyakit:** Tambah, edit, hapus, dan _import massal_ (CSV) data penyakit.
- **Kelola Data Gejala:** Manajemen data gejala beserta _import_ (CSV).
- **Basis Pengetahuan (Rule Base):** Konfigurasi dan pengaturan nilai CF Pakar untuk koneksi gejala ke penyakit.
- **Manajemen Pengguna:** Kelola data pengguna atau admin lainnya (CRUD).
- **Riwayat Diagnosa:** Akses data log pasien/pengguna yang telah melakukan diagnosa.
- **Dashboard Statistik:** Visualisasi data yang informatif dengan grafik interaktif.
- **Cetak Laporan:** Konversi log rekam medis ke bentuk PDF.

### 👥 Pengguna / Pasien
- **Identitas Pasien:** Formulir pengisian biodata sederhana sebelum diagnosa.
- **Pilih Gejala & Keyakinan:** Pilihan interaktif berbagai gejala beserta tingkat keluhannya.
- **Diagnosa Instan:** Mesin inferensi CF memproses jawaban secara otomatis.
- **Laporan & PDF:** Tampilan hasil yang detail dengan nilai H (Hipotesis), E (Evidence), serta persentase dan bisa langsung diunduh dalam bentuk cetak resmi.

---

## 🔬 Tentang Certainty Factor (CF)

Metode _Certainty Factor_ (Faktor Kepastian) diperkenalkan oleh Shortliffe Buchanan dalam pembuatan sistem pakar MYCIN. Metode ini sangat cocok untuk sistem pakar yang bertugas mendiagnosis sesuatu karena dapat mengukur kepastian (_certainty_) dari seorang pakar maupun pengguna. 

Persamaan utama CF: `CF(H,E) = CF(User) * CF(Pakar)`. Mesin kami memproses nilai tersebut kemudian menggabungkannya secara linier jika terdapat multi-gejala (_CF Combine_) guna menghasilkan nilai diagnostik final.

---

## 🚀 Panduan Instalasi (Development)

Untuk menguji dan menjalankan aplikasi di komputer lokal (localhost), ikuti langkah-langkah berikut:

1. **Clone repositori:**
   ```bash
   git clone https://github.com/adamdev15/sistem-pakar-diagnosa-penyakit.git
   cd sistem-pakar-cf
   ```

2. **Instal dependensi PHP & Node.js:**
   ```bash
   composer install
   npm install
   ```

3. **Salin file environment:**
   ```bash
   cp .env.example .env
   ```
   > Buka `.env` dan konfigurasikan bagian `DB_DATABASE`, `DB_USERNAME`, dan `DB_PASSWORD` dengan kredensial database lokal Anda.

4. **Generate App Key & Migrasi:**
   ```bash
   php artisan key:generate
   php artisan migrate --seed
   ```
   > **Note:** Perintah `--seed` di atas akan membuat data contoh untuk penyakit, gejala, dan akun Admin bawaan.

5. **Kompilasi aset (Frontend):**
   ```bash
   npm run build
   ```

6. **Jalankan server pengembangan:**
   ```bash
   php artisan serve
   ```
   > Akses aplikasi melalui `http://localhost:8000`.

---

## 🎯 Target Pengguna

Proyek ini sangat sesuai digunakan oleh:
1. **Institusi Pendidikan / Mahasiswa:** Sebagai media pembelajaran, tugas akhir, maupun referensi studi kasus Sistem Pakar.
2. **Klinik / Posyandu:** Membantu pencatatan skrinning massal atau penanganan tahap awal sebelum bertemu dokter.
3. **Masyarakat Umum:** Edukasi probabilitas penyakit secara mandiri.
4. **Pengembang (_Developer_):** Boilerplate profesional untuk membangun sistem pakar berbasis Laravel Modern.

---

<p align="center">
  Dibuat dengan ❤️ oleh PakarMedis Team.
</p>
