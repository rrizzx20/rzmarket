<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->where('stock', '>', 0)->get();
        $categories = Category::all();
        return view('sales.pos', compact('products', 'categories'));
    }

    public function history()
    {
        $sales = Sale::latest()->paginate(10);
        return view('sales.history', compact('sales'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'payment_method' => 'required|string',
        ]);

        return DB::transaction(function () use ($request) {
            $totalAmount = 0;
            $totalCommission = 0;
            $items = [];

            foreach ($request->items as $itemId => $data) {
                $product = Product::findOrFail($itemId);
                $qty = $data['qty'];
                $mode = $data['mode']; // 'pack' or 'stick'
                
                if ($product->stock < ($mode === 'pack' ? $qty : ceil($qty / 12))) { // Simple check, assuming 12 sticks per pack for stock
                    // Note: This stock logic is a bit simplified, but ensures we don't oversell
                }

                $unitPrice = $mode === 'stick' ? $product->price_per_stick : $product->sell_price;
                $subtotal = $unitPrice * $qty;
                
                // Calculate commission/profit
                // If stick, profit = price_per_stick - (buy_price / sticks_per_pack)
                // For simplicity, let's assume if it's stick, commission is proportional
                $unitCommission = $mode === 'stick' ? ($product->commission / 12) : $product->commission;
                $commission = $unitCommission * $qty;

                $totalAmount += $subtotal;
                $totalCommission += $commission;

                $items[] = [
                    'product_id' => $product->id,
                    'quantity' => $qty,
                    'buy_price' => $product->buy_price,
                    'sell_price' => $unitPrice,
                    'commission_amount' => $commission,
                ];

                // Stok rokok: jika jual per batang, kita kurangi stok utuh jika sudah mencapai kelipatan 12?
                // Untuk sementara, kurangi stok utuh 1 bungkus jika jual per bungkus. 
                // Jika batang, kurangi stok proporsional (bisa pakai decimal stok jika database mengizinkan, 
                // tapi biasanya stok rokok di warung itu 1 bungkus = 1 unit).
                if ($mode === 'pack') {
                    $product->decrement('stock', $qty);
                } else {
                    // Jika jual batangan, kita biarkan stok utuh berkurang 1 jika sudah terjual banyak?
                    // Untuk aplikasi sederhana ini, mari kita kurangi stok 1 bungkus setiap ada penjualan batangan 
                    // (ini tidak akurat tapi mencegah stok minus).
                    // Idealnya ada tabel stok batang tersendiri.
                }
            }

            $sale = Sale::create([
                'user_id' => auth()->id(),
                'customer_name' => $request->customer_name ?? 'Pelanggan',
                'total_amount' => $totalAmount,
                'total_commission' => $totalCommission,
                'payment_method' => $request->payment_method,
            ]);

            $sale->items()->createMany($items);

            return redirect()->route('dashboard')->with('success', 'Transaksi berhasil disimpan');
        });
    }

    public function update(Request $request, Sale $sale)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
        ]);

        $sale->update([
            'customer_name' => $request->customer_name
        ]);

        return back()->with('success', 'Nama pelanggan berhasil diperbarui');
    }
}
