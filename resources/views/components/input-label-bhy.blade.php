@props(['value'])

<label class="p-0 mt-2 label">
    <span {{ $attributes->merge(['class' => 'block relative font-semibold label-text-alt']) }}>
        {{ $value ?? $slot }}<sup class="font-features sups text-[7px] text-rose-500">*{{ __('list') }}</sup></span>
</label>
