@extends('layouts.admin')

@section('title', 'Supplier')
@section('page-title', 'Manajemen Supplier')

@section('content')

<!-- BUTTON TAMBAH -->
<div class="mb-6">
    <a href="{{ route('admin.suppliers.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
        <i class="fas fa-plus mr-2"></i> Tambah Supplier
    </a>
</div>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Kode</th>
                <th class="px-6 py-4 text-left">Nama Perusahaan</th>
                <th class="px-6 py-4 text-left">Kontak</th>
                <th class="px-6 py-4 text-left">Telepon</th>
                <th class="px-6 py-4 text-left">Email</th>
                <th class="px-6 py-4 text-left">Produk</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @forelse ($suppliers as $index => $supplier)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    {{ $suppliers->firstItem() + $index }}
                </td>

                <td class="px-6 py-4 font-semibold">
                    {{ $supplier->supplier_code }}
                </td>

                <td class="px-6 py-4">
                    {{ $supplier->supplier_name }}
                </td>

                <td class="px-6 py-4">
                    {{ $supplier->contact_name }}
                </td>

                <td class="px-6 py-4">
                    {{ $supplier->no_telephone }}
                </td>

                <td class="px-6 py-4">
                    {{ $supplier->email ?? '-' }}
                </td>

                <td class="px-6 py-4">
                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-semibold">
                        {{ $supplier->products_count }} Produk
                    </span>
                </td>

                <td class="px-6 py-4 text-center space-x-3">
                    <a href="{{ route('admin.suppliers.edit', $supplier) }}"
                       class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form action="{{ route('admin.suppliers.destroy', $supplier) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-red-600 hover:text-red-800">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-inbox text-5xl mb-4"></i>
                    <p>Belum ada data supplier</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>


