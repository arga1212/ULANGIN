<section>
    <header>
        <h2 class="text-2xl font-bold text-gray-900">
            Informasi Profil
        </h2>
        <p class="mt-1 text-sm text-gray-600">
            Perbarui informasi profil dan alamat email akun Anda.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        {{-- Input Nama --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input id="name" name="name" type="text" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
        </div>

        {{-- Input Email --}}
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input id="email" name="email" type="email" 
                   class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-black focus:ring-black" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <p class="text-sm text-red-600 mt-2">{{ $message }}</p>
            @enderror
            
            {{-- ... (Logika Verifikasi Email tidak perlu diubah, biarkan saja) ... --}}
        </div>

        {{-- Tombol Aksi --}}
        <div class="flex items-center gap-4">
            <button type="submit" 
                    class="inline-flex items-center px-6 py-2 bg-black border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black transition ease-in-out duration-150">
                Simpan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" 
                   class="text-sm text-gray-600">
                   Tersimpan.
                </p>
            @endif
        </div>
    </form>
</section>