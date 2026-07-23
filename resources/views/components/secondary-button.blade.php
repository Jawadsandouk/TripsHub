<button {{ $attributes->merge(['type' => 'button', 'class' => 'btn-secondary text-sm px-4 py-2']) }}>
    {{ $slot }}
</button>
