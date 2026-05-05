<x-smoke-layout>
    <x-slot name="title">Tambah Hutang - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Tambah Hutang</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Catat hutang pelanggan baru.</p>
        </div>
    </div>

    <div style="max-width: 600px;">
        <div class="smoke-card">
            <form action="{{ route('debts.store') }}" method="POST">
                @csrf
                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Nama Pelanggan</label>
                    <input type="text" name="customer_name" required placeholder="Masukkan nama pelanggan" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Pilih Produk</label>
                        <select id="product_select" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                            <option value="0" data-price="0">-- Pilih Produk --</option>
                            @foreach($products as $product)
                                <option value="{{ $product->id }}" data-price="{{ $product->price_per_stick }}">
                                    {{ $product->name }} (Rp {{ number_format($product->price_per_stick, 0, ',', '.') }}/btg)
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Jumlah Batang</label>
                        <input type="number" id="qty_sticks" value="1" min="1" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Total Hutang (Rp)</label>
                    <input type="number" name="amount" id="total_amount" readonly required style="width: 100%; background: rgba(255,255,255,0.02); color: var(--danger); border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem; font-weight: 700; font-size: 1.125rem;">
                </div>

                <div style="margin-bottom: 1.5rem;">
                    <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Keterangan / Catatan</label>
                    <textarea name="description" id="description" rows="3" placeholder="Contoh: Hutang Surya 12 empat batang" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem; resize: none;"></textarea>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <button type="submit" class="btn-primary" style="flex: 1;">Simpan Hutang</button>
                    <a href="{{ route('debts.index') }}" style="flex: 1; display: flex; align-items: center; justify-content: center; text-decoration: none; background: rgba(255,255,255,0.05); color: white; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; border: 1px solid rgba(255,255,255,0.1);">Batal</a>
                </div>
            </form>

            <script>
                const productSelect = document.getElementById('product_select');
                const qtyInput = document.getElementById('qty_sticks');
                const totalInput = document.getElementById('total_amount');
                const descInput = document.getElementById('description');

                function calculateTotal() {
                    const selectedOption = productSelect.options[productSelect.selectedIndex];
                    const pricePerStick = parseFloat(selectedOption.getAttribute('data-price')) || 0;
                    const qty = parseInt(qtyInput.value) || 0;
                    const total = pricePerStick * qty;
                    
                    totalInput.value = total;
                    
                    if (pricePerStick > 0) {
                        const productName = selectedOption.text.split('(')[0].trim();
                        descInput.value = `Hutang ${productName} ${qty} batang`;
                    }
                }

                productSelect.addEventListener('change', calculateTotal);
                qtyInput.addEventListener('input', calculateTotal);
            </script>
        </div>
    </div>
</x-smoke-layout>
