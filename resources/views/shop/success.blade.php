@extends('layouts.app')

@section('title', 'Pesanan Berhasil')

@section('content')
<div class="container mx-auto px-4 py-12">
    <div class="max-w-3xl mx-auto">
        <div class="text-center mb-8">
            <div class="inline-block p-6 bg-green-100 rounded-full mb-4">
                <i class="fas fa-check-circle text-6xl text-green-600"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">Pesanan Berhasil!</h1>
            <p class="text-gray-600">Terima kasih telah berbelanja di FreshMart</p>
        </div>
        
        <div class="card p-8 mb-6">
            <div class="flex justify-between items-center mb-6 pb-6 border-b">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Kode Transaksi</p>
                    <p class="text-2xl font-bold text-green-600">{{ $transaction->transaction_code }}</p>
                </div>
                <div class="text-right">
                    <p class="text-sm text-gray-600 mb-1">Tanggal</p>
                    <p class="font-semibold">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                </div>
            </div>
            
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-3 text-gray-800">
                    <i class="fas fa-user text-green-600 mr-2"></i>Data Pembeli
                </h3>
                <div class="bg-gray-50 p-4 rounded-lg space-y-2">
                    <p><span class="text-gray-600">Nama:</span> <span class="font-semibold">{{ $transaction->customer_name }}</span></p>
                    <p><span class="text-gray-600">Telepon:</span> <span class="font-semibold">{{ $transaction->customer_phone }}</span></p>
                    <p><span class="text-gray-600">Alamat:</span> <span class="font-semibold">{{ $transaction->customer_address }}</span></p>
                    <p><span class="text-gray-600">Pembayaran:</span> <span class="font-semibold">{{ ucfirst($transaction->payment_method) }}</span></p>
                </div>
            </div>
            
            <div class="mb-6">
                <h3 class="font-bold text-lg mb-3 text-gray-800">
                    <i class="fas fa-box text-green-600 mr-2"></i>Detail Pesanan
                </h3>
                <div class="space-y-3">
                    @foreach($transaction->details as $detail)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div class="flex-1">
                            <p class="font-semibold">{{ $detail->product->name }}</p>
                            <p class="text-sm text-gray-600">{{ $detail->quantity }} x Rp {{ number_format($detail->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-semibold text-green-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="border-t pt-4">
                <div class="space-y-2 mb-4">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span class="font-semibold">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span>
                    </div>
                    
                    @if($transaction->discount > 0)
                    <div class="flex justify-between text-green-600">
                        <span>Diskon</span>
                        <span class="font-semibold">- Rp {{ number_format($transaction->discount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    
                    <div class="flex justify-between text-xl font-bold text-gray-800 pt-2 border-t">
                        <span>Total</span>
                        <span class="text-green-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center space-y-3">
            <button onclick="window.print()" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                <i class="fas fa-print mr-2"></i>Cetak Nota
            </button>
            
            <a href="{{ route('shop.index') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
                <i class="fas fa-home mr-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<style>
@media print {
    nav, footer, button, .no-print {
        display: none !important;
    }
}
</style>
@endsection