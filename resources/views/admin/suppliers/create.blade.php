@extends('layouts.admin')

@section('title', 'Tambah Supplier')
@section('page-title', 'Tambah Supplier')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-lg p-8">

        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf

            <!-- Nama Perusahaan -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Nama Perusahaan *</label>
                <input type="text"
                       name="supplier_name"
                       value="{{ old('supplier_name') }}"
                       required
                       class="w-full border rounded-lg px-4 py-3">
                       @error('supplier_name')
                       <p class="text-red-600 text-sm">{{ $message }}</p>
                       @enderror
            </div>

            <!-- Nama Kontak -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Nama Kontak *</label>
                <input type="text"
                       name="contact_name"
                       value="{{ old('contact_name') }}"
                       required
                       class="w-full border rounded-lg px-4 py-3">
            </div>

            <!-- No Telepon -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">No Telepon *</label>
                <input type="text"
                       name="no_telephone"
                       value="{{ old('no_telephone') }}"
                       required
                       class="w-full border rounded-lg px-4 py-3">
            </div>

            <!-- Email -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Email</label>
                <input type="email"
                       name="email"
                       value="{{ old('email') }}"
                       class="w-full border rounded-lg px-4 py-3">
            </div>

            <!-- Alamat -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Alamat *</label>
                <textarea name="address"
                          rows="3"
                          required
                          class="w-full border rounded-lg px-4 py-3">{{ old('address') }}</textarea>
            </div>

            <!-- Kota -->
            <div class="mb-6">
                <label class="block font-semibold mb-2">Kota *</label>
                <input type="text"
                       name="city"
                       value="{{ old('city') }}"
                       required
                       class="w-full border rounded-lg px-4 py-3">
            </div>

            <!-- Status -->
            <div class="mb-8">
                <label class="block font-semibold mb-2">Status *</label>
                <select name="status"
                        class="w-full border rounded-lg px-4 py-3">
                    <option value="active">Aktif</option>
                    <option value="inactive">Nonaktif</option>
                </select>
            </div>

            <!-- Button -->
            <div class="flex gap-3">
                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg">
                    Simpan
                </button>

                <a href="{{ route('admin.suppliers.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">
                    Kembali
                </a>
            </div>

        </form>

    </div>
</div>
@endsection
