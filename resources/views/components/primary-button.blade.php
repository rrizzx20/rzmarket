<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-3 bg-orange-500 border border-transparent rounded-xl font-bold text-sm text-black uppercase tracking-widest hover:bg-orange-400 focus:bg-orange-400 active:bg-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition ease-in-out duration-150']) }} style="background: var(--primary); color: #000; box-shadow: 0 4px 15px var(--primary-glow);">
    {{ $slot }}
</button>
