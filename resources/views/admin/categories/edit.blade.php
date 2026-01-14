@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <label class="block font-semibold mb-2">Kode Kategori</label>
                <input type="text" value="{{ $category->category_code }}"
                    readonly class="w-full bg-gray-100 border rounded-lg px-4 py-3">
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">Nama Kategori *</label>
                <input type="text" name="category_name" required
                    value="{{ old('category_name', $category->category_name) }}"
                    class="w-full border rounded-lg px-4 py-3">
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="w-full border rounded-lg px-4 py-3">{{ old('description', $category->description) }}</textarea>
            </div>

            <div class="fles space-x-3">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
                    <i class="fas fa-edit mr-2"></i>Update
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection