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
        class="fixed bottom-4 right-4 z-40 rounded-md bg-white px-4 py-2 text-sm font-semibold text-gray-700 shadow-lg ring-1 ring-gray-300 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500"
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
        <div class="mx-auto max-w-4xl rounded-xl bg-white p-5 shadow-2xl ring-1 ring-gray-200 sm:p-6">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                <div class="max-w-2xl">
                    <h2 id="cookie-consent-title" class="text-lg font-semibold text-gray-900">
                        Your cookie choices
                    </h2>
                    <p class="mt-2 text-sm leading-6 text-gray-600">
                        Essential cookies keep the site working. With your permission, we may also use optional
                        analytics and marketing cookies. You can change your choice at any time in Cookie settings.
                    </p>
                </div>

                <div class="flex shrink-0 flex-wrap gap-2">
                    <button
                        type="button"
                        @click="saveConsent(false, false)"
                        :disabled="saving"
                        class="rounded-md border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500"
                    >
                        Reject optional
                    </button>
                    <button
                        type="button"
                        @click="saveConsent(true, true)"
                        :disabled="saving"
                        class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
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
                    class="text-sm font-semibold text-red-700 underline underline-offset-2 hover:text-red-800"
                >
                    Manage preferences
                </button>

                <div x-show="preferencesOpen" x-transition class="mt-4 border-t border-gray-200 pt-4">
                    <div class="grid gap-4 sm:grid-cols-3">
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Essential</p>
                            <p class="mt-1 text-sm text-gray-600">Always active; required for core site features.</p>
                        </div>

                        <label class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                x-model="analytics"
                                class="mt-1 rounded border-gray-300 text-red-600 focus:ring-red-500"
                            >
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">Analytics</span>
                                <span class="mt-1 block text-sm text-gray-600">Helps us understand how the site is used.</span>
                            </span>
                        </label>

                        <label class="flex items-start gap-3">
                            <input
                                type="checkbox"
                                x-model="marketing"
                                class="mt-1 rounded border-gray-300 text-red-600 focus:ring-red-500"
                            >
                            <span>
                                <span class="block text-sm font-semibold text-gray-900">Marketing</span>
                                <span class="mt-1 block text-sm text-gray-600">Allows relevant marketing features.</span>
                            </span>
                        </label>
                    </div>

                    <div class="mt-4 flex justify-end gap-2">
                        <button
                            type="button"
                            @click="analytics = savedConsent?.analytics ?? false; marketing = savedConsent?.marketing ?? false; preferencesOpen = false"
                            class="rounded-md border border-gray-300 px-3 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-red-500"
                        >
                            Cancel
                        </button>
                        <button
                            type="button"
                            @click="saveConsent(analytics, marketing)"
                            :disabled="saving"
                            class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2"
                        >
                            Save choices
                        </button>
                    </div>
                </div>
            </div>

            <p x-show="errorMessage" x-text="errorMessage" role="alert" class="mt-4 text-sm font-medium text-red-700"></p>
        </div>
    </section>
</div>
