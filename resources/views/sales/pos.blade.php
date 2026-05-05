<x-smoke-layout>
    <x-slot name="title">Jual Rokok - RZ Market</x-slot>

    <div class="pos-container" style="display: flex; gap: 2rem; height: calc(100vh - 5rem); margin-top: 0.5rem;">
        <!-- Product Selection Area -->
        <div style="flex-grow: 1; overflow-y: auto; padding-right: 0.5rem; scrollbar-width: thin;">
            <div class="flex-stack" style="margin-bottom: 1.5rem;">
                <div>
                    <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Jual Rokok</h2>
                    <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Klik produk untuk menambah ke keranjang.</p>
                </div>
            </div>

            <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                @foreach($products as $product)
                    <div class="smoke-card" style="padding: 1rem; display: flex; flex-direction: column; gap: 0.75rem;">
                        <div style="border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 0.5rem;">
                            <span style="display: block; font-size: 0.9375rem; font-weight: 700; color: white;">{{ $product->name }}</span>
                            <span style="font-size: 0.75rem; color: var(--text-muted);">{{ $product->category->name ?? 'Uncategorized' }}</span>
                        </div>
                        
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <!-- Tombol Jual Bungkus -->
                            <button type="button" onclick="addToCart(this, 'pack')" 
                                    data-id="{{ $product->id }}" 
                                    data-name="{{ $product->name }}" 
                                    data-price="{{ (float)$product->sell_price }}"
                                    data-price-per-stick="{{ (float)$product->price_per_stick }}"
                                    style="background: rgba(255,159,28,0.1); border: 1px solid var(--primary); color: var(--primary); padding: 0.5rem; border-radius: 0.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: all 0.2s;">
                                <span style="font-size: 0.75rem; font-weight: 600;">Bungkus</span>
                                <span style="font-size: 0.875rem; font-weight: 700;">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</span>
                            </button>

                            <!-- Tombol Jual Batang -->
                            <button type="button" onclick="addToCart(this, 'stick')" 
                                    data-id="{{ $product->id }}" 
                                    data-name="{{ $product->name }}" 
                                    data-price="{{ (float)$product->sell_price }}"
                                    data-price-per-stick="{{ (float)$product->price_per_stick }}"
                                    style="background: rgba(46,196,182,0.1); border: 1px solid var(--accent); color: var(--accent); padding: 0.5rem; border-radius: 0.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: all 0.2s;">
                                <span style="font-size: 0.75rem; font-weight: 600;">Batang</span>
                                <span style="font-size: 0.875rem; font-weight: 700;">Rp {{ number_format($product->price_per_stick, 0, ',', '.') }}</span>
                            </button>
                        </div>

                        <div style="text-align: right;">
                            <span style="font-size: 0.7rem; color: {{ $product->stock <= 5 ? 'var(--danger)' : 'var(--success)' }}; font-weight: 600;">Stok: {{ $product->stock }} bks</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cart Area -->
        <div style="width: 350px; flex-shrink: 0; background: var(--bg-card); border-radius: 1.5rem; display: flex; flex-direction: column; border: 1px solid rgba(255,255,255,0.05);">
            <div style="padding: 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.05); display: flex; justify-content: space-between; align-items: center;">
                <h3 style="margin: 0; font-size: 1.125rem;">Keranjang</h3>
                <span id="TOTAL_ATAS" style="font-weight: 800; color: var(--primary); font-size: 1.125rem;">Rp 0</span>
            </div>

            <div id="cart-items-list" style="flex-grow: 1; overflow-y: auto; padding: 1.5rem; display: flex; flex-direction: column; gap: 1rem;">
                <div id="empty-cart-msg" style="text-align: center; color: var(--text-muted); margin-top: 2rem;">
                    Keranjang kosong.
                </div>
            </div>

            <div style="padding: 1.5rem; background: rgba(0,0,0,0.2); border-radius: 0 0 1.5rem 1.5rem;">
                <form action="{{ route('sales.store') }}" method="POST">
                    @csrf
                    <div id="hidden-inputs"></div>
                    
                    <div style="margin-bottom: 1rem;">
                        <label style="font-size: 0.8125rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Nama Pelanggan</label>
                        <input type="text" name="customer_name" placeholder="Nama pelanggan (Opsional)" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>

                    <div style="margin-bottom: 1.5rem;">
                        <label style="font-size: 0.8125rem; color: var(--text-muted); display: block; margin-bottom: 0.5rem;">Metode Pembayaran</label>
                        <select name="payment_method" style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                            <option value="cash">Tunai</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>

                    <div style="display: flex; justify-content: space-between; font-weight: 800; font-size: 1.5rem; margin-bottom: 1.5rem;">
                        <span>Total</span>
                        <span id="BELANJA_TOTAL_AKHIR" style="color: var(--primary);">Rp 0</span>
                    </div>

                    <button type="submit" id="btn-submit-sale" disabled class="btn-primary" style="width: 100%; padding: 1rem; opacity: 0.5; cursor: not-allowed;">
                        Simpan Transaksi
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        let cart = {};

        function formatRupiah(angka) {
            if (isNaN(angka)) return "0";
            return new Intl.NumberFormat('id-ID').format(angka);
        }

        function addToCart(el, mode) {
            try {
                const id = el.dataset.id;
                const name = el.dataset.name;
                const price = parseFloat(el.dataset.price) || 0;
                const pricePerStick = parseFloat(el.dataset.pricePerStick) || 0;
                const cartKey = id + '_' + mode;

                if (cart[cartKey]) {
                    cart[cartKey].qty = parseInt(cart[cartKey].qty) + 1;
                } else {
                    cart[cartKey] = { 
                        productId: id,
                        name: name, 
                        price: price, 
                        pricePerStick: pricePerStick,
                        qty: 1, 
                        mode: mode 
                    };
                }
                renderCart();
            } catch (e) { console.error(e); }
        }

        function updateQty(key, delta) {
            try {
                if (cart[key]) {
                    let currentQty = parseInt(cart[key].qty) || 0;
                    cart[key].qty = currentQty + delta;
                    if (cart[key].qty <= 0) delete cart[key];
                    renderCart();
                }
            } catch (e) { console.error(e); }
        }

        function renderCart() {
            try {
                const list = document.getElementById('cart-items-list');
                const hiddenInputs = document.getElementById('hidden-inputs');
                const emptyMsg = document.getElementById('empty-cart-msg');
                const submitBtn = document.getElementById('btn-submit-sale');
                const displayAtas = document.getElementById('TOTAL_ATAS');
                const displayBawah = document.getElementById('BELANJA_TOTAL_AKHIR');
                
                let htmlList = '';
                let htmlInputs = '';
                let grandTotal = 0;
                let count = 0;

                // SATU LOOP UNTUK SEMUA: Gambar & Hitung
                for (let k in cart) {
                    count++;
                    const item = cart[k];
                    const harga = (item.mode === 'stick') ? item.pricePerStick : item.price;
                    const q = parseInt(item.qty) || 0;
                    const sub = q * harga;
                    
                    // Tambahkan ke total keseluruhan
                    grandTotal += sub;
                    
                    const label = (item.mode === 'stick') ? 'Batang' : 'Bungkus';
                    
                    htmlList += `
                        <div style="background: rgba(255,255,255,0.02); padding: 1rem; border-radius: 1rem; border: 1px solid rgba(255,255,255,0.08); margin-bottom: 0.5rem;">
                            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 0.75rem;">
                                <div style="flex-grow: 1;">
                                    <span style="display: block; font-size: 0.9375rem; font-weight: 700; color: white;">${item.name}</span>
                                    <span style="font-size: 0.8125rem; color: var(--text-muted);">${q} ${label} x Rp ${formatRupiah(harga)}</span>
                                </div>
                                <span style="font-weight: 800; color: var(--primary); font-size: 1rem;">Rp ${formatRupiah(sub)}</span>
                            </div>
                            <div style="display: flex; align-items: center; justify-content: flex-end;">
                                <div style="display: flex; align-items: center; gap: 0.6rem; background: rgba(255,255,255,0.03); padding: 3px; border-radius: 0.6rem;">
                                    <button type="button" onclick="updateQty('${k}', -1)" style="background: rgba(255,255,255,0.05); color: white; border: none; width: 30px; height: 30px; border-radius: 0.5rem; cursor: pointer; font-size: 1.2rem; display: flex; align-items: center; justify-content: center;">-</button>
                                    <span style="font-weight: 700; min-width: 24px; text-align: center; color: white; font-size: 0.9rem;">${q}</span>
                                    <button type="button" onclick="updateQty('${k}', 1)" style="background: var(--primary); color: #000; border: none; width: 30px; height: 30px; border-radius: 0.5rem; cursor: pointer; font-size: 1.2rem; font-weight: 800; display: flex; align-items: center; justify-content: center;">+</button>
                                </div>
                            </div>
                        </div>
                    `;

                    htmlInputs += `
                        <input type="hidden" name="items[${item.productId}][qty]" value="${q}">
                        <input type="hidden" name="items[${item.productId}][mode]" value="${item.mode}">
                    `;
                }

                list.innerHTML = htmlList || '<div style="text-align: center; color: var(--text-muted); margin-top: 2rem;">Keranjang kosong.</div>';
                hiddenInputs.innerHTML = htmlInputs;

                if (count > 0) {
                    submitBtn.disabled = false;
                    submitBtn.style.opacity = '1';
                    submitBtn.style.cursor = 'pointer';
                } else {
                    submitBtn.disabled = true;
                    submitBtn.style.opacity = '0.5';
                    submitBtn.style.cursor = 'not-allowed';
                }

                const finalLabel = 'Rp ' + formatRupiah(grandTotal);
                displayAtas.innerText = finalLabel;
                displayBawah.innerText = finalLabel;

            } catch (e) { console.error(e); }
        }
    </script>
</x-smoke-layout>
