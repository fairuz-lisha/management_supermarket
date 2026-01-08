@extends('layouts.admin')

@section('title', 'Tambah Supplier')
@section('page-title', 'Tambah Supplier')

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
        
        @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
            <p><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</p>
        </div>
        @endif
        
        <form action="{{ route('admin.suppliers.store') }}" method="POST">
            @csrf
            
            <!-- Kode Supplier (Auto Generate, Read Only) -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-barcode text-green-600 mr-2"></i>Kode Supplier *
                </label>
                <input 
                    type="text" 
                    name="supplier_code" 
                    value="{{ $supplierCode }}"
                    readonly
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-100 font-mono text-green-600 font-bold">
                <p class="text-sm text-gray-600 mt-1">
                    <i class="fas fa-info-circle mr-1"></i>Kode otomatis dibuat oleh sistem
                </p>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <!-- Nama Supplier -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-building text-green-600 mr-2"></i>Nama Supplier *
                    </label>
                    <input 
                        type="text" 
                        name="supplier_name"
                        required
                        value="{{ old('supplier_name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('supplier_name') border-red-500 @enderror"
                        placeholder="PT. Contoh Supplier">
                    @error('supplier_name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Nama Kontak -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-user text-green-600 mr-2"></i>Nama Kontak
                    </label>
                    <input 
                        type="text" 
                        name="contact_name"
                        value="{{ old('contact_name') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('contact_name') border-red-500 @enderror"
                        placeholder="Nama kontak person">
                    @error('contact_name')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <!-- Nomor Telepon -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-phone text-green-600 mr-2"></i>Nomor Telepon *
                    </label>
                    <input 
                        type="text" 
                        name="no_telephone"
                        required
                        value="{{ old('no_telephone') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('no_telephone') border-red-500 @enderror"
                        placeholder="08123456789">
                    @error('no_telephone')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Email -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-envelope text-green-600 mr-2"></i>Email
                    </label>
                    <input 
                        type="email" 
                        name="email"
                        value="{{ old('email') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-500 @enderror"
                        placeholder="supplier@email.com">
                    @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <!-- Alamat -->
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">
                    <i class="fas fa-map-marker-alt text-green-600 mr-2"></i>Alamat *
                </label>
                <textarea 
                    name="address" 
                    rows="3" 
                    required
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('address') border-red-500 @enderror"
                    placeholder="Alamat lengkap supplier">{{ old('address') }}</textarea>
                @error('address')
                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            
            <div class="grid md:grid-cols-2 gap-6 mb-6">
                <!-- Kota -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-city text-green-600 mr-2"></i>Kota
                    </label>
                    <input 
                        type="text" 
                        name="city"
                        value="{{ old('city') }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('city') border-red-500 @enderror"
                        placeholder="Jakarta">
                    @error('city')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status -->
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">
                        <i class="fas fa-toggle-on text-green-600 mr-2"></i>Status *
                    </label>
                    <select 
                        name="status" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent @error('status') border-red-500 @enderror">
                        <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                    @error('status')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            
            <div class="flex space-x-3">
                <button type="submit" class="btn-primary text-white px-6 py-3 rounded-lg hover:shadow-lg transition">
                    <i class="fas fa-save mr-2"></i>Simpan
                </button>
                <a href="{{ route('admin.suppliers.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded-lg hover:bg-gray-600 transition">
                    <i class="fas fa-arrow-left mr-2"></i>Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection