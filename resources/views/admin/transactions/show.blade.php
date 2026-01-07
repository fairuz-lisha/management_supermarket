@extends('layouts.admin')

@section('title', 'Detail Transaksi')
@section('page-title', 'Detail Transaksi')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <div class="flex justify-between items-start mb-6 pb-6 border-b">
            <div>
                <h2 class="text-2xl font-bold text-green-600 mb-2">{{ $transaction->transaction_code }}</h2>
                <p class="text-gray-600">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
            </div>
            <div class="text-right">
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    {{ $transaction->status == 'completed' ? 'bg-green-100 text-green-700' : ($transaction->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                    {{ ucfirst($transaction->status) }}
                </span>
            </div>
        </div>
        
        <div class="grid md:grid-cols-2 gap-6 mb-6">
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4 text-gray-800">
                    <i class="fas fa-user text-green-600 mr-2"></i>Data Customer
                </h3>
                <div class="space-y-2">
                    <p><span class="text-gray-600">Nama:</span> <span class="font-semibold">{{ $transaction->customer_name }}</span></p>
                    <p><span class="text-gray-600">Telepon:</span> <span class="font-semibold">{{ $transaction->customer_phone }}</span></p>
                    <p><span class="text-gray-600">Alamat:</span> <span class="font-semibold">{{ $transaction->customer_address }}</span></p>
                </div>
            </div>
            
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="font-bold text-lg mb-4 text-gray-800">
                    <i class="fas fa-credit-card text-green-600 mr-2"></i>Informasi Pembayaran
                </h3>
                <div class="space-y-2">
                    <p><span class="text-gray-600">Metode:</span> <span class="font-semibold">{{ ucfirst($transaction->payment_method) }}</span></p>
                    <p><span class="text-gray-600">Subtotal:</span> <span class="font-semibold">Rp {{ number_format($transaction->subtotal, 0, ',', '.') }}</span></p>
                    @if($transaction->discount > 0)
                    <p><span class="text-gray-600">Diskon:</span> <span class="font-semibold text-green-600">- Rp {{ number_format($transaction->discount, 0, ',', '.') }}</span></p>
                    @endif
                    <p class="pt-2 border-t"><span class="text-gray-600">Total:</span> <span class="font-bold text-xl text-green-600">Rp {{ number_format($transaction->total, 0, ',', '.') }}</span></p>
                </div>
            </div>
        </div>
        
        <div>
            <h3 class="font-bold text-lg mb-4 text-gray-800">
                <i class="fas fa-shopping-cart text-green-600 mr-2"></i>Detail Produk
            </h3>
            <div class="bg-gray-50 rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-green-600 text-white">
                        <tr>
                            <th class="px-4 py-3 text-left">Produk</th>
                            <th class="px-4 py-3 text-left">Harga</th>
                            <th class="px-4 py-3 text-center">Qty</th>
                            <th class="px-4 py-3 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transaction->details as $detail)
                        <tr>
                            <td class="px-4 py-3 font-semibold">{{ $detail->product->name }}</td>
                            <td class="px-4 py-3">Rp {{ number_format($detail->price, 0, ',', '.') }}</td>
                            <td class="px-4 py-3 text-center">{{ $detail->quantity }}</td>
                            <td class="px-4 py-3 text-right font-semibold text-green-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="mt-8 flex space-x-3">
            <button onclick="window.print()" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition">
                <i class="fas fa-print mr-2"></i>Cetak
            </button>
            <a href="{{ route('admin.transactions.index') }}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<style>
@media print {
    aside, header, button, .no-print {
        display: none !important;
    }
    .ml-64 {
        margin-left: 0 !important;
    }
}
</style>
@endsection
