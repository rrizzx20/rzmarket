<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sale;
use App\Models\Expense;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        
        $totalSalesToday = Sale::whereDate('created_at', $today)->sum('total_amount');
        $totalCommissionToday = Sale::whereDate('created_at', today())->sum('total_commission');
        $totalExpensesToday = Expense::whereDate('date', today())->sum('amount');
        
        // Ringkasan stok rendah
        $lowStockCount = Product::where('stock', '>', 0)->count();

        // Data Grafik: 7 hari terakhir
        $salesData = Sale::where('created_at', '>=', now()->subDays(6))
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        $chartLabels = [];
        $chartValues = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i)->format('Y-m-d');
            $label = now()->subDays($i)->format('D'); // Misal: Mon, Tue, Wed
            $chartLabels[] = $label;
            
            $sale = $salesData->firstWhere('date', $date);
            $chartValues[] = $sale ? (float)$sale->total : 0;
        }

        return view('dashboard', compact(
            'totalSalesToday',
            'totalCommissionToday',
            'totalExpensesToday',
            'lowStockCount',
            'chartLabels',
            'chartValues'
        ));
    }
}
