<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-primary-sm']) }}>
    {{ $slot }}
</button>
