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

        // Hitung total item (quantity)
        $totalItems = 0;
        $subtotal = 0;

        foreach ($cart as $item) {
            $totalItems += $item['quantity'];
            $subtotal += $item['price'] * $item['quantity'];
        }

        // Tentukan diskon berdasarkan jumlah item
        $discountPercent = 0;
        $discountMessage = '';

        if ($totalItems >= 10) {
            $discountPercent = 15;
            $discountMessage = 'Selamat! Anda mendapat diskon 15% (belanja ≥ 10 item)';
        } elseif ($totalItems >= 5) {
            $discountPercent = 10;
            $discountMessage = 'Selamat! Anda mendapat diskon 10% (belanja 5-9 item)';
        } elseif ($totalItems >= 3) {
            $discountPercent = 5;
            $discountMessage = 'Anda mendapat diskon 5% (belanja 3-4 item)';
        } else {
            $discountMessage = 'Belanja min. 3 item untuk dapat diskon 5%';
        }

        $discountAmount = $subtotal * ($discountPercent / 100);
        $total = $subtotal - $discountAmount;

        return view('shop.checkout', compact(
            'cart',
            'totalItems',
            'subtotal',
            'discountPercent',
            'discountAmount',
            'total',
            'discountMessage'
        ));
    }

    public function processCheckout(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string',
            'payment_method' => 'required|in:cash,transfer,e-wallet'
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('shop.index')->with('error', 'Keranjang kosong!');
        }

        DB::beginTransaction();

        try {
            // Hitung total item dan subtotal
            $totalItems = 0;
            $subtotal = 0;
            
            foreach ($cart as $item) {
                $totalItems += $item['quantity'];
                $subtotal += $item['price'] * $item['quantity'];
            }

            // Tentukan diskon berdasarkan jumlah item
            $discountPercent = 0;
            
            if ($totalItems >= 10) {
                $discountPercent = 15;
            } elseif ($totalItems >= 5) {
                $discountPercent = 10;
            } elseif ($totalItems >= 3) {
                $discountPercent = 5;
            }

            $discountAmount = $subtotal * ($discountPercent / 100);
            $totalPayment = $subtotal - $discountAmount;

            // Generate invoice number
            $invoiceNumber = Transaction::generateCode();

            // Create transaction
            $transaction = Transaction::create([
                'invoice_number' => $invoiceNumber,
                'transaction_date' => now()->toDateString(),
                'customer_name' => $request->customer_name,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'subtotal' => $subtotal,
                'discount_persent' => $discountPercent,
                'discount_amount' => $discountAmount,
                'total_payment' => $totalPayment,
                'amount_received' => $totalPayment,
                'change' => 0,
                'payment_method' => $request->payment_method,
                'status' => 'completed',
            ]);

            // Create transaction details
            foreach ($cart as $productId => $item) {
                $product = Product::findOrFail($productId);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok {$product->product_name} tidak mencukupi!");
                }

                TransactionDetail::create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $productId,
                    'product_code' => $product->product_code,
                    'product_name' => $product->product_name,
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);

                // Kurangi stok
                $product->decrement('stock', $item['quantity']);
            }

            session()->forget('cart');
            
            DB::commit();

            return redirect()->route('shop.success', $transaction->id);
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Gagal memproses checkout: ' . $e->getMessage());
        }
    }

    public function success($id)
    {
        $transaction = Transaction::with('details.product')->findOrFail($id);
        return view('shop.success', compact('transaction'));
    }
}
