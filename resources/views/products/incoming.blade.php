<x-smoke-layout>
    <x-slot name="title">Barang Masuk - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Barang Masuk</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Tambah stok produk dari pengiriman barang.</p>
        </div>
    </div>

    <div style="max-width: 600px;">
        <div class="smoke-card">
            <form action="{{ route('products.store.incoming') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Pilih Produk</label>
                    <select name="product_id" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                        @forelse($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @empty
                            <option disabled>Belum ada produk. Silakan tambah produk terlebih dahulu.</option>
                        @endforelse
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Jumlah Masuk (Maks. 10)</label>
                        <input type="number" name="quantity" min="1" max="10" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Harga Beli / Masuk</label>
                        <input type="number" name="buy_price" required placeholder="Contoh: 20000" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Harga Jual / Batang</label>
                    <input type="number" name="price_per_stick" required placeholder="Contoh: 2000" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                </div>

                <button type="submit" class="btn-primary" style="width: 100%;">Simpan Stok Masuk</button>
            </form>
        </div>
    </div>
</x-smoke-layout>
