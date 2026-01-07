<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'supplier'])->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create', [
            'categories' => Category::all(),
            'suppliers' => Supplier::all()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'supplier_id'     => 'required|exists:suppliers,id',
            'product_name'    => 'required|string|max:255',
            'description'     => 'nullable',
            'purchase_price'  => 'nullable|numeric',
            'sale_price'      => 'required|numeric',
            'stock'           => 'required|integer',
            'minimum_stock'   => 'nullable|integer',
            'unit'            => 'nullable|string|max:50',
            'status'          => 'required|in:aktif,nonaktif',
            'image'           => 'nullable|image|max:2048',
        ]);

        // 🔥 AUTO PRODUCT CODE
        $lastProduct = Product::orderBy('id', 'desc')->first();
        $nextNumber = $lastProduct ? intval(substr($lastProduct->product_code, 4)) + 1 : 1;
        $validated['product_code'] = 'PRD-' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil ditambahkan');
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Category::all(),
            'suppliers' => Supplier::all()
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id'     => 'required|exists:categories,id',
            'supplier_id'     => 'required|exists:suppliers,id',
            'product_name'    => 'required|string|max:255',
            'description'     => 'nullable',
            'purchase_price'  => 'nullable|numeric',
            'sale_price'      => 'required|numeric',
            'stock'           => 'required|integer',
            'minimum_stock'   => 'nullable|integer',
            'unit'            => 'nullable|string|max:50',
            'status'          => 'required|in:aktif,nonaktif',
            'image'           => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil diperbarui');
    }


    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus');
    }
}
