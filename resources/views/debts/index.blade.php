<x-smoke-layout>
    <x-slot name="title">Daftar Hutang - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Hutang / Ngebon</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Daftar pelanggan yang belum melunasi pembayaran.</p>
        </div>
        <a href="{{ route('debts.create') }}" class="btn-primary">Tambah Hutang</a>
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
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Nama Pelanggan</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Keterangan</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Jumlah</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Tanggal</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($debts as $debt)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 1rem; font-weight: 600;">{{ $debt->customer_name }}</td>
                        <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-muted);">{{ $debt->description ?? '-' }}</td>
                        <td style="padding: 1rem; font-weight: 700; color: var(--danger);">Rp {{ number_format($debt->amount, 0, ',', '.') }}</td>
                        <td style="padding: 1rem; font-size: 0.875rem;">{{ $debt->created_at->format('d/m/Y') }}</td>
                        <td style="padding: 1rem;">
                            <form action="{{ route('debts.pay', $debt) }}" method="POST" onsubmit="return confirm('Tandai hutang ini sebagai lunas?')">
                                @csrf
                                <button type="submit" style="background: var(--success); color: white; border: none; padding: 0.4rem 0.8rem; border-radius: 0.5rem; font-size: 0.75rem; font-weight: 600; cursor: pointer;">Lunas</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="padding: 3rem; text-align: center; color: var(--text-muted);">Tidak ada hutang yang tertunda.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-smoke-layout>
