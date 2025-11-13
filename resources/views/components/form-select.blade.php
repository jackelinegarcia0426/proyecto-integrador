@props(['name', 'label', 'options' => [], 'value' => '', 'required' => false, 'placeholder' => '-- Seleccionar --'])

<div class="mb-6">
    @if($label)
        <label for="{{ $name }}" class="block text-sm font-semibold text-gray-700 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'w-full px-4 py-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition duration-200 text-gray-700 bg-white cursor-pointer']) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach($options as $optionValue => $optionLabel)
            <option value="{{ $optionValue }}" {{ old($name, $value) == $optionValue ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>
    
    @error($name)
        <div class="mt-2 text-sm text-red-600 flex items-center gap-1">
            <i class="bi bi-exclamation-circle"></i>
            {{ $message }}
        </div>
    @enderror
</div>
