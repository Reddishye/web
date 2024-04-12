<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class LicenseController extends Controller
{
    public function checkLicense(Request $request, $licenseKey)
    {
        $ip = $request->header('CF_CONNECTING_IP', $request->ip());

        $key = 'check_license_' . $licenseKey;
        $maxAttempts = 1;
        $decaySeconds = 5;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $license = License::where('license', $licenseKey)->first();
            if ($license) {
                $license->logEvent('Rate limit exceeded', $ip);
            }
            return response()->json(['error' => 'Too many requests'], 429);
        }

        RateLimiter::hit($key, $decaySeconds);

        $license = License::where('license', $licenseKey)->first();

        if (!$license) {
            $this->logEvent($licenseKey, 'License not found', $ip);
            return response()->json(['error' => 'License not found'], 404);
        }

        if ($license->locked) {
            $license->logEvent('License is locked', $ip);
            return response()->json(['error' => 'License is locked'], 403);
        }

        $license->logEvent('License accessed', $ip);

        return response()->json([
            'license' => $license->license,
            'project' => $license->project,
            'user' => $license->user->name,
            'status' => 'active',
        ]);
    }

    private function logEvent($licenseKey, $event, $ip)
    {
        $license = new License();
        $license->license = $licenseKey;
        $license->logEvent($event, $ip);
    }
}

