@props(['active' => false])

<a {{ $attributes }}
    class="{{ $active ? 'bg-indigo-500/15 text-indigo-300 border border-indigo-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-800/70 border border-transparent' }} rounded-lg px-3.5 py-2 text-sm font-medium transition"
    aria-current="{{ $active ? 'page' : 'false' }}">
    @isset($icon)
        <span>{{ $icon }}</span>
    @endisset
    <span>{{ $slot }}</span>
</a>
