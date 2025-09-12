{{-- resources/views/layouts/partials/admin-profile-section.blade.php --}}
<div class="flex-shrink-0 bg-gray-50 border-t border-gray-200 p-4">
    <div class="flex items-center space-x-3">
        <div class="flex-shrink-0">
            <img class="w-10 h-10 rounded-full object-cover border-2 border-gray-300" 
                 src="{{ 'https://ui-avatars.com/api/?name='.urlencode(Auth::user()->name).'&color=FFFFFF&background=111827' }}" 
                 alt="{{ Auth::user()->name }}">
        </div>
        <div class="flex-1 min-w-0">
            <p class="text-sm font-semibold text-gray-900 truncate">{{ Auth::user()->name ?? 'Admin User' }}</p>
            <p class="text-xs text-gray-500">Administrator</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-gray-400 hover:text-red-500 transition-colors duration-200 p-1 rounded-md hover:bg-red-50" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </button>
        </form>
    </div>
</div>