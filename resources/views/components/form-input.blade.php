@props(['name', 'label', 'type' => 'text', 'placeholder' => '', 'value' => '', 'required' => false])

<div class="mb-6">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        placeholder="{{ $placeholder }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 text-gray-700 placeholder-gray-400']) }}
    />
    
    @error($name)
        <div class="mt-2 text-sm text-red-600 flex items-center gap-1">
            <i class="bi bi-exclamation-circle"></i>
            {{ $message }}
        </div>
    @enderror
</div>
