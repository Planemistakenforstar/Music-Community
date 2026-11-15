<?php

namespace App\Http\Controllers;

use App\Models\CookieConsent;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CookieConsentController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'analytics' => ['required', 'boolean'],
                'marketing' => ['required', 'boolean'],
            ]);

            $visitorId = null;
            $identity = CookieConsent::identityForRequest($request);

            if ($identity === null) {
                $visitorId = (string) Str::uuid();
                $identity = CookieConsent::identityForRequest($request, $visitorId);
            }

            CookieConsent::query()->updateOrCreate(
                $identity,
                [
                    'user_id' => $identity['user_id'] ?? null,
                    'visitor_key_hash' => $identity['visitor_key_hash'] ?? null,
                    'analytics' => $validated['analytics'],
                    'marketing' => $validated['marketing'],
                    'policy_version' => CookieConsent::POLICY_VERSION,
                    'consented_at' => now(),
                ]
            );

            $response = response()->json(['saved' => true]);
            if ($visitorId !== null) {
                $secure = config('session.secure') ?? app()->environment('production');
                $response->cookie(
                    CookieConsent::VISITOR_COOKIE,
                    $visitorId,
                    525600,
                    '/',
                    config('session.domain'),
                    $secure,
                    true,
                    false,
                    'lax'
                );
            }
        } catch (\Exception $e) {
            report($e);
            $response = response()->json(['saved' => false], 500);
        }
        return $response;
    }
}
