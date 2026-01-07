<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Tampilkan daftar supplier
     */
    public function index()
    {
        // products_count dibuat otomatis oleh withCount()
        $suppliers = Supplier::withCount('products')->paginate(10);

        return view('admin.suppliers.index', compact('suppliers'));
    }

    /**
     * Form tambah supplier
     */
    public function create()
    {
        return view('admin.suppliers.create');
    }

    /**
     * Simpan supplier baru
     */
    public function store(Request $request)
    {
        // 🔒 VALIDASI (HARUS SAMA DENGAN DATABASE & FORM)
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_name'  => 'required|string|max:255',
            'no_telephone'  => 'required|string|max:20',
            'email'         => 'nullable|email',
            'address'       => 'required|string',
            'city'          => 'required|string|max:100',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        // 🔥 AUTO GENERATE SUPPLIER CODE
        $lastSupplier = Supplier::orderBy('id', 'desc')->first();

        $number = $lastSupplier
            ? intval(substr($lastSupplier->supplier_code, 3)) + 1
            : 1;

        $validated['supplier_code'] = 'SUP' . str_pad($number, 4, '0', STR_PAD_LEFT);

        // ✅ SIMPAN KE DATABASE
        Supplier::create($validated);

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan');
    }

    /**
     * Form edit supplier
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.suppliers.edit', compact('supplier'));
    }

    /**
     * Update supplier
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validated = $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_name'  => 'required|string|max:255',
            'no_telephone'  => 'required|string|max:20',
            'email'         => 'nullable|email',
            'address'       => 'required|string',
            'city'          => 'required|string|max:100',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        $supplier->update($validated);

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui');
    }

    /**
     * Hapus supplier
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('admin.suppliers.index')
            ->with('success', 'Supplier berhasil dihapus');
    }
}
