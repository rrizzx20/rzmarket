<x-smoke-layout>
    <x-slot name="title">Setor Tabungan - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Setor Tabungan</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Masukkan uang ke dalam target tabungan Anda.</p>
        </div>
    </div>

    <div style="max-width: 600px;">
        <div class="smoke-card">
            <form action="{{ route('savings.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Pilih Target</label>
                    <select name="target_id" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                        @foreach(\App\Models\SavingTarget::where('status', 'active')->get() as $target)
                            <option value="{{ $target->id }}">{{ $target->name }} (Kurang: Rp {{ number_format($target->target_amount - $target->current_amount, 0, ',', '.') }})</option>
                        @endforeach
                    </select>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Nominal (Rp)</label>
                    <input type="number" name="amount" required placeholder="Masukkan jumlah uang" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                </div>

                <input type="hidden" name="type" value="deposit">

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Keterangan / Catatan</label>
                    <textarea name="description" rows="3" placeholder="Contoh: Tabungan harian dari untung jual Surya" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem; resize: none;"></textarea>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-primary" style="flex: 1;">Simpan Setoran</button>
                    <a href="{{ route('savings.index') }}" style="flex: 1; display: flex; align-items: center; justify-content: center; text-decoration: none; background: rgba(255,255,255,0.05); color: white; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; border: 1px solid rgba(255,255,255,0.1);">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-smoke-layout>
