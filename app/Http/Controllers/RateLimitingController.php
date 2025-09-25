<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class RateLimitingController extends Controller
{
    /**
     * Show.
     */
    public function show(Request $request)
    {
        $key = 'demo_limit:' . $request->ip();
        $maxAttempts = 5;
        $decayMinutes = 1;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'error' => 'Rate limit exceeded',
                'retry_after_seconds' => $seconds,
                'message' => 'Please retry after ' . $seconds . ' seconds'
            ], 429);
        }

        RateLimiter::increment($key);

        $remaining = RateLimiter::remaining($key, $maxAttempts);

        return response()->json([
            'message' => 'Rate limit demo endpoint',
            'rate_limit_info' => [
                'max_attempts' => $maxAttempts,
                'remaining' => $remaining,
                'period' => $decayMinutes . ' minute(s)',
                'reset_time' => now()->addSeconds(RateLimiter::availableIn($key))->toDateTimeString()
            ],
        ]);
    }
}
