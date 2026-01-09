<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use App\Models\TransactionDetail;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category')->where('stock', '>', 0);
        
        if ($request->has('category')) {
            $query->where('category_id', $request->category);
        }
        
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->paginate(12);
        $categories = Category::withCount('products')->get();
        
        return view('shop.index', compact('products', 'categories'));
    }

    public function cart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('shop.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        
        if ($product->stock < $request->quantity) {
            return back()->with('error', 'Stok tidak mencukupi!');
        }
        
        $cart = session()->get('cart', []);
        
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $request->quantity;
        } else {
            $cart[$product->id] = [
                'name' => $product->product_name,
                'price' => $product->sale_price,
                'quantity' => $request->quantity,
                'image' => $product->image
            ];
        }
        
        session()->put('cart', $cart);
        
        return back()->with('success', 'Produk ditambahkan ke keranjang!');
    }

    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart');
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }
        
        return back()->with('success', 'Keranjang diperbarui!');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart');
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        
        return back()->with('success', 'Produk dihapus dari keranjang!');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Keranjang kosong!');
        }
        
        $subtotal = 0;
        foreach ($cart as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        
        // Hitung diskon (misal: diskon 10% jika belanja > 100000)
        $discount = 0;
        if ($subtotal > 100000) {
            $discount = $subtotal * 0.1;
        }
        
        $total = $subtotal - $discount;
        
        return view('shop.checkout', compact('cart', 'subtotal', 'discount', 'total'));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_address' => 'required|string',
            'customer_phone' => 'required|string|max:20',
            'payment_method' => 'required|in:cash,transfer,e-wallet'
        ]);

        $cart = session()->get('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();
        
        try {
            $subtotal = 0;
            foreach ($cart as $item) {
                $subtotal += $item['price'] * $item['quantity'];
            }

            $discount = 0;
            if ($subtotal > 100000) {
                $discount = $subtotal * 0.1;
            }

            $total = $subtotal - $discount;

            $transaction = Transaction::create([
                'transaction_code' => Transaction::generateCode(),
                'customer_name' => $request->customer_name,
                'customer_address' => $request->customer_address,
                'customer_phone' => $request->customer_phone,
                'payment_method' => $request->payment_method,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'total' => $total,
                'status' => 'completed'
            ]);

            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok {$product->name} tidak mencukupi!");
                }

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            session()->forget('cart');
            
            DB::commit();

            return redirect()->route('shop.success', $transaction->id);
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    public function success($id)
    {
        $transaction = Transaction::with('details.product')->findOrFail($id);
        return view('shop.success', compact('transaction'));
    }
}
