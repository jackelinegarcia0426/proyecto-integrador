@props(['type' => 'button', 'href' => null])

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-6 py-3 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700 transition duration-200 transform hover:scale-105 shadow-md hover:shadow-lg']) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => 'inline-flex items-center justify-center px-6 py-3 rounded-lg bg-green-600 text-white font-semibold hover:bg-green-700 transition duration-200 transform hover:scale-105 shadow-md hover:shadow-lg']) }}>
        {{ $slot }}
    </button>
@endif
