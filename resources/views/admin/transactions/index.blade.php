@extends('layouts.admin')

@section('title', 'Transaksi')
@section('page-title', 'Riwayat Transaksi')

@section('content')
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Kode Transaksi</th>
                    <th class="px-6 py-4 text-left">Customer</th>
                    <th class="px-6 py-4 text-left">Tanggal</th>
                    <th class="px-6 py-4 text-left">Pembayaran</th>
                    <th class="px-6 py-4 text-left">Total</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($transactions as $index => $trans)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $transactions->firstItem() + $index }}</td>
                    <td class="px-6 py-4 font-mono text-sm font-semibold text-green-600">{{ $trans->transaction_code }}</td>
                    <td class="px-6 py-4">
                        <div>
                            <p class="font-semibold text-gray-800">{{ $trans->customer_name }}</p>
                            <p class="text-sm text-gray-600">{{ $trans->customer_phone }}</p>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-gray-600">{{ $trans->created_at->format('d M Y, H:i') }}</td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                            {{ ucfirst($trans->payment_method) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-bold text-gray-800">Rp {{ number_format($trans->total, 0, ',', '.') }}</td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-sm font-semibold
                            {{ $trans->status == 'completed' ? 'bg-green-100 text-green-700' : ($trans->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                            {{ ucfirst($trans->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.transactions.show', $trans) }}" class="text-blue-600 hover:text-blue-700">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-5xl mb-3 block"></i>
                        Belum ada transaksi
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $transactions->links() }}
</div>
@endsection