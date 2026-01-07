@extends('layouts.admin')

@section('title', 'Kategori')
@section('page-title', 'Manajemen Kategori')

@section('content')

<!-- BUTTON TAMBAH -->
<div class="mb-6">
    <a href="{{ route('admin.categories.create') }}"
       class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
        <i class="fas fa-plus mr-2"></i> Tambah Kategori
    </a>
</div>

<!-- TABLE -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <table class="w-full text-sm">
        <thead class="bg-green-600 text-white">
            <tr>
                <th class="px-6 py-4 text-left">No</th>
                <th class="px-6 py-4 text-left">Kode</th>
                <th class="px-6 py-4 text-left">Nama</th>
                <th class="px-6 py-4 text-left">Deskripsi</th>
                <th class="px-6 py-4 text-center">Aksi</th>
            </tr>
        </thead>

        <tbody class="divide-y">
            @forelse ($categories as $index => $category)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4">
                    {{ $categories->firstItem() + $index }}
                </td>

                <td class="px-6 py-4 font-semibold">
                    {{ $category->category_code }}
                </td>

                <td class="px-6 py-4">
                    {{ $category->category_name }}
                </td>

                <td class="px-6 py-4">
                    {{ $category->description ?? '-' }}
                </td>

                <td class="px-6 py-4 text-center space-x-3">
                    <!-- EDIT -->
                    <a href="{{ route('admin.categories.edit', $category) }}"
                       class="text-blue-600 hover:text-blue-800">
                        <i class="fas fa-edit"></i>
                    </a>

                    <!-- DELETE -->
                    <form action="{{ route('admin.categories.destroy', $category) }}"
                          method="POST"
                          class="inline"
                          onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
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
                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                    <i class="fas fa-inbox text-5xl mb-4"></i>
                    <p>Belum ada data kategori</p>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- PAGINATION -->
<div class="mt-6">
    {{ $categories->links() }}
</div>

@endsection
