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
}
