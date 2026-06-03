<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Buat Akun Baru</h2>
        <p class="text-sm text-gray-500 mt-1">Daftar untuk mulai menggunakan sistem</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <label for="name" class="block font-medium text-sm text-gray-700">Nama Lengkap</label>
            <input id="name" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm px-4 py-2 bg-gray-50 text-gray-800 transition duration-300 ease-in-out hover:bg-white" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
            <input id="email" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm px-4 py-2 bg-gray-50 text-gray-800 transition duration-300 ease-in-out hover:bg-white" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="anda@contoh.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
            <input id="password" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm px-4 py-2 bg-gray-50 text-gray-800 transition duration-300 ease-in-out hover:bg-white" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <label for="password_confirmation" class="block font-medium text-sm text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" class="block mt-1 w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-lg shadow-sm px-4 py-2 bg-gray-50 text-gray-800 transition duration-300 ease-in-out hover:bg-white" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            <a class="text-sm text-green-600 hover:text-green-800 font-medium transition duration-300" href="{{ route('login') }}">
                Sudah punya akun?
            </a>

            <button type="submit" class="w-full sm:w-auto flex justify-center py-2.5 px-6 border border-transparent rounded-lg shadow-md text-sm font-semibold text-white bg-gradient-to-r from-green-600 to-green-500 hover:from-green-700 hover:to-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300 transform hover:-translate-y-0.5">
                Daftar Sekarang
            </button>
        </div>
    </form>
</x-guest-layout>
