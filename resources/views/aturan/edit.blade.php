<x-app-layout>
    @section('header', 'Edit Aturan')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Form Edit Aturan CF</h3>
        </div>
        
        <form action="{{ route('aturan.update', $aturan->id) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="penyakit_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Penyakit <span class="text-red-500">*</span></label>
                <select name="penyakit_id" id="penyakit_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                    @foreach($penyakits as $penyakit)
                        <option value="{{ $penyakit->id }}" {{ old('penyakit_id', $aturan->penyakit_id) == $penyakit->id ? 'selected' : '' }}>
                            [{{ $penyakit->kode_penyakit }}] {{ $penyakit->nama_penyakit }}
                        </option>
                    @endforeach
                </select>
                @error('penyakit_id') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="gejala_id" class="block text-sm font-medium text-gray-700 mb-1">Pilih Gejala <span class="text-red-500">*</span></label>
                <select name="gejala_id" id="gejala_id" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                    @foreach($gejalas as $gejala)
                        <option value="{{ $gejala->id }}" {{ old('gejala_id', $aturan->gejala_id) == $gejala->id ? 'selected' : '' }}>
                            [{{ $gejala->kode_gejala }}] {{ $gejala->nama_gejala }}
                        </option>
                    @endforeach
                </select>
                @error('gejala_id') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="cf_pakar" class="block text-sm font-medium text-gray-700 mb-1">Nilai CF Pakar <span class="text-red-500">*</span></label>
                <p class="text-xs text-gray-500 mb-2">Masukkan nilai antara 0.00 hingga 1.00</p>
                <input type="number" step="0.01" min="0" max="1" name="cf_pakar" id="cf_pakar" value="{{ old('cf_pakar', $aturan->cf_pakar) }}" class="w-full md:w-1/3 rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                @error('cf_pakar') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="{{ route('aturan.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
