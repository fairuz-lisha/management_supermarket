@extends('layouts.admin')

@section('title', 'Tambah Kategori')
@section('page-title', 'Tambah Kategori')

@section('content')
<div class="max-w-2xl">
    <div class="bg-white rounded-xl shadow-lg p-8">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label class="block font-semibold mb-2">Nama Kategori *</label>
                <input type="text" name="category_name" required
                    value="{{ old('category_name') }}"
                    class="w-full border rounded-lg px-4 py-3">
                @error('category_name')
                <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label class="block font-semibold mb-2">Deskripsi</label>
                <textarea name="description" rows="4"
                    class="w-full border rounded-lg px-4 py-3">{{ old('description') }}</textarea>
            </div>

            <button type="submit" class="btn-primary px-6 py-3 text-white rounded-lg">
                Simpan
            </button>
        </form>
    </div>
</div>
@endsection
