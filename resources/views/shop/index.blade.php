@extends('layouts.app')

@section('title', 'FreshMart - Belanja Online')

@section('content')
<div class="bg-gradient-to-r from-green-400 to-green-600 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-5xl font-bold mb-4">Selamat Datang di FreshMart</h1>
        <p class="text-xl text-green-100 mb-8">Belanja kebutuhan harian dengan mudah dan cepat</p>
        
        <form action="{{ route('shop.index') }}" method="GET" class="max-w-2xl mx-auto">
            <div class="flex gap-2">
                <input type="text" name="search" placeholder="Cari produk..." 
                    value="{{ request('search') }}"
                    class="flex-1 px-6 py-4 rounded-lg text-gray-800 focus:ring-4 focus:ring-green-300">
                <button type="submit" class="bg-white text-green-600 px-8 py-4 rounded-lg font-semibold hover:bg-green-50 transition">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<div class="container mx-auto px-4 py-12">
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6">
        <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg mb-6">
        <i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}
    </div>
    @endif
    
    <div class="grid md:grid-cols-4 gap-8">
        <div class="md:col-span-1">
            <div class="card p-6">
                <h3 class="text-xl font-bold mb-4 text-green-700">
                    <i class="fas fa-filter mr-2"></i>Filter Kategori
                </h3>
                
                <a href="{{ route('shop.index') }}" 
                    class="block py-2 px-4 mb-2 rounded {{ !request('category') ? 'bg-green-100 text-green-700' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-th mr-2"></i>Semua Produk
                </a>
                
                @foreach($categories as $cat)
                <a href="{{ route('shop.index', ['category' => $cat->id]) }}" 
                    class="block py-2 px-4 mb-2 rounded {{ request('category') == $cat->id ? 'bg-green-100 text-green-700' : 'hover:bg-gray-100' }}">
                    <i class="fas fa-tag mr-2"></i>{{ $cat->name }}
                    <span class="text-sm text-gray-500">({{ $cat->products_count }})</span>
                </a>
                @endforeach
            </div>
        </div>
        
        <div class="md:col-span-3">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-800">Produk Tersedia</h2>
                <p class="text-gray-600">{{ $products->total() }} produk</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-6">
                @forelse($products as $product)
                <div class="card overflow-hidden">
                    <div class="h-48 bg-gray-200 relative overflow-hidden">
                        @if($product->image)
                        <img src="{{ asset('storage/'.$product->image) }}" 
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-green-100 to-green-200">
                            <i class="fas fa-image text-6xl text-green-300"></i>
                        </div>
                        @endif
                        
                        @if($product->stock < 10)
                        <span class="absolute top-2 right-2 bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">
                            Stok Terbatas!
                        </span>
                        @endif
                    </div>
                    
                    <div class="p-4">
                        <span class="text-xs text-green-600 font-semibold">{{ $product->category->name }}</span>
                        <h3 class="font-bold text-lg text-gray-800 mt-1 mb-2">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-600 mb-3">{{ Str::limit($product->description, 60) }}</p>
                        
                        <div class="flex justify-between items-center mb-3">
                            <span class="text-2xl font-bold text-green-600">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                            <span class="text-sm text-gray-500">Stok: {{ $product->stock }}</span>
                        </div>
                        
                        <form action="{{ route('shop.addToCart') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="flex gap-2">
                                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                    class="w-20 px-3 py-2 border border-gray-300 rounded-lg text-center">
                                <button type="submit" class="flex-1 btn-primary py-2 px-4 rounded-lg font-semibold">
                                    <i class="fas fa-cart-plus mr-2"></i>Tambah
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                @empty
                <div class="col-span-3 text-center py-12">
                    <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500 text-lg">Tidak ada produk ditemukan</p>
                </div>
                @endforelse
            </div>
            
            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
