<x-app-layout>
    {{-- Kita gunakan x-app-layout agar konsisten dengan Breeze --}}
    
    <div class="py-12 bg-gray-100">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Tombol Kembali -->
            <div class="px-4 sm:px-0">
                <a href="{{ route('profile.show') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-black transition-colors">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Profil</span>
                </a>
            </div>

            {{-- Kartu untuk Update Informasi Profil --}}
            <div class="p-4 sm:p-8 bg-white shadow-lg rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            {{-- Kartu untuk Update Password --}}
            <div class="p-4 sm:p-8 bg-white shadow-lg rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            {{-- Kartu untuk Hapus Akun --}}
            <div class="p-4 sm:p-8 bg-white shadow-lg rounded-2xl">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>