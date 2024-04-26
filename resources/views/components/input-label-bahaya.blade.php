@props(['value'])

<label class="p-0 mt-2 label">
    <span {{ $attributes->merge(['class' => 'font-semibold label-text-alt']) }} class="font-semibold label-text-alt">
        {{ $value ?? $slot }} <small class="text-rose-500">*{{__('list')}}</small> </span>
</label>
