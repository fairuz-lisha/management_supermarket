@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">
        <i class="fas fa-credit-card text-green-600 mr-3"></i>Checkout
    </h1>
    
    @if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg mb-6">
        {{ session('error') }}
    </div>
    @endif
    
    <form action="{{ route('shop.processCheckout') }}" method="POST">
        @csrf
        <div class="grid md:grid-cols-3 gap-8">
            <div class="md:col-span-2">
                <div class="card p-6 mb-6">
                    <h2 class="text-xl font-bold mb-6 text-gray-800">
                        <i class="fas fa-user text-green-600 mr-2"></i>Data Pembeli
                    </h2>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nama Lengkap *</label>
                            <input type="text" name="customer_name" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="Masukkan nama lengkap">
                            @error('customer_name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Nomor Telepon *</label>
                            <input type="tel" name="customer_phone" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="08123456789">
                            @error('customer_phone')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div>
                            <label class="block text-gray-700 font-semibold mb-2">Alamat Lengkap *</label>
                            <textarea name="customer_address" rows="4" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                                placeholder="Jl. Contoh No. 123, Kecamatan, Kota, Provinsi"></textarea>
                            @error('customer_address')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                
                <div class="card p-6">
                    <h2 class="text-xl font-bold mb-6 text-gray-800">
                        <i class="fas fa-credit-card text-green-600 mr-2"></i>Metode Pembayaran
                    </h2>
                    
                    <div class="space-y-3">
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 transition">
                            <input type="radio" name="payment_method" value="cash" required class="mr-3">
                            <div class="flex items-center flex-1">
                                <i class="fas fa-money-bill-wave text-2xl text-green-600 mr-4"></i>
                                <div>
                                    <p class="font-semibold">Cash on Delivery</p>
                                    <p class="text-sm text-gray-600">Bayar saat barang diterima</p>
                                </div>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 transition">
                            <input type="radio" name="payment_method" value="transfer" class="mr-3">
                            <div class="flex items-center flex-1">
                                <i class="fas fa-university text-2xl text-blue-600 mr-4"></i>
                                <div>
                                    <p class="font-semibold">Transfer Bank</p>
                                    <p class="text-sm text-gray-600">Transfer ke rekening toko</p>
                                </div>
                            </div>
                        </label>
                        
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-500 transition">
                            <input type="radio" name="payment_method" value="e-wallet" class="mr-3">
                            <div class="flex items-center flex-1">
                                <i class="fas fa-wallet text-2xl text-purple-600 mr-4"></i>
                                <div>
                                    <p class="font-semibold">E-Wallet</p>
                                    <p class="text-sm text-gray-600">OVO, GoPay, Dana, dll</p>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-1">
                <div class="card p-6 sticky top-24">
                    <h3 class="text-xl font-bold mb-4 text-gray-800">Ringkasan Pesanan</h3>
                    
                    <div class="space-y-3 mb-4 max-h-60 overflow-y-auto">
                        @foreach($cart as $item)
                        <div class="flex justify-between text-gray-600">
                            <span class="text-gray-600">{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                            <span class="font-semibold">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="border-t pt-4 space-y-2 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($discountPercent > 0)
                        <div class="flex justify-between text-green-600">
                            <span>Diskon ({{ $discountPercent }}%)</span>
                            <span class="font-semibold">- Rp {{ number_format($discountAmount, 0, ',', '.') }}</span>
                        </div>
                        @endif
                        
                        <div class="border-t pt-2 flex justify-between text-xl font-bold text-gray-800">
                            <span>Total Bayar</span>
                            <span class="text-green-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-center py-3 rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                        <i class="fas fa-check-circle mr-2"></i>Selesaikan Pesanan
                    </button>
                    
                    <a href="{{ route('shop.cart') }}" class="block w-full text-center py-3 mt-3 text-green-600 hover:text-gray-700 transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Keranjang
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection