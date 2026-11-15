<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-community-ochre border border-transparent rounded-md font-semibold text-xs text-community-ink uppercase tracking-widest hover:bg-community-ochre-hover focus:bg-community-ochre-hover active:bg-community-ochre-hover focus:outline-none focus:ring-2 focus:ring-community-ochre focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
