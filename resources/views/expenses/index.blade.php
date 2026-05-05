<x-smoke-layout>
    <x-slot name="title">Riwayat Pengeluaran - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Pengeluaran</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Catatan uang keluar untuk keperluan operasional dan pribadi.</p>
        </div>
        <a href="{{ route('expenses.create') }}" class="btn-primary">Tambah Pengeluaran</a>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 1rem; border-radius: 0.75rem; margin-bottom: 1.5rem; font-size: 0.875rem; border: 1px solid rgba(16, 185, 129, 0.2);">
            {{ session('success') }}
        </div>
    @endif

    <div class="smoke-card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Kategori</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Keterangan</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Jumlah</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($expenses as $expense)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 1rem;">
                            <span style="background: rgba(255,255,255,0.05); padding: 0.25rem 0.6rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600;">
                                {{ $expense->category }}
                            </span>
                        </td>
                        <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-muted);">{{ $expense->description ?? '-' }}</td>
                        <td style="padding: 1rem; font-weight: 700; color: var(--danger);">Rp {{ number_format($expense->amount, 0, ',', '.') }}</td>
                        <td style="padding: 1rem; font-size: 0.875rem;">{{ \Carbon\Carbon::parse($expense->date)->format('d/m/Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" style="padding: 3rem; text-align: center; color: var(--text-muted);">Belum ada catatan pengeluaran.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-smoke-layout>
