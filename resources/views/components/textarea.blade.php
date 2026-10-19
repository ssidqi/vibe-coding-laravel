@props([
    'name',
    'label' => null,
    'value' => null,
    'required' => false,
    'rows' => 5,
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

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if ($required) required @endif
        @if ($errors->has($name)) aria-invalid="true" @endif
        {{ $attributes->merge([
            'class' => 'block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-brand-dark shadow-sm transition placeholder:text-slate-400 focus:border-brand-rust focus:ring-2 focus:ring-brand-rust/20 focus:outline-none disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-500'
                . ($errors->has($name) ? ' border-brand-rust bg-brand-rust/5 focus:border-brand-rust focus:ring-brand-rust/30' : ''),
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @if ($hint)
        <p class="mt-1.5 text-xs text-brand-dark/60">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1.5 text-xs font-medium text-brand-rust">{{ $message }}</p>
    @enderror
</div>
