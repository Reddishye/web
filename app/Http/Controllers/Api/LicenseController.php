<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class LicenseController extends Controller
{
    public function checkLicense($licenseKey)
    {
        // Verificar el límite de solicitudes
        $key = 'check_license_' . $licenseKey;
        $maxAttempts = 1;
        $decaySeconds = 5;

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return response()->json(['error' => 'Too many requests'], 429);
        }

        RateLimiter::hit($key, $decaySeconds);

        // Buscar la licencia en la base de datos
        $license = License::where('license', $licenseKey)->first();

        if (!$license) {
            return response()->json(['error' => 'License not found'], 404);
        }

        // Verificar si la licencia está bloqueada
        if ($license->locked) {
            return response()->json(['error' => 'License is locked'], 403);
        }

        // Devolver la información de la licencia
        return response()->json([
            'license' => $license->license,
            'project' => $license->project,
            'user' => $license->user->name,
            'status' => 'active',
        ]);
    }
}
