<section>
    <header>
        <h2 class="text-2xl font-bold text-gray-900">
            Perbarui Password
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Input Password Saat Ini --}}
        <div>
            <label for="current_password" class="block text-sm font-medium text-gray-700">Password Saat Ini</label>
            <input id="current_password" name="current_password" type="password" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" 
                   autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Password Baru --}}
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
            <input id="password" name="password" type="password" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" 
                   autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>
        
        {{-- Input Konfirmasi Password Baru --}}
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
            <input id="password_confirmation" name="password_confirmation" type="password" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" 
                   autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                    class="inline-flex items-center px-6 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition ease-in-out duration-150">
                Simpan
            </button>
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
                   class="text-sm text-gray-600">
                   Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>