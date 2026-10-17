@props([
    'name',
    'label' => null,
    'value' => null,
    'required' => false,
    'accept' => 'image/png,image/jpeg,image/webp',
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

    <input
        type="file"
        name="{{ $name }}"
        id="{{ $name }}"
        accept="{{ $accept }}"
        @if ($required) required @endif
        {{ $attributes->merge([
            'class' => 'block w-full cursor-pointer rounded-lg border border-dashed border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-600 file:mr-3 file:rounded-md file:border-0 file:bg-slate-100 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-slate-700 hover:file:bg-slate-200'
                . ($errors->has($name) ? ' border-rose-400' : ''),
        ]) }}
    >

    @if ($hint)
        <p class="mt-1.5 text-xs text-slate-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
    @enderror
</div>
