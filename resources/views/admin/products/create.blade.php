@extends('layouts.admin')

@section('title', 'Tambah Produk')
@section('page-title', 'Tambah Produk')

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-lg p-8">

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid grid-cols-2 gap-6">

                

                <div>
                    <label class="block font-semibold mb-2">Nama Produk *</label>
                    <input type="text" name="product_name"
                        value="{{ old('product_name') }}"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>

                <div>
                    <label class="block font-semibold mb-2">Kategori *</label>
                    <select name="category_id"
                        class="w-full border rounded-lg px-4 py-3" required>
                        <option value="">Pilih</option>
                        @foreach($categories as $c)
                            <option value="{{ $c->id }}">{{ $c->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-2">Supplier </label>
                    <select name="supplier_id"
                        class="w-full border rounded-lg px-4 py-3">
                        <option value="">Pilih</option>
                        @foreach($suppliers as $s)
                            <option value="{{ $s->id }}">{{ $s->supplier_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-semibold mb-2">Harga Beli</label>
                    <input type="number" name="purchase_price"
                        class="w-full border rounded-lg px-4 py-3">
                </div>

                <div>
                    <label class="block font-semibold mb-2">Harga Jual *</label>
                    <input type="number" name="sale_price"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>

                <div>
                    <label class="block font-semibold mb-2">Stok *</label>
                    <input type="number" name="stock"
                        class="w-full border rounded-lg px-4 py-3" required>
                </div>

                <div>
                    <label class="block font-semibold mb-2">Minimum Stok</label>
                    <input type="number" name="minimum_stock"
                        class="w-full border rounded-lg px-4 py-3">
                </div>

                <div>
                    <label class="block font-semibold mb-2">Satuan</label>
                    <input type="text" name="unit"
                        placeholder="pcs / box"
                        class="w-full border rounded-lg px-4 py-3">
                </div>

                <div>
                    <label class="block font-semibold mb-2">Status</label>
                    <select name="status"
                        class="w-full border rounded-lg px-4 py-3">
                        <option value="aktif">Aktif</option>
                        <option value="nonaktif">Nonaktif</option>
                    </select>
                </div>

            </div>

            <div class="mt-6">
                <label class="block font-semibold mb-2">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="w-full border rounded-lg px-4 py-3"></textarea>
            </div>

            <div class="mt-6">
                <label class="block font-semibold mb-2">Gambar</label>
                <input type="file" name="image"
                    class="w-full border rounded-lg px-4 py-3">
            </div>
            
            <div class="mt-8 flex gap-3">
                <button type="submit"
                    class="btn-primary px-6 py-3 text-white rounded-lg">
                    Simpan
                </button>
                <a href="{{ route('admin.products.index') }}"
                    class="btn-secondary px-6 py-3 rounded-lg">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
