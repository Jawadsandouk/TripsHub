<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn-danger text-sm px-4 py-2']) }}>
    {{ $slot }}
</button>
