@props([
    'name',
    'label' => null,
    'options' => [],
    'value' => null,
    'required' => false,
    'placeholder' => '— Pilih salah satu —',
    'hint' => null,
])

<div>
    @if ($label)
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-slate-700">
            {{ $label }}
            @if ($required)
                <span class="text-rose-500" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        @if ($required) required @endif
        {{ $attributes->merge([
            'class' => 'block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm transition focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:outline-none'
                . ($errors->has($name) ? ' border-rose-400 focus:border-rose-500 focus:ring-rose-200' : ''),
        ]) }}
    >
        <option value="">{{ $placeholder }}</option>
        @foreach ($options as $optionValue => $optionLabel)
            @php($optionValue = is_int($optionValue) ? $optionLabel : $optionValue)
            <option value="{{ $optionValue }}" @selected(old($name, $value) == $optionValue)>{{ $optionLabel }}</option>
        @endforeach
    </select>

    @if ($hint)
        <p class="mt-1.5 text-xs text-slate-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
    @enderror
</div>
