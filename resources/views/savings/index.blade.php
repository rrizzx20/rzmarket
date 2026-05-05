<x-smoke-layout>
    <x-slot name="title">Tabungan & Target - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Tabungan</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Kelola target dan simpanan uang Anda.</p>
        </div>
        <div style="display: flex; gap: 0.75rem;">
            <a href="{{ route('savings.create.target') }}" style="background: rgba(255,255,255,0.05); color: white; padding: 0.6rem 1rem; border-radius: 0.75rem; text-decoration: none; font-size: 0.875rem; font-weight: 600; border: 1px solid rgba(255,255,255,0.1);">Buat Target</a>
            <a href="{{ route('savings.create') }}" class="btn-primary">Setor Tabungan</a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: rgba(16, 185, 129, 0.1); color: var(--success); padding: 1rem; border-radius: 0.75rem; margin-bottom: 1.5rem; font-size: 0.875rem; border: 1px solid rgba(16, 185, 129, 0.2);">
            {{ session('success') }}
        </div>
    @endif

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
        @forelse($targets as $target)
            @php
                $percentage = $target->target_amount > 0 ? ($target->current_amount / $target->target_amount) * 100 : 0;
                $percentage = min($percentage, 100);
            @endphp
            <div class="smoke-card" style="position: relative; overflow: hidden;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                    <div>
                        <h3 style="margin: 0; font-size: 1.125rem; font-weight: 700;">{{ $target->name }}</h3>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">Target: Rp {{ number_format($target->target_amount, 0, ',', '.') }}</span>
                    </div>
                    <div style="display: flex; gap: 0.5rem; align-items: center;">
                        <span style="background: {{ $target->status == 'achieved' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(255,255,255,0.05)' }}; 
                                     color: {{ $target->status == 'achieved' ? 'var(--success)' : 'var(--text-muted)' }}; 
                                     padding: 0.25rem 0.6rem; border-radius: 0.5rem; font-size: 0.7rem; font-weight: 700; text-transform: uppercase;">
                            {{ $target->status == 'achieved' ? 'Tercapai' : 'Proses' }}
                        </span>
                        <form action="{{ route('savings.destroy.target', $target) }}" method="POST" onsubmit="return confirm('Hapus target tabungan ini? Semua progress akan hilang.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; border: none; color: var(--danger); cursor: pointer; padding: 0; display: flex; align-items: center; opacity: 0.6;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" style="width: 1.25rem; height: 1.25rem;">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>

                <div style="margin-bottom: 0.5rem; display: flex; justify-content: space-between; align-items: flex-end;">
                    <span style="font-size: 1.25rem; font-weight: 800; color: var(--primary);">Rp {{ number_format($target->current_amount, 0, ',', '.') }}</span>
                    <span style="font-size: 0.875rem; font-weight: 600; color: var(--text-muted);">{{ number_format($percentage, 0) }}%</span>
                </div>

                <div style="width: 100%; height: 10px; background: rgba(255,255,255,0.05); border-radius: 5px; overflow: hidden; border: 1px solid rgba(255,255,255,0.02);">
                    <div style="width: {{ $percentage }}%; height: 100%; background: linear-gradient(90deg, #ff9f1c, #ffcc33); border-radius: 5px; transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 0 10px rgba(255, 159, 28, 0.3);"></div>
                </div>
            </div>
        @empty
            <div class="smoke-card" style="text-align: center; padding: 3rem; grid-column: 1/-1;">
                <p style="color: var(--text-muted); margin-bottom: 1rem;">Belum ada target tabungan.</p>
                <a href="{{ route('savings.create.target') }}" style="color: var(--primary); font-weight: 600; text-decoration: none;">Buat Target Sekarang →</a>
            </div>
        @endforelse
    </div>

    <h3 style="margin-bottom: 1rem; font-size: 1.25rem; font-weight: 700;">Riwayat Setoran</h3>
    <div class="smoke-card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Keterangan</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Jumlah</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Tanggal</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($savings as $saving)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 1rem; font-size: 0.875rem;">{{ $saving->description ?? 'Setoran Tabungan' }}</td>
                        <td style="padding: 1rem; font-weight: 700; color: {{ $saving->type == 'deposit' ? 'var(--success)' : 'var(--danger)' }};">
                            {{ $saving->type == 'deposit' ? '+' : '-' }} Rp {{ number_format($saving->amount, 0, ',', '.') }}
                        </td>
                        <td style="padding: 1rem; font-size: 0.875rem; color: var(--text-muted);">{{ $saving->created_at->format('d/m/Y H:i') }}</td>
                        <td style="padding: 1rem;">
                            <form action="{{ route('savings.destroy', $saving) }}" method="POST" onsubmit="return confirm('Hapus catatan setoran ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: var(--danger); cursor: pointer; padding: 0; opacity: 0.6; font-size: 0.75rem; font-weight: 600;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="padding: 3rem; text-align: center; color: var(--text-muted);">Belum ada riwayat transaksi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-smoke-layout>
