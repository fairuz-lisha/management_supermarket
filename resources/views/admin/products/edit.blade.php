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
    <label>Kode Produk</label>
    <input name="product_code" class="input" value="{{ $product->product_code }}">
</div>

<div>
    <label>Nama Produk</label>
    <input name="product_name" class="input" value="{{ $product->product_name }}">
</div>

<div>
    <label>Kategori</label>
    <select name="category_id" class="input">
        @foreach($categories as $c)
        <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? 'selected' : '' }}>
            {{ $c->category_name }}
        </option>
        @endforeach
    </select>
</div>

<div>
    <label>Supplier</label>
    <select name="supplier_id" class="input">
        @foreach($suppliers as $s)
        <option value="{{ $s->id }}" {{ $product->supplier_id == $s->id ? 'selected' : '' }}>
            {{ $s->supplier_name }}
        </option>
        @endforeach
    </select>
</div>

<div>
    <label>Harga Jual</label>
    <input type="number" name="sale_price" class="input" value="{{ $product->sale_price }}">
</div>

<div>
    <label>Stok</label>
    <input type="number" name="stock" class="input" value="{{ $product->stock }}">
</div>

<div>
    <label>Status</label>
    <select name="status" class="input">
        <option value="aktif" {{ $product->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
        <option value="nonaktif" {{ $product->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
    </select>
</div>

</div>

<div class="mt-4">
    <label>Gambar Baru</label>
    <input type="file" name="image">
</div>

<div class="mt-6 flex gap-3">
    <button class="btn-primary">Update</button>
    <a href="{{ route('admin.products.index') }}" class="btn-secondary">Kembali</a>
</div>

</form>
</div>
@endsection
