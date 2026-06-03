<x-app-layout>
    @section('header', 'Tambah Penyakit')

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden max-w-4xl">
        <div class="p-6 border-b border-gray-100">
            <h3 class="text-lg font-semibold text-gray-800">Form Tambah Penyakit</h3>
        </div>
        
        <form action="{{ route('penyakit.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="kode_penyakit" class="block text-sm font-medium text-gray-700 mb-1">Kode Penyakit <span class="text-red-500">*</span></label>
                    <input type="text" name="kode_penyakit" id="kode_penyakit" value="{{ old('kode_penyakit') }}" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required placeholder="Contoh: P01">
                    @error('kode_penyakit') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="nama_penyakit" class="block text-sm font-medium text-gray-700 mb-1">Nama Penyakit <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_penyakit" id="nama_penyakit" value="{{ old('nama_penyakit') }}" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required placeholder="Contoh: Demam Berdarah">
                    @error('nama_penyakit') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Penyakit</label>
                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="penyebab" class="block text-sm font-medium text-gray-700 mb-1">Penyebab</label>
                <textarea name="penyebab" id="penyebab" rows="3" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">{{ old('penyebab') }}</textarea>
                @error('penyebab') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="solusi" class="block text-sm font-medium text-gray-700 mb-1">Solusi / Penanganan</label>
                <textarea name="solusi" id="solusi" rows="3" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">{{ old('solusi') }}</textarea>
                @error('solusi') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="pencegahan" class="block text-sm font-medium text-gray-700 mb-1">Pencegahan</label>
                <textarea name="pencegahan" id="pencegahan" rows="3" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm">{{ old('pencegahan') }}</textarea>
                @error('pencegahan') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
                <select name="status" id="status" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                    <option value="aktif" {{ old('status') === 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                @error('status') <span class="text-sm text-red-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-end space-x-3 pt-4 border-t border-gray-100">
                <a href="{{ route('penyakit.index') }}" class="px-4 py-2 bg-white border border-gray-300 rounded-lg shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Batal
                </a>
                <button type="submit" class="px-4 py-2 bg-green-600 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Simpan Data
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
