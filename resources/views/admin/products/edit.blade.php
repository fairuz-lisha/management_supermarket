@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page-title', 'Edit Produk')

@section('content')
<div class="max-w-3xl bg-white p-8 rounded-xl shadow">

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-2 gap-6">
            <div>
                <label class="font-semibold flex items-center mb-1">
                    <i class="fas fa-box text-green-600 mr-2"></i>
                    Nama Produk <span class="text-red-500 ml-1">*</span>
                </label>
                <input name="product_name" class="w-full border rounded-lg px-4 py-3" class="input" value="{{ $product->product_name }}">
            </div>

            <div>
                <label class="font-semibold flex items-center mb-1">
                    <i class="fas fa-tags text-green-600 mr-2"></i>
                    Kategori <span class="text-red-500 ml-1">*</span>
                </label>
                <select name="category_id" class="w-full border rounded-lg px-4 py-3" class="input">
                    @foreach($categories as $c)
                    <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
                        {{ $c->category_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold flex items-center mb-1">
                    <i class="fas fa-truck text-green-600 mr-2"></i>
                    Supplier
                </label>
                <select name="supplier_id" class="w-full border rounded-lg px-4 py-3" class="input">
                    @foreach($suppliers as $s)
                    <option value="{{ $s->id }}" {{ $product->supplier_id == $s->id ? 'selected' : '' }}>
                        {{ $s->supplier_name }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="font-semibold flex items-center mb-1">
                    <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                    Harga Jual <span class="text-red-500 ml-1">*</span>
                </label>
                <input type="number" name="sale_price" class="w-full border rounded-lg px-4 py-3" class="input" value="{{ $product->sale_price }}">
            </div>

            <div>
                <label class="font-semibold flex items-center mb-1">
                    <i class="fas fa-cubes text-green-600 mr-2"></i>
                    Stok <span class="text-red-500 ml-1">*</span>
                </label>
                <input type="number" name="stock" class="w-full border rounded-lg px-4 py-3" class="input" value="{{ $product->stock }}">
            </div>

            <div>
                <label class="font-semibold flex items-center mb-1">
                    <i class="fas fa-toggle-on text-green-600 mr-2"></i>
                    Status <span class="text-red-500 ml-1">*</span>
                </label>
                <select name="status" class="w-full border rounded-lg px-4 py-3" class="input">
                    <option value="aktif" {{ $product->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ $product->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>

        </div>

        <div class="mt-4">
            <label class="font-semibold flex items-center mb-1">
                <i class="fas fa-image text-green-600 mr-2"></i>
                Gambar Baru
            </label>
            <input type="file" name="image" class="w-full border rounded-lg px-4 py-3">
        </div>

        <div class="mt-4 flex space-x-3">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
                <i class="fas fa-edit mr-2"></i>Update
            </button>
            <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>

    </form>
</div>
@endsection