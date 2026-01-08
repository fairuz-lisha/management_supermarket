@extends('layouts.admin')

@section('title', 'Supplier')
@section('page-title', 'Manajemen Supplier')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.suppliers.create') }}" class="btn-primary text-white px-6 py-3 rounded-lg inline-block hover:shadow-lg transition">
        <i class="fas fa-plus mr-2"></i>Tambah Supplier
    </a>
</div>

<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gradient-to-r from-green-500 to-green-600 text-white">
                <tr>
                    <th class="px-6 py-4 text-left">No</th>
                    <th class="px-6 py-4 text-left">Kode</th>
                    <th class="px-6 py-4 text-left">Nama Supplier</th>
                    <th class="px-6 py-4 text-left">Kontak</th>
                    <th class="px-6 py-4 text-left">Telepon</th>
                    <th class="px-6 py-4 text-left">Kota</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-left">Produk</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($suppliers as $index => $supplier)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $suppliers->firstItem() + $index }}</td>
                    <td class="px-6 py-4">
                        <span class="font-mono text-sm font-semibold text-green-600">{{ $supplier->supplier_code }}</span>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800">{{ $supplier->supplier_name }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $supplier->contact_name ?? '-' }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $supplier->no_telephone }}</td>
                    <td class="px-6 py-4 text-gray-600">{{ $supplier->city ?? '-' }}</td>
                    <td class="px-6 py-4">
                        @if($supplier->status == 'aktif')
                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-check-circle mr-1"></i>Aktif
                        </span>
                        @else
                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-times-circle mr-1"></i>Nonaktif
                        </span>
                        @endif
                    </td>
                    <td class="px-6 py-4">
                        <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $supplier->products_count }} produk
                        </span>
                    </td>
                    <td class="px-6 py-4 text-center">
                        <a href="{{ route('admin.suppliers.edit', $supplier) }}" 
                           class="text-blue-600 hover:text-blue-700 mr-3"
                           title="Edit">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.suppliers.destroy', $supplier) }}" 
                              method="POST" 
                              class="inline" 
                              onsubmit="return confirm('Yakin ingin menghapus supplier {{ $supplier->supplier_name }}?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="text-red-600 hover:text-red-700"
                                    title="Hapus">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-inbox text-5xl mb-3 block"></i>
                        <p>Belum ada supplier</p>
                        <a href="{{ route('admin.suppliers.create') }}" class="text-green-600 hover:text-green-700 mt-2 inline-block">
                            <i class="fas fa-plus mr-1"></i>Tambah Supplier Pertama
                        </a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-6">
    {{ $suppliers->links() }}
</div>
@endsection

