<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Cek apakah table ada
            if (!DB::getSchemaBuilder()->hasTable('products')) {
                return redirect()->back()->with('error', 'Database belum siap. Jalankan: php artisan migrate:fresh');
            }

            $totalProducts = Product::count();
            $totalCategories = Category::count();
            $totalSuppliers = Supplier::count();
            $totalTransactions = Transaction::count();
            // Use existing column 'total_payment' (migrations renamed/removed 'total')
            $totalRevenue = Transaction::sum('total_payment') ?? 0;
            $lowStock = Product::where('stock', '<', 10)->count();
            
            $recentTransactions = Transaction::with('details.product')
                ->latest()
                ->take(5)
                ->get();
            
            $topProducts = Product::withCount('transactionDetails')
                ->orderBy('transaction_details_count', 'desc')
                ->take(5)
                ->get();

            return view('admin.dashboard', compact(
                'totalProducts', 'totalCategories', 'totalSuppliers',
                'totalTransactions', 'totalRevenue', 'lowStock',
                'recentTransactions', 'topProducts'
            ));

        } catch (\Exception $e) {
            // Log the database error and show a 500 page instead of redirecting to login
            \Illuminate\Support\Facades\Log::error('DashboardController index database error: ' . $e->getMessage());
            abort(500, 'Database error: ' . $e->getMessage());
        }
    }
}