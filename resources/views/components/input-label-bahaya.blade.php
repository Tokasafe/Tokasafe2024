@props(['value'])

<label class="p-0 mt-2 label">
    <span {{ $attributes->merge(['class' => 'font-semibold label-text-alt']) }} class="font-semibold label-text-alt">
        {{ $value ?? $slot }} <small class="text-rose-500">* (Kapan dan Dimana?, Siapa yang terlibat?, Apa yang mereka lakukan?, Apa yang terjadi?, Bagaimana terjadi?, Apa yang salah?)</small> </span>
</label>
