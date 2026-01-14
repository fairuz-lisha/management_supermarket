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

<div class="bg-white rounded-xl shadow overflow-x-auto">
    <table class="w-full">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="px-6 py-4 text-left">#</th>
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

        <tbody>
            @foreach($products as $i => $p)
            <tr class="border-t">
                <td>{{ $products->firstItem() + $i }}</td>
                <td>{{ $p->product_code }}</td>
                <td>{{ $p->product_name }}</td>
                <td>{{ $p->category->category_name }}</td>
                <td>{{ $p->supplier->supplier_name }}</td>
                <td>Rp {{ number_format($p->sale_price) }}</td>
                <td>{{ $p->stock }}</td>
                <td>{{ $p->status }}</td>
                <td class="flex gap-2">
                    <a href="{{ route('admin.products.edit', $p) }}">
                        <i class="fas fa-edit text-blue-600 hover:text-blue-800"></i>
                    </a>
                    <form action="{{ route('admin.products.destroy', $p) }}" method="POST">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Hapus?')">
                            <i class="fas fa-trash text-red-600 hover:text-red-800"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="mt-4">
    {{ $products->links() }}
</div>

@endsection