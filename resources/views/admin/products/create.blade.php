@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-lg p-8">

        @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <p class="font-semibold mb-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>Terjadi kesalahan:
            </p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

             {{-- KODE PRODUK (AUTO) --}}
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-barcode text-green-600 mr-2"></i>Kode Produk *
                </label>
                <input type="text"
                    value="{{ $productCode }}"
                    readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100
                           font-mono text-green-600 font-bold">
                <p class="text-sm text-gray-600 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>
                    Kode produk dibuat otomatis oleh sistem
                </p>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- NAMA PRODUK -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-box text-green-600 mr-2"></i>
                        Nama Produk <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="text" name="product_name"
                        class="w-full border rounded-lg px-4 py-3"
                        placeholder="Nama produk" required>
                </div>

                 <!-- KATEGORI -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-tags text-green-600 mr-2"></i>
                        Kategori <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="category_id"
                        class="w-full border rounded-lg px-4 py-3" required>
                        <option value="">Pilih</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- SUPPLIER -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-truck text-green-600 mr-2"></i>
                        Supplier
                    </label>
                    <select name="supplier_id"
                        class="w-full border rounded-lg px-4 py-3">
                        <option value="">Pilih</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}">{{ $s->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- HARGA BELI -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-shopping-cart text-green-600 mr-2"></i>
                        Harga Beli
                    </label>
                    <input type="number" name="purchase_price"
                        class="w-full border rounded-lg px-4 py-3">
                </div>

                <!-- HARGA JUAL -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-money-bill-wave text-green-600 mr-2"></i>
                        Harga Jual <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="number" name="sale_price"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>

                <!-- STOK -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-cubes text-green-600 mr-2"></i>
                        Stok <span class="text-red-500 ml-1">*</span>
                    </label>
                    <input type="number" name="stock"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>

                 <!-- MINIMUM STOK -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-exclamation-triangle text-green-600 mr-2"></i>
                        Minimum Stok
                    </label>
                    <input type="number" name="minimum_stock"
                        class="w-full border rounded-lg px-4 py-3">
                </div>

                <!-- SATUAN -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-balance-scale text-green-600 mr-2"></i>
                        Satuan
                    </label>
                    <input type="text" name="unit"
                        placeholder="pcs / box"
                        class="w-full border rounded-lg px-4 py-3">
                </div>

               <!-- STATUS -->
                <div>
                    <label class="font-semibold flex items-center mb-1">
                        <i class="fas fa-toggle-on text-green-600 mr-2"></i>
                        Status <span class="text-red-500 ml-1">*</span>
                    </label>
                    <select name="status"
                        class="w-full border rounded-lg px-4 py-3">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>
            </div>

            <!-- DESKRIPSI -->
            <div class="mt-6">
                <label class="font-semibold flex items-center mb-1">
                    <i class="fas fa-align-left text-green-600 mr-2"></i>
                    Deskripsi
                </label>
                <textarea name="description" rows="4"
                    class="w-full border rounded-lg px-4 py-3"></textarea>
            </div>

           <!-- GAMBAR -->
            <div class="mt-6">
                <label class="font-semibold flex items-center mb-1">
                    <i class="fas fa-image text-green-600 mr-2"></i>
                    Gambar Produk
                </label>
                <input type="file" name="image"
                    class="w-full border rounded-lg px-4 py-3">
            </div>
            
            <div class="mt-8 flex gap-3">
                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg shadow transition">
                <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <a href="{{ route('admin.products.index') }}"
                    class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
