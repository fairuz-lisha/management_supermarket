@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid md:grid-cols-4 gap-6 mb-8">
    <div class="bg-gradient-to-br from-blue-400 to-blue-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-blue-100 mb-2">Total Produk</p>
                <h3 class="text-4xl font-bold">{{ $totalProducts }}</h3>
            </div>
            <i class="fas fa-box text-5xl opacity-30"></i>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-green-400 to-green-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-green-100 mb-2">Total Kategori</p>
                <h3 class="text-4xl font-bold">{{ $totalCategories }}</h3>
            </div>
            <i class="fas fa-tags text-5xl opacity-30"></i>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-purple-400 to-purple-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-purple-100 mb-2">Total Transaksi</p>
                <h3 class="text-4xl font-bold">{{ $totalTransactions }}</h3>
            </div>
            <i class="fas fa-receipt text-5xl opacity-30"></i>
        </div>
    </div>
    
    <div class="bg-gradient-to-br from-orange-400 to-orange-600 rounded-xl shadow-lg p-6 text-white">
        <div class="flex justify-between items-start">
            <div>
                <p class="text-orange-100 mb-2">Total Pendapatan</p>
                <h3 class="text-2xl font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</h3>
            </div>
            <i class="fas fa-money-bill-wave text-5xl opacity-30"></i>
        </div>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-6 mb-8">
    @if($lowStock > 0)
    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-lg">
        <div class="flex items-center">
            <i class="fas fa-exclamation-triangle text-3xl text-red-500 mr-4"></i>
            <div>
                <h4 class="font-bold text-red-800 text-lg">Peringatan Stok!</h4>
                <p class="text-red-700">{{ $lowStock }} produk memiliki stok di bawah 10</p>
            </div>
        </div>
    </div>
    @endif
</div>

<div class="grid md:grid-cols-2 gap-6">
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4 text-gray-800">
            <i class="fas fa-clock text-green-600 mr-2"></i>Transaksi Terbaru
        </h3>
        <div class="space-y-3">
            @forelse($recentTransactions as $trans)
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                <div>
                    <p class="font-semibold text-gray-800">{{ $trans->transaction_code }}</p>
                    <p class="text-sm text-gray-600">{{ $trans->customer_name }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">Rp {{ number_format($trans->total, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500">{{ $trans->created_at->diffForHumans() }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-8">Belum ada transaksi</p>
            @endforelse
        </div>
        <a href="{{ route('admin.transactions.index') }}" class="block text-center text-green-600 hover:text-green-700 mt-4">
            Lihat Semua <i class="fas fa-arrow-right ml-1"></i>
        </a>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6">
        <h3 class="text-xl font-bold mb-4 text-gray-800">
            <i class="fas fa-star text-yellow-500 mr-2"></i>Produk Terlaris
        </h3>
        <div class="space-y-3">
            @forelse($topProducts as $product)
            <div class="flex justify-between items-center p-4 bg-gray-50 rounded-lg">
                <div class="flex-1">
                    <p class="font-semibold text-gray-800">{{ $product->product_name }}</p>
                    <p class="text-sm text-gray-600">{{ $product->category->category_name }}</p>
                </div>
                <div class="text-right">
                    <p class="font-bold text-green-600">{{ $product->transaction_details_sum_quantity ?? 0}} terjual</p>
                    <p class="text-xs text-gray-500">Stok: {{ $product->stock }}</p>
                </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-8">Belum ada data penjualan</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
