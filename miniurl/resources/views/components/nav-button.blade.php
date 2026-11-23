@props(['href' => false])

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md shadow-indigo-500/20 transition']) }}>
        {{ $slot }}
    </a>
@else
    <button type="submit" {{ $attributes->merge(['class' => 'bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md shadow-indigo-500/20 transition cursor-pointer']) }}>
        {{ $slot }}
    </button>
@endif
