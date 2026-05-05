<x-smoke-layout>
    <x-slot name="title">Catat Jajan - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Catat Jajan</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Masukkan detail pengeluaran untuk jajan.</p>
        </div>
    </div>

    <div style="max-width: 600px;">
        <div class="smoke-card">
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <input type="hidden" name="category" value="Jajan">
                <input type="hidden" name="date" value="{{ date('Y-m-d') }}">

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Jumlah Pengeluaran</label>
                    <input type="number" name="amount" required placeholder="0" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Keterangan (Makan apa?)</label>
                    <textarea name="description" rows="3" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem; resize: none;"></textarea>
                </div>

                <button type="submit" class="btn-primary" style="width: 100%;">Simpan Pengeluaran</button>
            </form>
        </div>
    </div>
</x-smoke-layout>
