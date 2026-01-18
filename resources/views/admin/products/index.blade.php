@extends('layouts.admin')

@section('title', 'Produk')
@section('page-title', 'Manajemen Produk')

@section('content')

<div class="mb-6">
    <a href="{{ route('admin.products.create') }}"
        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
        <i class="fas fa-plus mr-2"></i>Tambah Produk
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Kode</th>
                    <th class="px-6 py-4 text-left">Nama</th>
                    <th class="px-6 py-4 text-left">Kategori</th>
                    <th class="px-6 py-4 text-left">Supplier</th>
                    <th class="px-6 py-4 text-left">Harga</th>
                    <th class="px-6 py-4 text-left">Stok</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @foreach($products as $i => $p)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $products->firstItem() + $i }}</td>
                    <td class="px-6 py-4">
                        <span class="font-mono text-sm font-semibold text-green-600">{{ $p->product_code }}</span>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $p->product_name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $p->category->category_name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $p->supplier->supplier_name }}</td>
                    <td class="px-6 py-4 text-gray-600">Rp {{ number_format($p->sale_price) }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $p->stock }}</td>
                    <td class="px-6 py-4">
                        @if($p->status == 'aktif')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>Aktif
                        </span>
                        @else
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-times-circle mr-1"></i>Nonaktif
                        </span>
                        @endif
                    </td>
                    <td class="flex gap-2">
                        <a href="{{ route('admin.products.edit', $p) }}"
                           class="text-blue-600 hover:text-blue-700 mr-3"
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.products.destroy', $p) }}" 
                              method="POST">
                            @csrf 
                            @method('DELETE')
                            <button onclick="return confirm('Yakin ingin menghapus produk {{ $p->product_name }}?')">
                                <i class="fas fa-trash text-red-600 hover:text-red-800"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $products->links() }}
</div>

@endsection