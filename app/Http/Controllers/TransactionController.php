<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('details.product')
            ->latest()
            ->paginate(15);
        return view('transactions.index', compact('transactions'));
    }

    public function show(Transaction $transaction)
    {
        $transaction->load('details.product');
        return view('transactions.show', compact('transaction'));
    }

    public function adminIndex()
    {
        $transactions = Transaction::with('details.product')
            ->latest()
            ->paginate(20);
        return view('admin.transactions.index', compact('transactions'));
    }

    public function adminShow(Transaction $transaction)
    {
        $transaction->load('details.product');
        return view('admin.transactions.show', compact('transaction'));
    }
}
