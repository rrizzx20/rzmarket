<x-smoke-layout>
    <x-slot name="title">Stok Saat Ini - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Stok Rokok</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Manajemen stok rokok saat ini.</p>
        </div>
    </div>

    <div class="smoke-card" style="padding: 0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.02); border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Nama Produk</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Harga / Bungkus</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Harga / Batang</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Stok</th>
                    <th style="padding: 1rem; font-size: 0.8125rem; color: var(--text-muted);">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td style="padding: 1rem; font-weight: 600;">{{ $product->name }}</td>
                        <td style="padding: 1rem; font-weight: 700; color: var(--primary);">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</td>
                        <td style="padding: 1rem; font-weight: 700; color: var(--accent);">Rp {{ number_format($product->price_per_stick, 0, ',', '.') }}</td>
                        <td style="padding: 1rem;">
                            <span style="background: {{ $product->stock <= 5 ? 'rgba(239, 68, 68, 0.1)' : 'rgba(16, 185, 129, 0.1)' }}; 
                                         color: {{ $product->stock <= 5 ? 'var(--danger)' : 'var(--success)' }}; 
                                         padding: 0.25rem 0.75rem; border-radius: 0.5rem; font-weight: 600;">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td style="padding: 1rem; display: flex; gap: 0.75rem; align-items: center;">
                            <a href="{{ route('products.edit', $product) }}" style="color: var(--accent); text-decoration: none; font-size: 0.8125rem; font-weight: 600;">Edit Detail</a>
                            <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: none; border: none; color: var(--danger); cursor: pointer; font-size: 0.8125rem; font-weight: 600; padding: 0;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-smoke-layout>
