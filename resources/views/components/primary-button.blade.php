<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-xs btn-success text-white']) }}>
    {{ $slot }}
</button>
