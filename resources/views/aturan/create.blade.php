<x-app-layout>
    @section('header', 'Tambah Aturan')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Form Tambah Aturan CF</h3>
            <p class="text-sm text-gray-500 mt-1">Masukkan nilai kepastian (Certainty Factor) pakar untuk suatu gejala terhadap penyakit tertentu.</p>
        </div>
        
        <form action="{{ route('aturan.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div>
                <label for="penyakit_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Penyakit <span class="text-red-500">*</span></label>
                <select name="penyakit_id" id="penyakit_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                    <option value="">-- Pilih Penyakit --</option>
                    @foreach($penyakits as $penyakit)
                        <option value="{{ $penyakit->id }}" {{ old('penyakit_id') == $penyakit->id ? 'selected' : '' }}>
                            [{{ $penyakit->kode_penyakit }}] {{ $penyakit->nama_penyakit }}
                        </option>
                    @endforeach
                </select>
                @error('penyakit_id') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="gejala_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Gejala <span class="text-red-500">*</span></label>
                <select name="gejala_id" id="gejala_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                    <option value="">-- Pilih Gejala --</option>
                    @foreach($gejalas as $gejala)
                        <option value="{{ $gejala->id }}" {{ old('gejala_id') == $gejala->id ? 'selected' : '' }}>
                            [{{ $gejala->kode_gejala }}] {{ $gejala->nama_gejala }}
                        </option>
                    @endforeach
                </select>
                @error('gejala_id') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="cf_pakar" class="block text-sm font-medium text-gray-700 mb-1">Nilai CF Pakar <span class="text-red-500">*</span></label>
                <p class="text-xs text-gray-500 mb-2">Masukkan nilai antara 0.00 hingga 1.00 (Contoh: 0.8 atau 1.0)</p>
                <input type="number" step="0.01" min="0" max="1" name="cf_pakar" id="cf_pakar" value="{{ old('cf_pakar') }}" class="w-full md:w-1/3 rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required placeholder="0.8">
                @error('cf_pakar') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="{{ route('aturan.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-green-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
