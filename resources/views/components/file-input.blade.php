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
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-brand-dark">
            {{ $label }}
            @if ($required)
                <span class="text-brand-rust" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <input
        type="file"
        name="{{ $name }}"
        id="{{ $name }}"
        accept="{{ $accept }}"
        @if ($required) required @endif
        @if ($errors->has($name)) aria-invalid="true" @endif
        {{ $attributes->merge([
            'class' => 'block w-full cursor-pointer rounded-lg border border-dashed border-brand-dark/25 bg-white px-3 py-2.5 text-sm text-brand-dark/70 transition file:mr-3 file:rounded-md file:border-0 file:bg-brand-dark/10 file:px-3 file:py-1.5 file:text-sm file:font-semibold file:text-brand-dark hover:file:bg-brand-dark/15 focus:border-brand-rust focus:ring-2 focus:ring-brand-rust/20 focus:outline-none disabled:cursor-not-allowed disabled:opacity-60'
                . ($errors->has($name) ? ' border-brand-rust' : ''),
        ]) }}
    >

    @if ($hint)
        <p class="mt-1.5 text-xs text-brand-dark/60">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1.5 text-xs font-medium text-brand-rust">{{ $message }}</p>
    @enderror
</div>
