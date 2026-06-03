<x-app-layout>
    @section('header', 'Mulai Diagnosa')

    <div x-data="diagnosaWizard()" class="max-w-5xl mx-auto">
        <!-- Progress Steps -->
        <div class="mb-8">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-1 bg-gray-200 z-0"></div>
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-1 bg-green-500 z-0 transition-all duration-500" :style="'width: ' + ((step - 1) / 2 * 100) + '%'"></div>
                
                <template x-for="i in 3" :key="i">
                    <div class="relative z-10 flex flex-col items-center">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm border-4 transition-colors duration-300"
                            :class="step >= i ? 'bg-green-600 border-green-200 text-white shadow-md' : 'bg-white border-gray-200 text-gray-400'">
                            <span x-text="i"></span>
                        </div>
                        <div class="absolute top-12 text-xs font-semibold text-center whitespace-nowrap"
                            :class="step >= i ? 'text-green-700' : 'text-gray-400'"
                            x-text="i === 1 ? 'Identitas Diri' : (i === 2 ? 'Pilih Gejala' : 'Tingkat Keyakinan')">
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <form action="{{ route('diagnosa.store') }}" method="POST" id="diagnosaForm" class="mt-12 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            @csrf
            
            <!-- STEP 1: Identitas -->
            <div x-show="step === 1" x-transition.opacity.duration.300ms class="p-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center">Data Identitas Pasien</h3>
                
                <div class="space-y-6 max-w-xl mx-auto">
                    <div>
                        <label for="nama_pasien" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                        <input type="text" x-model="formData.nama" name="nama_pasien" id="nama_pasien" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required placeholder="Masukkan nama lengkap Anda">
                    </div>
                    
                    <div class="grid grid-cols-2 gap-6">
                        <div>
                            <label for="umur" class="block text-sm font-medium text-gray-700 mb-1">Umur <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <input type="number" x-model="formData.umur" name="umur" id="umur" min="1" max="120" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required placeholder="Contoh: 25">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <span class="text-gray-500 sm:text-sm">Tahun</span>
                                </div>
                            </div>
                        </div>
                        
                        <div>
                            <label for="jenis_kelamin" class="block text-sm font-medium text-gray-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <select name="jenis_kelamin" x-model="formData.jk" id="jenis_kelamin" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" required>
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="button" @click="nextStep()" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" :disabled="!isStep1Valid()">
                        Selanjutnya
                    </button>
                </div>
            </div>

            <!-- STEP 2: Gejala -->
            <div x-show="step === 2" style="display: none;" x-transition.opacity.duration.300ms class="p-8">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800">Pilih Gejala yang Dialami</h3>
                    <p class="text-gray-500 mt-2">Centang gejala-gejala yang Anda rasakan saat ini.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 max-h-96 overflow-y-auto p-2">
                    @foreach($gejalas as $gejala)
                        <label class="flex items-start p-4 border rounded-xl cursor-pointer transition-all duration-200 hover:bg-green-50"
                            :class="selectedGejalas.includes('{{ $gejala->id }}') ? 'border-green-500 bg-green-50 shadow-sm' : 'border-gray-200 bg-white'">
                            <div class="flex items-center h-5">
                                <input type="checkbox" value="{{ $gejala->id }}" x-model="selectedGejalas" class="w-5 h-5 text-green-600 border-gray-300 rounded focus:ring-green-500">
                            </div>
                            <div class="ml-3 text-sm">
                                <span class="font-medium text-gray-900 block">{{ $gejala->nama_gejala }}</span>
                                @if($gejala->deskripsi)
                                    <span class="text-gray-500 block mt-1 text-xs">{{ $gejala->deskripsi }}</span>
                                @endif
                            </div>
                        </label>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-between">
                    <button type="button" @click="step = 1" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                        Kembali
                    </button>
                    <button type="button" @click="nextStep()" class="px-6 py-2.5 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors disabled:opacity-50 disabled:cursor-not-allowed" :disabled="selectedGejalas.length === 0">
                        Selanjutnya (<span x-text="selectedGejalas.length"></span> Gejala)
                    </button>
                </div>
            </div>

            <!-- STEP 3: Keyakinan -->
            <div x-show="step === 3" style="display: none;" x-transition.opacity.duration.300ms class="p-8">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-800">Tingkat Keyakinan Gejala</h3>
                    <p class="text-gray-500 mt-2">Seberapa yakin Anda merasakan gejala-gejala berikut?</p>
                </div>
                
                <div class="space-y-4 max-w-4xl mx-auto">
                    @foreach($gejalas as $gejala)
                        <div x-show="selectedGejalas.includes('{{ $gejala->id }}')" class="p-5 border border-gray-200 rounded-xl bg-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div class="flex-1">
                                <span class="font-bold text-gray-800 text-lg">{{ $gejala->nama_gejala }}</span>
                            </div>
                            <div class="flex-shrink-0 w-full md:w-64">
                                <select name="gejala[{{ $gejala->id }}]" class="w-full rounded-lg border-gray-300 focus:border-green-500 focus:ring-green-500 shadow-sm" :required="selectedGejalas.includes('{{ $gejala->id }}')">
                                    <option value="">-- Pilih Keyakinan --</option>
                                    @foreach($keyakinan as $k)
                                        <option value="{{ $k['nilai'] }}">{{ $k['label'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8 flex justify-between border-t border-gray-100 pt-6">
                    <button type="button" @click="step = 2" class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                        Kembali
                    </button>
                    <button type="submit" class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-500 text-white rounded-lg font-bold shadow-lg hover:from-green-700 hover:to-green-600 transform hover:-translate-y-0.5 transition-all">
                        Proses Diagnosa
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function diagnosaWizard() {
            return {
                step: 1,
                formData: {
                    nama: '',
                    umur: '',
                    jk: ''
                },
                selectedGejalas: [],
                isStep1Valid() {
                    return this.formData.nama !== '' && this.formData.umur !== '' && this.formData.jk !== '';
                },
                nextStep() {
                    if (this.step === 1 && !this.isStep1Valid()) return;
                    if (this.step === 2 && this.selectedGejalas.length === 0) return;
                    this.step++;
                }
            }
        }
    </script>
</x-app-layout>
