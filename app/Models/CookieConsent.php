<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;

/**
 * @property int $id
 * @property int|null $user_id
 * @property string|null $visitor_key_hash
 * @property bool $analytics
 * @property bool $marketing
 * @property string $policy_version
 * @property \Illuminate\Support\Carbon $consented_at
 */
class CookieConsent extends Model
{
    public const POLICY_VERSION = '1';
    public const VISITOR_COOKIE = 'cookie_visitor_id';

    protected $fillable = [
        'user_id',
        'visitor_key_hash',
        'analytics',
        'marketing',
        'policy_version',
        'consented_at',
    ];

    protected $casts = [
        'analytics' => 'boolean',
        'marketing' => 'boolean',
        'consented_at' => 'datetime',
    ];

    public static function identityForRequest(Request $request, ?string $visitorId = null): ?array
    {
        $userId = $request->user()?->getAuthIdentifier();
        if ($userId !== null) {
            return ['user_id' => $userId];
        }

        $visitorId ??= $request->cookie(self::VISITOR_COOKIE);
        if (! \is_string($visitorId) || ! Str::isUuid($visitorId)) {
            return null;
        }

        return ['visitor_key_hash' => hash('sha256', $visitorId)];
    }

    public static function findForRequest(Request $request): ?self
    {
        try {
            $identity = self::identityForRequest($request);
            return $identity
                ? self::query()->where($identity)->first()
                : null;
        } catch (QueryException $exception) {
            report($exception);
            throw $exception;
        }
    }
}
