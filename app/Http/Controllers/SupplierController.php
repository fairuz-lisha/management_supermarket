<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::withCount('products')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        // Generate kode supplier baru
        $supplierCode = Supplier::generateCode();
        
        return view('admin.suppliers.create', compact('supplierCode'));
    }

    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'supplier_code' => 'required|string|unique:suppliers,supplier_code|max:20',
            'supplier_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'no_telephone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,nonaktif'
        ], [
            'supplier_code.required' => 'Kode supplier harus diisi',
            'supplier_code.unique' => 'Kode supplier sudah digunakan',
            'supplier_name.required' => 'Nama supplier harus diisi',
            'no_telephone.required' => 'Nomor telepon harus diisi',
            'address.required' => 'Alamat harus diisi',
            'status.required' => 'Status harus dipilih',
            'email.email' => 'Format email tidak valid'
        ]);

        try {
            Supplier::create($validated);

            return redirect()->route('admin.suppliers.index')
                ->with('success', 'Supplier berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal menambahkan supplier: ' . $e->getMessage());
        }
    }

    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        // Validasi (kode supplier tidak boleh diubah)
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_name' => 'nullable|string|max:255',
            'no_telephone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'city' => 'nullable|string|max:100',
            'status' => 'required|in:aktif,nonaktif'
        ], [
            'supplier_name.required' => 'Nama supplier harus diisi',
            'no_telephone.required' => 'Nomor telepon harus diisi',
            'address.required' => 'Alamat harus diisi',
            'status.required' => 'Status harus dipilih',
            'email.email' => 'Format email tidak valid'
        ]);

        try {
            $supplier->update($validated);

            return redirect()->route('admin.suppliers.index')
                ->with('success', 'Supplier berhasil diperbarui!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui supplier: ' . $e->getMessage());
        }
    }

    public function destroy(Supplier $supplier)
    {
        try {
            // Cek apakah supplier punya produk
            if ($supplier->products()->count() > 0) {
                return redirect()->back()
                    ->with('error', 'Tidak dapat menghapus supplier karena masih memiliki produk terkait!');
            }
            
            $supplier->delete();
            
            return redirect()->route('admin.suppliers.index')
                ->with('success', 'Supplier berhasil dihapus!');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus supplier: ' . $e->getMessage());
        }
    }
}