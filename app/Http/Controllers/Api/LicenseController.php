<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\SendServerCommand;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class LicenseController extends Controller
{
    private $onlineServers = [];

    public function checkLicense(Request $request, $licenseKey)
    {
        $ip = $request->ip();

        $license = $this->getLicense($licenseKey);

        if (!$license) {
            $this->logEvent($licenseKey, 'License not found', $ip);
            return response()->json(['status' => 'unknow'], 404);
        }

        if ($license->isLocked()) {
            $license->logEvent('License is locked', $ip);
            return response()->json(['status' => 'unknow'], 403);
        }

        if ($this->isRateLimited($licenseKey, $ip)) {
            return response()->json(['status' => 'unknow'], 429);
        }

        $this->registerServerStatus($license, $request);

        $license->logEvent('License accessed', $ip);

        return response()->json([
            'license' => $license->license,
            'project' => $license->project,
            'user' => $license->user->name,
            'status' => 'active',
        ]);
    }

    public function updateServerStatus(Request $request, $licenseKey)
    {
        $license = $this->getLicense($licenseKey);

        if (!$license) {
            return response()->json(['status' => 'unknow'], 404);
        }

        $serverData = $request->json()->all();
        $this->onlineServers[$license->id] = [
            'name' => $serverData['name'] ?? null,
            'ip' => $request->ip(),
            'last_seen' => now(),
        ];

        return response()->json(['message' => 'Server status updated']);
    }

    public function stopServer(Request $request, $licenseId)
    {
        if (!isset($this->onlineServers[$licenseId])) {
            return response()->json(['status' => 'unknow'], 404);
        }

        $server = $this->onlineServers[$licenseId];

        SendServerCommand::dispatch($server['ip'], 'stop');

        return response()->json(['message' => 'Server stop command queued']);
    }

    private function getLicense($licenseKey)
    {
        return License::where('license', $licenseKey)->first();
    }

    private function isRateLimited($licenseKey, $ip)
    {
        $key = 'check_license_' . $licenseKey;
        $maxAttempts = 5;
        $decaySeconds = 60;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            $license = $this->getLicense($licenseKey);
            if ($license) {
                $license->logEvent('Rate limit exceeded', $ip);
            }
            RateLimiter::hit($key, $decaySeconds);
            return true;
        }

        RateLimiter::hit($key, $decaySeconds);
        return false;
    }

    private function registerServerStatus(License $license, Request $request)
    {
        $serverData = $request->json()->all();
        $this->onlineServers[$license->id] = [
            'name' => $serverData['name'] ?? null,
            'ip' => $request->ip(),
            'last_seen' => now(),
        ];
    }

    private function logEvent($licenseKey, $event, $ip)
    {
        $license = new License();
        $license->license = $licenseKey;
        $license->logEvent($event, $ip);
    }
}
