<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Expense;
use Carbon\Carbon;

class FinanceController extends Controller
{
    public function profit()
    {
        // Statistik Hari Ini
        $today = Carbon::today();
        $salesToday = Sale::whereDate('created_at', $today)->sum('total_amount');
        $profitToday = Sale::whereDate('created_at', $today)->sum('total_commission');
        $expensesToday = Expense::whereDate('date', $today)->sum('amount');
        $netProfitToday = $profitToday - $expensesToday;

        // Statistik Bulan Ini
        $thisMonth = Carbon::now()->month;
        $thisYear = Carbon::now()->year;
        $salesMonth = Sale::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->sum('total_amount');
        $profitMonth = Sale::whereMonth('created_at', $thisMonth)->whereYear('created_at', $thisYear)->sum('total_commission');
        $expensesMonth = Expense::whereMonth('date', $thisMonth)->whereYear('date', $thisYear)->sum('amount');
        $netProfitMonth = $profitMonth - $expensesMonth;

        // Statistik Semua Waktu
        $salesTotal = Sale::sum('total_amount');
        $profitTotal = Sale::sum('total_commission');
        $expensesTotal = Expense::sum('amount');
        $netProfitTotal = $profitTotal - $expensesTotal;

        return view('finance.profit', compact(
            'salesToday', 'profitToday', 'expensesToday', 'netProfitToday',
            'salesMonth', 'profitMonth', 'expensesMonth', 'netProfitMonth',
            'salesTotal', 'profitTotal', 'expensesTotal', 'netProfitTotal'
        ));
    }
}
