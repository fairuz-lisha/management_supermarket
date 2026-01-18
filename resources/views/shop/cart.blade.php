@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">
        <i class="fas fa-shopping-cart text-green-600 mr-3"></i>Keranjang Belanja
    </h1>
    
    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
    @endif
    
    @if(empty($cart))
    <div class="text-center py-16">
        <i class="fas fa-shopping-cart text-8xl text-gray-300 mb-6"></i>
        <h2 class="text-2xl font-bold text-gray-700 mb-4">Keranjang Kosong</h2>
        <p class="text-gray-500 mb-6">Yuk mulai belanja kebutuhan Anda!</p>
        <a href="{{ route('shop.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
            <i class="fas fa-shopping-bag mr-2"></i>Mulai Belanja
        </a>
    </div>
    @else
    
    <?php
    // Hitung total item (quantity)
    $totalItems = 0;
    foreach($cart as $item) {
        $totalItems += $item['quantity'];
    }
    
    // Tentukan diskon berdasarkan jumlah item
    $discountPercent = 0;
    $discountMessage = '';
    $nextDiscountMessage = '';
    
    if ($totalItems >= 10) {
        $discountPercent = 15;
        $discountMessage = '🎉 Selamat! Anda mendapat diskon 15%';
    } elseif ($totalItems >= 5) {
        $discountPercent = 10;
        $discountMessage = '🎉 Selamat! Anda mendapat diskon 10%';
        $itemsNeeded = 10 - $totalItems;
        $nextDiscountMessage = "Tambah {$itemsNeeded} item lagi untuk diskon 15%!";
    } elseif ($totalItems >= 3) {
        $discountPercent = 5;
        $discountMessage = '🎉 Anda mendapat diskon 5%';
        $itemsNeeded = 5 - $totalItems;
        $nextDiscountMessage = "Tambah {$itemsNeeded} item lagi untuk diskon 10%!";
    } else {
        $itemsNeeded = 3 - $totalItems;
        $nextDiscountMessage = "Tambah {$itemsNeeded} item lagi untuk diskon 5%!";
    }
    
    $discountAmount = $total * ($discountPercent / 100);
    $finalTotal = $total - $discountAmount;
    ?>
    
    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6">
                @foreach($cart as $id => $item)
                <div class="flex items-center gap-4 pb-6 mb-6 border-b last:border-b-0">
                    <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                        @if($item['image'])
                        <img src="{{ asset('storage/'.$item['image']) }}" class="w-full h-full object-cover" alt="{{ $item['name'] }}">
                        @else
                        <div class="w-full h-full flex items-center justify-center bg-green-100">
                            <i class="fas fa-image text-3xl text-green-300"></i>
                        </div>
                        @endif
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="font-bold text-lg text-gray-800">{{ $item['name'] }}</h3>
                        <p class="text-green-600 font-semibold">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        
                        <form action="{{ route('shop.updateCart', $id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PUT')
                            <div class="flex items-center gap-2">
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1"
                                    class="w-20 px-3 py-1 border border-gray-300 rounded-lg text-center"
                                    onchange="this.form.submit()">
                                <span class="text-gray-600">x Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                            </div>
                        </form>
                    </div>
                    
                    <div class="text-right">
                        <p class="text-xl font-bold text-gray-800 mb-3">
                            Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                        </p>
                        
                        <form action="{{ route('shop.removeFromCart', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-700 transition">
                                <i class="fas fa-trash mr-1"></i>Hapus
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <div class="md:col-span-1">
            <div class="bg-white rounded-xl shadow-lg p-6 sticky top-24">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Ringkasan Belanja</h3>
                
                <!-- Info Total Item -->
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-2 border-blue-300 rounded-lg p-4 mb-4">
                    <div class="flex items-center justify-between">
                        <span class="text-blue-800 font-semibold">
                            <i class="fas fa-shopping-basket mr-2"></i>Total Item
                        </span>
                        <span class="text-3xl font-bold text-blue-600">{{ $totalItems }}</span>
                    </div>
                </div>
                
                <!-- Diskon Info -->
                @if($discountPercent > 0)
                <div class="bg-gradient-to-r from-green-50 to-green-100 border-2 border-green-300 rounded-lg p-4 mb-4">
                    <p class="text-green-700 font-bold flex items-center">
                        <i class="fas fa-check-circle mr-2 text-xl"></i>{{ $discountMessage }}
                    </p>
                    @if($nextDiscountMessage)
                    <p class="text-sm text-green-600 mt-2 flex items-center">
                        <i class="fas fa-arrow-up mr-1"></i>{{ $nextDiscountMessage }}
                    </p>
                    @endif
                </div>
                @else
                <div class="bg-gradient-to-r from-yellow-50 to-yellow-100 border-2 border-yellow-300 rounded-lg p-4 mb-4">
                    <p class="text-yellow-800 font-semibold flex items-center mb-2">
                        <i class="fas fa-info-circle mr-2"></i>{{ $nextDiscountMessage }}
                    </p>
                    <div class="mt-3 space-y-1 text-sm text-yellow-700 border-t border-yellow-200 pt-3">
                        <p class="flex items-center">
                            <i class="fas fa-gift text-yellow-500 mr-2"></i>
                            <span class="font-semibold">3-4 item</span>
                            <span class="mx-2">→</span>
                            <span class="text-green-600 font-bold">Diskon 5%</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-gift text-yellow-500 mr-2"></i>
                            <span class="font-semibold">5-9 item</span>
                            <span class="mx-2">→</span>
                            <span class="text-green-600 font-bold">Diskon 10%</span>
                        </p>
                        <p class="flex items-center">
                            <i class="fas fa-gift text-yellow-500 mr-2"></i>
                            <span class="font-semibold">≥10 item</span>
                            <span class="mx-2">→</span>
                            <span class="text-green-600 font-bold">Diskon 15%</span>
                        </p>
                    </div>
                </div>
                @endif
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal ({{ $totalItems }} item)</span>
                        <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    @if($discountPercent > 0)
                    <div class="flex justify-between text-green-600">
                        <span>Diskon ({{ $discountPercent }}%)</span>
                        <span class="font-semibold">- Rp {{ number_format($discountAmount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    <div class="border-t-2 border-gray-300 pt-3 flex justify-between text-xl font-bold text-gray-800">
                        <span>Total Bayar</span>
                        <span class="text-green-600">
                            Rp {{ number_format($finalTotal, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                
                @if($discountPercent > 0)
                <div class="bg-green-500 text-white rounded-lg p-3 mb-4 text-center">
                    <p class="text-sm font-semibold">
                        💰 Anda hemat Rp {{ number_format($discountAmount, 0, ',', '.') }}
                    </p>
                </div>
                @endif
                
                <a href="{{ route('shop.checkout') }}" class="block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white text-center py-3 rounded-lg font-semibold shadow-lg transition transform hover:scale-105">
                    <i class="fas fa-credit-card mr-2"></i>Checkout Sekarang
                </a>
                
                <a href="{{ route('shop.index') }}" class="block w-full text-center py-3 mt-3 text-green-600 hover:text-green-700 font-semibold transition">
                    <i class="fas fa-arrow-left mr-2"></i>Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection