@props(['value'])
    <span {{ $attributes->merge(['class' => 'block font-medium text-slate-700 relative text']) }} >
        {{ $value ?? $slot }}<sup class="font-features sups text-[10px] text-rose-500">*</sup></span>
