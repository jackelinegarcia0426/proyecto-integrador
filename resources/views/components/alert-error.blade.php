@props(['message' => ''])

@if($message || $slot->isNotEmpty())
    <div class="mb-6 p-4 rounded-lg bg-red-50 border border-red-200 flex items-start gap-3">
        <i class="bi bi-exclamation-circle-fill text-red-600 text-xl mt-0.5 flex-shrink-0"></i>
        <div class="text-red-800">
            @if($message)
                <p class="font-semibold">{{ $message }}</p>
            @else
                {{ $slot }}
            @endif
        </div>
    </div>
@endif
