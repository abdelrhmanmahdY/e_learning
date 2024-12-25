<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'btn  mt-2 bu p-3 ps-5 pe-5', 'style' => 'background-color:#1a99aa;color:white']) }}>
    {{ $slot }}
</button>
