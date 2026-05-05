<x-smoke-layout>
    <x-slot name="title">Riwayat Penjualan - RZ Market</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Riwayat Penjualan</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Daftar transaksi yang telah dilakukan.</p>
        </div>
    </div>

    <div class="smoke-card" style="padding: 0; overflow: hidden;">
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Pelanggan</th>
                        <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">ID</th>
                        <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Waktu</th>
                        <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Metode</th>
                        <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Total</th>
                        <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Komisi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $sale)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td style="padding: 1rem;">
                                <div id="display-name-{{ $sale->id }}" style="display: flex; align-items: center; gap: 0.5rem;">
                                    <span style="font-weight: 700;">{{ $sale->customer_name }}</span>
                                    <button onclick="toggleEdit({{ $sale->id }})" style="background: none; border: none; cursor: pointer; color: var(--text-muted); padding: 0.25rem;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                                    </button>
                                </div>
                                <form id="edit-form-{{ $sale->id }}" action="{{ route('sales.update', $sale->id) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('PATCH')
                                    <div style="display: flex; gap: 0.4rem;">
                                        <input type="text" name="customer_name" value="{{ $sale->customer_name }}" style="background: var(--bg-dark); color: white; border: 1px solid var(--primary); border-radius: 0.4rem; padding: 0.2rem 0.5rem; font-size: 0.875rem; width: 120px;">
                                        <button type="submit" style="background: var(--primary); border: none; border-radius: 0.4rem; padding: 0.2rem 0.5rem; cursor: pointer; color: black; font-weight: 700; font-size: 0.75rem;">OK</button>
                                        <button type="button" onclick="toggleEdit({{ $sale->id }})" style="background: rgba(255,255,255,0.1); border: none; border-radius: 0.4rem; padding: 0.2rem 0.5rem; cursor: pointer; color: white; font-size: 0.75rem;">X</button>
                                    </div>
                                </form>
                            </td>
                            <td style="padding: 1rem; font-weight: 600;">#{{ $sale->id }}</td>
                            <td style="padding: 1rem;">{{ $sale->created_at->format('d/m/Y H:i') }}</td>
                            <td style="padding: 1rem;"><span style="background: var(--bg-dark); padding: 0.25rem 0.5rem; border-radius: 0.5rem; font-size: 0.75rem;">{{ strtoupper($sale->payment_method) }}</span></td>
                            <td style="padding: 1rem; font-weight: 700; color: var(--primary);">Rp {{ number_format($sale->total_amount, 0, ',', '.') }}</td>
                            <td style="padding: 1rem; color: var(--accent);">Rp {{ number_format($sale->total_commission, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="padding: 1rem;">
            {{ $sales->links() }}
        </div>
    </div>

    <script>
        function toggleEdit(id) {
            const display = document.getElementById('display-name-' + id);
            const form = document.getElementById('edit-form-' + id);
            if (display.style.display === 'none') {
                display.style.display = 'flex';
                form.style.display = 'none';
            } else {
                display.style.display = 'none';
                form.style.display = 'block';
            }
        }
    </script>
</x-smoke-layout>
