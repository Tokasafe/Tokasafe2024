@props(['value'])

{{-- <div class="indicator ">
    <span
        class="text-sm font-semibold bg-transparent border-0 indicator-item indicator-middle badge badge-xs text-rose-600">*</span>
    <label class="pb-0 label">
        <span {{ $attributes->merge(['class' => 'font-semibold label-text-alt']) }} class="font-semibold label-text-alt">
            {{ $value ?? $slot }}</span>
    </label>
</div> --}}

<label class="p-0 mt-2 label">
    <span {{ $attributes->merge(['class' => 'block relative font-semibold label-text-alt']) }}>
        {{ $value ?? $slot }}<sup class="font-features font-bold sups text-[10px] text-rose-500">*</sup></span>
</label>
