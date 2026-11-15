<style>
    [x-cloak] {
        display: none !important;
    }
</style>

<div
    x-data="{
        savedConsent: @js($savedConsent),
        visible: false,
        preferencesOpen: false,
        analytics: false,
        marketing: false,
        saving: false,
        errorMessage: '',
        init() {
            if (this.savedConsent) {
                this.analytics = this.savedConsent.analytics;
                this.marketing = this.savedConsent.marketing;
            } else {
                this.visible = true;
            }
        },
        async saveConsent(analytics, marketing) {
            if (this.saving) {
                return;
            }

            this.saving = true;
            this.errorMessage = '';

            try {
                const response = await fetch(@js(route('cookie-consent.store')), {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                    },
                    body: JSON.stringify({ analytics, marketing })
                });

                if (!response.ok) {
                    throw new Error('The server could not save your cookie choices.');
                }

                document.cookie = 'cookie_consent=; Max-Age=0; Path=/; SameSite=Lax';
                this.analytics = analytics;
                this.marketing = marketing;
                this.savedConsent = { analytics, marketing };
                this.visible = false;
                this.preferencesOpen = false;
            } catch {
                this.errorMessage = 'We could not save your choices. Please try again.';
            } finally {
                this.saving = false;
            }
        }
    }"
    x-cloak
>
    <button
        type="button"
        x-show="!visible"
        @click="visible = true; preferencesOpen = true"
        class="fixed bottom-4 right-4 z-40 rounded-md bg-[#f1ecdf] px-4 py-2 text-sm font-semibold text-[#182723] shadow-lg ring-1 ring-[#182723]/20 transition hover:bg-community-ochre focus:outline-none focus:ring-2 focus:ring-community-ochre"
    >
        Cookie settings
    </button>

    <section
        x-show="visible"
        x-transition
        role="region"
        aria-labelledby="cookie-consent-title"
        class="fixed inset-x-0 bottom-0 z-50 p-4 sm:p-6"
    >
        <div class="mx-auto max-w-4xl rounded-xl bg-[#f1ecdf] p-5 text-[#182723] shadow-2xl ring-1 ring-[#182723]/20 sm:p-6">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div class="max-w-2xl">
                    <h2 id="cookie-consent-title" class="text-lg font-semibold text-[#182723]">
                        Your cookie choices
                    </h2>
                    <p class="mt-2 text-sm leading-6 text-[#46534b]">
                        Essential cookies keep the site working. With your permission, we may also use optional
                        analytics and marketing cookies. You can change your choice at any time in Cookie settings.
                    </p>
                </div>

                <div class="flex shrink-0 flex-wrap gap-2">
                    <button
                        type="button"
                        @click="saveConsent(false, false)"
                        :disabled="saving"
                        class="rounded-md border border-[#182723]/30 px-3 py-2 text-sm font-semibold text-[#182723] transition hover:bg-community-ochre/30 focus:outline-none focus:ring-2 focus:ring-community-ochre"
                    >
                        Reject optional
                    </button>
                    <button
                        type="button"
                        @click="saveConsent(true, true)"
                        :disabled="saving"
                        class="rounded-md bg-community-ochre px-3 py-2 text-sm font-semibold text-community-ink transition hover:bg-community-ochre-hover focus:outline-none focus:ring-2 focus:ring-community-ochre focus:ring-offset-2 focus:ring-offset-[#f1ecdf]"
                    >
                        Accept optional
                    </button>
                </div>
            </div>

            <div class="mt-4">
                <button
                    type="button"
                    @click="preferencesOpen = !preferencesOpen"
                    :aria-expanded="preferencesOpen.toString()"
                    class="text-sm font-semibold text-community-ochre-dark underline underline-offset-2 hover:text-community-ink"
                >
                    Manage preferences
                </button>

                <div x-show="preferencesOpen" x-transition class="mt-4 border-t border-gray-200 pt-4">
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <p class="text-sm font-semibold text-[#182723]">Essential</p>
                            <p class="mt-1 text-sm text-[#46534b]">Always active; required for core site features.</p>
                        </div>

                        <label class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                x-model="analytics"
                                class="mt-1 rounded border-[#182723]/30 text-community-ochre-dark focus:ring-community-ochre"
                            >
                            <span>
                                <span class="block text-sm font-semibold text-[#182723]">Analytics</span>
                                <span class="mt-1 block text-sm text-[#46534b]">Helps us understand how the site is used.</span>
                            </span>
                        </label>

                        <label class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                x-model="marketing"
                                class="mt-1 rounded border-[#182723]/30 text-community-ochre-dark focus:ring-community-ochre"
                            >
                            <span>
                                <span class="block text-sm font-semibold text-[#182723]">Marketing</span>
                                <span class="mt-1 block text-sm text-[#46534b]">Allows relevant marketing features.</span>
                            </span>
                        </label>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <button
                            type="button"
                            @click="analytics = savedConsent?.analytics ?? false; marketing = savedConsent?.marketing ?? false; preferencesOpen = false"
                            class="rounded-md border border-[#182723]/30 px-3 py-2 text-sm font-semibold text-[#182723] transition hover:bg-community-ochre/30 focus:outline-none focus:ring-2 focus:ring-community-ochre"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            @click="saveConsent(analytics, marketing)"
                            :disabled="saving"
                            class="rounded-md bg-community-ochre px-3 py-2 text-sm font-semibold text-community-ink transition hover:bg-community-ochre-hover focus:outline-none focus:ring-2 focus:ring-community-ochre focus:ring-offset-2 focus:ring-offset-[#f1ecdf]"
                        >
                            Save choices
                        </button>
                    </div>
                </div>
            </div>

            <p x-show="errorMessage" x-text="errorMessage" role="alert" class="mt-4 text-sm font-medium text-community-ochre-dark"></p>
        </div>
    </section>
</div>
