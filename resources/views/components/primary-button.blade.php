<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#4a432e] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#373222] focus:bg-[#373222] active:bg-[#2c281d] focus:outline-none transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>