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
        <label for="{{ $name }}" class="mb-1.5 block text-sm font-medium text-slate-700">
            {{ $label }}
            @if ($required)
                <span class="text-rose-500" aria-hidden="true">*</span>
            @endif
        </label>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        rows="{{ $rows }}"
        @if ($required) required @endif
        {{ $attributes->merge([
            'class' => 'block w-full rounded-lg border border-slate-300 bg-white px-3 py-2 text-sm text-slate-900 shadow-sm transition placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 focus:outline-none'
                . ($errors->has($name) ? ' border-rose-400 focus:border-rose-500 focus:ring-rose-200' : ''),
        ]) }}
    >{{ old($name, $value) }}</textarea>

    @if ($hint)
        <p class="mt-1.5 text-xs text-slate-500">{{ $hint }}</p>
    @endif

    @error($name)
        <p class="mt-1.5 text-xs font-medium text-rose-600">{{ $message }}</p>
    @enderror
</div>
