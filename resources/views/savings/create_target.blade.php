<x-smoke-layout>
    <x-slot name="title">Buat Target Tabungan - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Buat Target Baru</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Tentukan goal tabungan Anda.</p>
        </div>
    </div>

    <div style="max-width: 600px;">
        <div class="smoke-card">
            <form action="{{ route('savings.store.target') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Nama Target</label>
                    <input type="text" name="name" required placeholder="Contoh: Beli HP Baru atau Modal Dagang" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Nominal Target (Rp)</label>
                    <input type="number" name="target_amount" required placeholder="Contoh: 3000000" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-primary" style="flex: 1;">Simpan Target</button>
                    <a href="{{ route('savings.index') }}" style="flex: 1; display: flex; align-items: center; justify-content: center; text-decoration: none; background: rgba(255,255,255,0.05); color: white; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; border: 1px solid rgba(255,255,255,0.1);">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-smoke-layout>
