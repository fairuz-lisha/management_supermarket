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
        <a href="{{ route('shop.index') }}" class="btn-primary px-8 py-3 rounded-lg inline-block">
            <i class="fas fa-shopping-bag mr-2"></i>Mulai Belanja
        </a>
    </div>
    @else
    <div class="grid md:grid-cols-3 gap-8">
        <div class="md:col-span-2">
            <div class="card p-6">
                @foreach($cart as $id => $item)
                <div class="flex items-center gap-4 pb-6 mb-6 border-b last:border-b-0">
                    <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                        @if($item['image'])
                        <img src="{{ asset('storage/'.$item['image']) }}" class="w-full h-full object-cover">
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
            <div class="card p-6 sticky top-24">
                <h3 class="text-xl font-bold mb-4 text-gray-800">Ringkasan Belanja</h3>
                
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    @if($total > 100000)
                    <div class="flex justify-between text-green-600">
                        <span>Diskon (10%)</span>
                        <span class="font-semibold">- Rp {{ number_format($total * 0.1, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    <div class="border-t pt-3 flex justify-between text-lg font-bold text-gray-800">
                        <span>Total</span>
                        <span class="text-green-600">
                            Rp {{ number_format($total > 100000 ? $total * 0.9 : $total, 0, ',', '.') }}
                        </span>
                    </div>
                </div>
                
                @if($total > 100000)
                <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                    <p class="text-sm text-green-700">
                        <i class="fas fa-check-circle mr-2"></i>
                        Selamat! Anda mendapat diskon 10%
                    </p>
                </div>
                @else
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                    <p class="text-sm text-blue-700">
                        <i class="fas fa-info-circle mr-2"></i>
                        Belanja min. Rp 100.000 dapat diskon 10%
                    </p>
                </div>
                @endif
                
                <a href="{{ route('shop.checkout') }}" class="block w-full btn-primary text-center py-3 rounded-lg font-semibold">
                    <i class="fas fa-credit-card mr-2"></i>Checkout
                </a>
                
                <a href="{{ route('shop.index') }}" class="block w-full text-center py-3 mt-3 text-green-600 hover:text-green-700 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Lanjut Belanja
                </a>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection