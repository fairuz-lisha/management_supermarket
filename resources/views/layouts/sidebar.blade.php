<aside class="w-64 bg-white shadow-lg h-screen fixed left-0 top-0 overflow-y-auto">
    <div class="p-6 bg-gradient-to-br from-green-400 to-green-600">
        <div class="flex items-center space-x-3 text-white">
            <i class="fas fa-shopping-basket text-3xl"></i>
            <div>
                <h2 class="text-xl font-bold">FreshMart</h2>
            </div>
        </div>
    </div>
    
    <div class="p-4">
        <div class="mb-6">
            <div class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg">
                <i class="fas fa-user-circle text-2xl text-green-600"></i>
                <div>
                    <p class="font-semibold text-gray-800">{{ Auth::guard('admin')->user()->name }}</p>
                    <p class="text-xs text-gray-600">Administrator</p>
                </div>
            </div>
        </div>
        
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green-50 transition {{ request()->routeIs('admin.dashboard') ? 'bg-green-100 text-green-700' : 'text-gray-700' }}">
                <i class="fas fa-tachometer-alt w-5"></i>
                <span>Dashboard</span>
            </a>
            
            <a href="{{ route('admin.categories.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green-50 transition {{ request()->routeIs('admin.categories.*') ? 'bg-green-100 text-green-700' : 'text-gray-700' }}">
                <i class="fas fa-tags w-5"></i>
                <span>Kategori</span>
            </a>
            
            <a href="{{ route('admin.suppliers.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green-50 transition {{ request()->routeIs('admin.suppliers.*') ? 'bg-green-100 text-green-700' : 'text-gray-700' }}">
                <i class="fas fa-truck w-5"></i>
                <span>Supplier</span>
            </a>
            
            <a href="{{ route('admin.products.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green-50 transition {{ request()->routeIs('admin.products.*') ? 'bg-green-100 text-green-700' : 'text-gray-700' }}">
                <i class="fas fa-box w-5"></i>
                <span>Produk</span>
            </a>
            
            <a href="{{ route('admin.transactions.index') }}" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-green-50 transition {{ request()->routeIs('admin.transactions.*') ? 'bg-green-100 text-green-700' : 'text-gray-700' }}">
                <i class="fas fa-receipt w-5"></i>
                <span>Transaksi</span>
            </a>
            
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 p-3 rounded-lg hover:bg-red-50 text-gray-700 hover:text-red-600 transition">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Logout</span>
                </button>
            </form>
        </nav>
    </div>
</aside>