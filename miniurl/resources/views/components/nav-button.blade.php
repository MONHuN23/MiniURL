@props(['href' => false])
@if ($href)

    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition']) }}>
        {{ $slot }}
    </a>
    
@else
    <a type="submit" {{ $attributes->merge(['class' => 'bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-md text-sm font-medium transition']) }}>
        {{ $slot }}
    </a>
@endif
