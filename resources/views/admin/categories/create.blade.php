@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-lg p-8">

       @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <p class="font-semibold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Terjadi kesalahan:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <!-- Kode Kategori -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-barcode text-green-600 mr-2"></i>Kode Kategori *
                </label>
                <input 
                    type="text"
                    name="category_code"
                    value="{{ $categoryCode }}"
                    readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 font-mono text-green-600 font-bold">
                <p class="text-sm text-gray-600 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>Kode otomatis dibuat oleh sistem
                </p>
            </div>

            <!-- Nama Kategori -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-tags text-green-600 mr-2"></i>Nama Kategori *
                </label>
                <input 
                    type="text"
                    name="category_name"
                    required
                    value="{{ old('category_name') }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('category_name') border-red-500 @enderror"
                    placeholder="Makanan, Minuman, Snack">
                @error('category_name')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Deskripsi -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-align-left text-green-600 mr-2"></i>Deskripsi
                </label>
                <textarea 
                    name="description"
                    rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent"
                    placeholder="Deskripsi kategori">{{ old('description') }}</textarea>
            </div>

            <div class="flex space-x-3">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <a href="{{ route('admin.categories.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
