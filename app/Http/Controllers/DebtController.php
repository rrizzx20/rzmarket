<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Debt;

class DebtController extends Controller
{
    public function index()
    {
        $debts = Debt::where('status', 'pending')->latest()->get();
        return view('debts.index', compact('debts'));
    }

    public function create()
    {
        $products = \App\Models\Product::where('stock', '>', 0)->get();
        return view('debts.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string',
            'amount' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Debt::create($request->except('_token'));

        return redirect()->route('debts.index')->with('success', 'Hutang berhasil dicatat');
    }

    public function payments()
    {
        $payments = Debt::where('status', 'paid')->latest()->get();
        return view('debts.payments', compact('payments'));
    }

    public function pay(Debt $debt)
    {
        $debt->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->route('debts.index')->with('success', 'Pembayaran berhasil dicatat');
    }
}
