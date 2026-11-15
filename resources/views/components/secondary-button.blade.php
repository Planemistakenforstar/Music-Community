<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-[#f1ecdf] border border-community-ink/25 rounded-md font-semibold text-xs text-community-ink uppercase tracking-widest shadow-sm hover:bg-community-ochre/30 focus:outline-none focus:ring-2 focus:ring-community-ochre focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
