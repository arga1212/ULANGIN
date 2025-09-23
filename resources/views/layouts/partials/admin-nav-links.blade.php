{{-- resources/views/layouts/partials/admin-nav-links.blade.php --}}
<a href="{{ route('admin.dashboard') }}" 
   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-gray-100 text-black' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-4 py-3 text-sm font-medium rounded-xl">
    <span class="nav-icon mr-4 {{ request()->routeIs('admin.dashboard') ? 'text-black' : 'text-gray-400' }}"><i class="fas fa-home"></i></span>
    <span class="font-medium">Dashboard</span>
</a>

<a href="{{ route('admin.products.index') }}" 
   class="nav-link {{ request()->routeIs('admin.products.*') ? 'active bg-gray-100 text-black' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-4 py-3 text-sm font-medium rounded-xl">
    <span class="nav-icon mr-4 {{ request()->routeIs('admin.products.*') ? 'text-black' : 'text-gray-400' }}"><i class="fas fa-box"></i></span>
    <span class="font-medium">Produk</span>
</a>

<a href="{{ route('admin.orders.index') }}" 
   class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active bg-gray-100 text-black' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-4 py-3 text-sm font-medium rounded-xl">
    <span class="nav-icon mr-4 {{ request()->routeIs('admin.orders.*') ? 'text-black' : 'text-gray-400' }}"><i class="fas fa-receipt"></i></span>
    <span class="font-medium">Pesanan</span>
</a>

<a href="{{ route('admin.vouchers.index') }}" 
   class="nav-link {{ request()->routeIs('admin.vouchers.*') ? 'active bg-gray-100 text-black' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-4 py-3 text-sm font-medium rounded-xl">
    <span class="nav-icon mr-4 {{ request()->routeIs('admin.vouchers.*') ? 'text-black' : 'text-gray-400' }}"><i class="fas fa-ticket-alt"></i></span>
    <span class="font-medium">Voucher</span>
</a>

<a href="{{ route('admin.invoices.create') }}" 
   class="nav-link {{ request()->routeIs('admin.invoices.create') ? 'active bg-gray-100 text-black' : 'text-gray-600 hover:bg-gray-50' }} group flex items-center px-4 py-3 text-sm font-medium rounded-xl">
    <span class="nav-icon mr-4 {{ request()->routeIs('admin.invoices.create') ? 'text-black' : 'text-gray-400' }}"><i class="fas fa-file-invoice-dollar"></i></span>
    <span class="font-medium">Buat Invoice</span>
</a>