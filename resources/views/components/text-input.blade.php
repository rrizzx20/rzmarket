@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-black/20 border-white/10 focus:border-orange-500 focus:ring-orange-500 rounded-xl shadow-sm text-white placeholder-gray-500']) }} style="background: rgba(0,0,0,0.2); border: 1px solid rgba(255,255,255,0.1); padding: 0.75rem 1rem;">
