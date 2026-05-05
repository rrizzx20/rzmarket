<x-smoke-layout>
    <x-slot name="title">Edit Produk - SmokePOS</x-slot>

    <div class="flex-stack" style="margin-bottom: 2rem;">
        <div>
            <h2 style="font-size: 1.5rem; margin: 0; font-weight: 700;">Edit Produk</h2>
            <p style="color: var(--text-muted); margin-top: 4px; font-size: 0.8125rem;">Ubah detail produk: {{ $product->name }}</p>
        </div>
    </div>

    <div style="max-width: 700px;">
        <div class="smoke-card">
            <form action="{{ route('products.update', $product) }}" method="POST">
                @csrf
                @method('PATCH')
                
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Nama Produk</label>
                        <input type="text" name="name" value="{{ $product->name }}" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Kategori</label>
                        <select name="category_id" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 1.5rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Harga Beli</label>
                        <input type="number" name="buy_price" value="{{ $product->buy_price }}" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Harga Jual</label>
                        <input type="number" name="sell_price" value="{{ $product->sell_price }}" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Komisi per Item</label>
                        <input type="number" name="commission" value="{{ $product->commission }}" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>
                    <div>
                        <label style="display: block; margin-bottom: 0.5rem; font-size: 0.875rem;">Stok Saat Ini</label>
                        <input type="number" name="stock" value="{{ $product->stock }}" required style="width: 100%; background: var(--bg-dark); color: white; border: 1px solid rgba(255,255,255,0.1); border-radius: 0.75rem; padding: 0.75rem;">
                    </div>
                </div>

                <div style="display: flex; gap: 1rem;">
                    <a href="{{ route('products.index') }}" class="btn-primary" style="background: rgba(255,255,255,0.05); color: white; box-shadow: none; flex: 1;">Batal</a>
                    <button type="submit" class="btn-primary" style="flex: 2;">Perbarui Produk</button>
                </div>
            </form>
        </div>
    </div>
</x-smoke-layout>
