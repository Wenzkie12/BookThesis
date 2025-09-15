<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-center inline-flex justify-center items-center px-4 py-2 bg-primary  rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-accent focus:bg-accent active:bg-primary focus:outline-none focus:ring-1 focus:ring-primary focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
