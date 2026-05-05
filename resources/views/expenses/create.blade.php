<x-smoke-layout>
    <x-slot name="title">Tambah Pengeluaran - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Tambah Pengeluaran</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Catat pengeluaran uang baru.</p>
        </div>
    </div>

    <div style="max-width: 600px;">
        <div class="smoke-card">
            <form action="{{ route('expenses.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Kategori</label>
                    <select name="category" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                        <option value="Jajan">Jajan</option>
                        <option value="Bensin">Bensin</option>
                        <option value="Makan">Makan</option>
                        <option value="Pribadi">Keperluan Pribadi</option>
                        <option value="Operasional">Operasional Toko</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Jumlah Pengeluaran (Rp)</label>
                    <input type="number" name="amount" required placeholder="Masukkan nominal" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Tanggal</label>
                    <input type="date" name="date" value="{{ date('Y-m-d') }}" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Keterangan / Catatan</label>
                    <textarea name="description" rows="3" placeholder="Contoh: Beli bensin motor" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem; resize: none;"></textarea>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-primary" style="flex: 1;">Simpan Pengeluaran</button>
                    <a href="{{ route('expenses.index') }}" style="flex: 1; display: flex; align-items: center; justify-content: center; text-decoration: none; background: rgba(255,255,255,0.05); color: white; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; border: 1px solid rgba(255,255,255,0.1);">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-smoke-layout>
