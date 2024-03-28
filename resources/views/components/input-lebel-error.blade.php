<label class="p-0 label">
    <span {{ $attributes->merge(['class' => 'font-semibold label-text-alt']) }} class="font-semibold label-text-alt">
        {{ $value ?? $slot }}</span>
</label>
