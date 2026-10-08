@props(['active' => false])

<a {{ $attributes }} 
    class="{{ $active ? 'bg-indigo-600/20 text-indigo-400 border border-indigo-500/30' : 'text-slate-300 hover:bg-slate-800 hover:text-white border border-transparent' }} px-3.5 py-1.5 rounded-lg text-sm font-medium transition duration-150 inline-flex items-center gap-2"
    aria-current="{{ $active ? 'page' : 'false' }}">
    
    @isset($icon)
        <span> {{ $icon }} </span>
    @endisset
    
    <span> {{ $slot }} </span>
</a>