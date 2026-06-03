<x-app-layout>
    @section('header', 'Tambah Gejala')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Form Tambah Gejala</h3>
        </div>
        
        <form action="{{ route('gejala.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kode_gejala" class="block text-sm font-medium text-gray-700 mb-1">Kode Gejala <span class="text-red-500">*</span></label>
                    <input type="text" name="kode_gejala" id="kode_gejala" value="{{ old('kode_gejala') }}" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required placeholder="Contoh: G01">
                    @error('kode_gejala') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="status" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                        <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="nama_gejala" class="block text-sm font-medium text-gray-700 mb-1">Nama Gejala <span class="text-red-500">*</span></label>
                <input type="text" name="nama_gejala" id="nama_gejala" value="{{ old('nama_gejala') }}" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required placeholder="Contoh: Demam Tinggi">
                @error('nama_gejala') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Gejala (Opsional)</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="{{ route('gejala.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-green-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
