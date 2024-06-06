<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = [
        'license',
        'project',
        'user_id',
        'locked',
    ];

    protected $casts = [
        'locked' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function logEvent($event, $ip)
    {
        $this->logs()->create([
            'event' => $event,
            'ip_address' => $ip,
            'timestamp' => now(),
        ]);
    }

    public function isLocked() {
        return $this->locked;
    }

    public function logs()
    {
        return $this->hasMany(LicenseLog::class);
    }
}
