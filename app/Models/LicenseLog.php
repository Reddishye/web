<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LicenseLog extends Model
{
    protected $fillable = [
        'license_id',
        'event',
        'ip_address',
        'timestamp',
    ];

    public function license()
    {
        return $this->belongsTo(License::class);
    }
}
