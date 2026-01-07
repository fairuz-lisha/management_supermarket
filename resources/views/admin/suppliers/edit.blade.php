@extends('layouts.admin')

@section('title', 'Edit Supplier')
@section('page-title', 'Edit Supplier')

@section('content')
<div class="max-w-2xl bg-white rounded-xl shadow-lg p-8">

    <form action="{{ route('admin.suppliers.update', $supplier) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="text" name="supplier_name" class="input mb-4"
            value="{{ old('supplier_name', $supplier->supplier_name) }}" required>

        <input type="text" name="contact_name" class="input mb-4"
            value="{{ old('contact_name', $supplier->contact_name) }}" required>

        <input type="text" name="no_telephone" class="input mb-4"
            value="{{ old('no_telephone', $supplier->no_telephone) }}" required>

        <input type="email" name="email" class="input mb-4"
            value="{{ old('email', $supplier->email) }}">

        <textarea name="address" class="input mb-4" required>{{ old('address', $supplier->address) }}</textarea>

        <input type="text" name="city" class="input mb-4"
            value="{{ old('city', $supplier->city) }}" required>

        <select name="status" class="input mb-6">
            <option value="aktif" {{ $supplier->status=='aktif'?'selected':'' }}>Aktif</option>
            <option value="nonaktif" {{ $supplier->status=='nonaktif'?'selected':'' }}>Nonaktif</option>
        </select>

        <button class="btn-primary">Update</button>
        <a href="{{ route('admin.suppliers.index') }}" class="btn-secondary">Kembali</a>

    </form>
</div>
@endsection