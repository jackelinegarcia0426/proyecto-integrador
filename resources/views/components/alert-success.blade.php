@props(['message' => ''])

@if($message || $slot->isNotEmpty())
    <div class="mb-6 p-4 rounded-lg bg-green-50 border border-green-200 flex items-start gap-3">
        <i class="bi bi-check-circle-fill text-green-600 text-xl mt-0.5 flex-shrink-0"></i>
        <div class="text-green-800">
            @if($message)
                <p class="font-semibold">{{ $message }}</p>
            @else
                {{ $slot }}
            @endif
        </div>
    </div>
@endif
