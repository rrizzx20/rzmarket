<x-smoke-layout>
    <x-slot name="title">Laporan Untung - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Laporan Keuntungan</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Pantau kesehatan keuangan bisnis rokok Anda.</p>
        </div>
    </div>

    <!-- Ringkasan Hari Ini -->
    <h3 style="margin-bottom: 1.25rem; font-size: 1.125rem; font-weight: 700; color: var(--primary);">Hari Ini</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 2.5rem;">
        <div class="smoke-card" style="border-left: 4px solid var(--accent);">
            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Omzet</span>
            <div style="font-size: 1.25rem; font-weight: 800; margin-top: 0.5rem;">Rp {{ number_format($salesToday, 0, ',', '.') }}</div>
        </div>
        <div class="smoke-card" style="border-left: 4px solid var(--danger);">
            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Pengeluaran</span>
            <div style="font-size: 1.25rem; font-weight: 800; margin-top: 0.5rem;">Rp {{ number_format($expensesToday, 0, ',', '.') }}</div>
        </div>
        <div class="smoke-card" style="border-left: 4px solid var(--success); background: rgba(16, 185, 129, 0.05);">
            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Untung Bersih</span>
            <div style="font-size: 1.25rem; font-weight: 800; margin-top: 0.5rem; color: var(--success);">Rp {{ number_format($netProfitToday, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Ringkasan Bulan Ini -->
    <h3 style="margin-bottom: 1.25rem; font-size: 1.125rem; font-weight: 700; color: var(--primary);">Bulan Ini</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1rem; margin-bottom: 2.5rem;">
        <div class="smoke-card" style="border-left: 4px solid var(--accent);">
            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Total Omzet</span>
            <div style="font-size: 1.25rem; font-weight: 800; margin-top: 0.5rem;">Rp {{ number_format($salesMonth, 0, ',', '.') }}</div>
        </div>
        <div class="smoke-card" style="border-left: 4px solid var(--danger);">
            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Total Pengeluaran</span>
            <div style="font-size: 1.25rem; font-weight: 800; margin-top: 0.5rem;">Rp {{ number_format($expensesMonth, 0, ',', '.') }}</div>
        </div>
        <div class="smoke-card" style="border-left: 4px solid var(--success); background: rgba(16, 185, 129, 0.05);">
            <span style="font-size: 0.75rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px;">Total Untung Bersih</span>
            <div style="font-size: 1.25rem; font-weight: 800; margin-top: 0.5rem; color: var(--success);">Rp {{ number_format($netProfitMonth, 0, ',', '.') }}</div>
        </div>
    </div>

    <!-- Total Keseluruhan -->
    <h3 style="margin-bottom: 1.25rem; font-size: 1.125rem; font-weight: 700; color: var(--primary);">Semua Waktu</h3>
    <div class="smoke-card" style="background: linear-gradient(135deg, rgba(255,159,28,0.1) 0%, rgba(0,0,0,0) 100%);">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
            <div>
                <span style="font-size: 0.75rem; color: var(--text-muted);">Akumulasi Omzet</span>
                <div style="font-size: 1.5rem; font-weight: 800; margin-top: 0.5rem;">Rp {{ number_format($salesTotal, 0, ',', '.') }}</div>
            </div>
            <div>
                <span style="font-size: 0.75rem; color: var(--text-muted);">Akumulasi Pengeluaran</span>
                <div style="font-size: 1.5rem; font-weight: 800; margin-top: 0.5rem; color: var(--danger);">Rp {{ number_format($expensesTotal, 0, ',', '.') }}</div>
            </div>
            <div>
                <span style="font-size: 0.75rem; color: var(--text-muted);">Total Keuntungan Bersih</span>
                <div style="font-size: 1.75rem; font-weight: 900; margin-top: 0.5rem; color: var(--success);">Rp {{ number_format($netProfitTotal, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
</x-smoke-layout>
