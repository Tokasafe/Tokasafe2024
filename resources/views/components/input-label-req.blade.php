@props(['value'])

<div class="indicator ">
    <span
        class="text-sm font-semibold bg-transparent border-0 indicator-item indicator-middle badge badge-xs text-rose-600">*</span>
    <label class="pb-0 label">
        <span {{ $attributes->merge(['class' => 'font-semibold label-text-alt']) }} class="font-semibold label-text-alt">
            {{ $value ?? $slot }}</span>
    </label>
</div>
