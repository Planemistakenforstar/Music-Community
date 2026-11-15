<?php

namespace App\View\Components;

use App\Models\CookieConsent as Consent;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CookieConsent extends Component
{
    public function render(): View
    {
        try {
            $consent = Consent::findForRequest(request());
            $savedConsent = $consent !== null && $consent->policy_version === Consent::POLICY_VERSION
                ? [
                    'analytics' => $consent->analytics,
                    'marketing' => $consent->marketing,
                ]
                : null;
        } catch (\Throwable $exception) {
            report($exception);
            $savedConsent = null;
        }

        return view('components.cookie-consent', compact('savedConsent'));
    }
}
