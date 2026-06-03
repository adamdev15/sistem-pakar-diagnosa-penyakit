<x-app-layout>
    @section('header', 'Profil Pengguna')

    <div class="max-w-7xl mx-auto space-y-6">
        <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 sm:p-8 bg-white shadow-sm border border-gray-100 sm:rounded-2xl">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
