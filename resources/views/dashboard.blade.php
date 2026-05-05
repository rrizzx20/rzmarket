<x-smoke-layout>
    <x-slot name="title">Dashboard - RZ Market</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Selamat Datang!</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Berikut adalah ringkasan bisnis Anda hari ini.</p>
        </div>
    </div>

    <div class="stats-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.25rem; margin-bottom: 2.5rem;">
        <a href="{{ route('sales.history') }}" class="smoke-card" style="border-left: 4px solid var(--primary); display: flex; flex-direction: column; gap: 0.5rem; justify-content: center; min-height: 100px; text-decoration: none; color: inherit;">
            <span class="stat-label">Penjualan Hari Ini</span>
            <span class="stat-value" style="font-size: 1.5rem;">Rp {{ number_format($totalSalesToday, 0, ',', '.') }}</span>
        </a>
        <a href="{{ route('finance.income') }}" class="smoke-card" style="border-left: 4px solid var(--accent); display: flex; flex-direction: column; gap: 0.5rem; justify-content: center; min-height: 100px; text-decoration: none; color: inherit;">
            <span class="stat-label">Komisi Hari Ini</span>
            <span class="stat-value" style="font-size: 1.5rem; color: var(--accent);">Rp {{ number_format($totalCommissionToday, 0, ',', '.') }}</span>
        </a>
        <a href="{{ route('expenses.index') }}" class="smoke-card" style="border-left: 4px solid var(--danger); display: flex; flex-direction: column; gap: 0.5rem; justify-content: center; min-height: 100px; text-decoration: none; color: inherit;">
            <span class="stat-label">Pengeluaran</span>
            <span class="stat-value" style="font-size: 1.5rem; color: var(--danger);">Rp {{ number_format($totalExpensesToday, 0, ',', '.') }}</span>
        </a>
        <a href="{{ route('products.index') }}" class="smoke-card" style="border-left: 4px solid #f59e0b; display: flex; flex-direction: column; gap: 0.5rem; justify-content: center; min-height: 100px; text-decoration: none; color: inherit;">
            <span class="stat-label">Total Produk</span>
            <span class="stat-value text-amber-500" style="font-size: 1.5rem;">{{ $lowStockCount }} <small style="font-size: 0.875rem; font-weight: 400; opacity: 0.7;">Jenis</small></span>
        </a>
    </div>


    <div class="smoke-card" style="margin-bottom: 2.5rem; padding: 1.5rem;">
        <h3 style="font-size: 1rem; margin-bottom: 1.5rem;">Tren Penjualan (7 Hari Terakhir)</h3>
        <div style="height: 300px; width: 100%;">
            <canvas id="salesChart"></canvas>
        </div>
    </div>

    @php
        $recentSales = \App\Models\Sale::latest()->take(5)->get();
    @endphp

    <div style="padding: 1rem;">
        <h3 style="font-size: 1rem; margin-bottom: 0.75rem;">Transaksi Terakhir</h3>
        <div class="smoke-card" style="padding: 0;">
            @if($recentSales->isEmpty())
                <div style="padding: 1rem; text-align: center; color: var(--text-muted); font-size: 0.875rem;">
                    Belum ada transaksi hari ini.
                </div>
            @else
                @foreach($recentSales as $sale)
                    <div style="padding: 1rem; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between; align-items: center;">
                        <div>
                            <span style="display: block; font-weight: 600;">#{{ $sale->id }} - {{ $sale->created_at->format('H:i') }}</span>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">{{ ucfirst($sale->payment_method) }}</span>
                        </div>
                        <div style="text-align: right;">
                            <span style="display: block; font-weight: 700;">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('salesChart').getContext('2d');
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($chartLabels),
                    datasets: [{
                        label: 'Omzet Penjualan',
                        data: @json($chartValues),
                        borderColor: '#ff9f1c',
                        backgroundColor: 'rgba(255, 159, 28, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#ff9f1c',
                        pointBorderColor: '#fff',
                        pointBorderWidth: 2,
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: { color: 'rgba(255, 255, 255, 0.05)' },
                            ticks: { 
                                color: '#888', 
                                font: { size: 11 },
                                callback: function(value) {
                                    return 'Rp ' + value.toLocaleString('id-ID');
                                }
                            }
                        },
                        x: {
                            grid: { display: false },
                            ticks: { color: '#888', font: { size: 11 } }
                        }
                    },
                    plugins: {
                        legend: { display: false },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return 'Total: Rp ' + context.parsed.y.toLocaleString('id-ID');
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
</x-smoke-layout>
