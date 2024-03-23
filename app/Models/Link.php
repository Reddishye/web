<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'link',
        'fa_icon',
        'enabled',
        'color',
    ];

    protected $casts = [
        'enabled' => 'boolean',
    ];
}
