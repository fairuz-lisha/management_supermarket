<nav class="bg-white shadow-md sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <a href="{{ route('shop.index') }}" class="flex items-center space-x-2">
                <i class="fas fa-shopping-basket text-3xl" style="color: var(--accent)"></i>
                <span class="text-2xl font-bold" style="color: var(--accent)">FreshMart</span>
            </a>
            
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('shop.index') }}" class="text-gray-700 hover:text-green-600 transition">
                    <i class="fas fa-home mr-1"></i> Beranda
                </a>
                <a href="{{ route('shop.cart') }}" class="text-gray-700 hover:text-green-600 transition relative">
                    <i class="fas fa-shopping-cart mr-1"></i> Keranjang
                    @if(session('cart') && count(session('cart')) > 0)
                    <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                        {{ count(session('cart')) }}
                    </span>
                    @endif
                </a>
                <a href="{{ route('admin.login') }}" class="text-gray-700 hover:text-green-600 transition">
                    <i class="fas fa-user-shield mr-1"></i> Admin
                </a>
            </div>
            
            <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        <div id="mobileMenu" class="hidden md:hidden pb-4">
            <a href="{{ route('shop.index') }}" class="block py-2 text-gray-700">Beranda</a>
            <a href="{{ route('shop.cart') }}" class="block py-2 text-gray-700">Keranjang</a>
            <a href="{{ route('admin.login') }}" class="block py-2 text-gray-700">Admin</a>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    document.getElementById('mobileMenu').classList.toggle('hidden');
}
</script>