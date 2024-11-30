<button {{ $attributes->merge(['type' => 'submit', 'class' => 'btn btn-info mt-2 bu p-3 ps-5 pe-5']) }}>
    {{ $slot }}
</button>
