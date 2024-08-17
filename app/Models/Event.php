<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\BroadcastsEvents;

class Event extends Model
{
    use HasFactory, BroadcastsEvents;

    protected $fillable = [
        'user_id', 'title', 'description', 'start_time', 'end_time', 'status', 'type'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function broadcastOn(string $event): array
    {
        return [$this, $this->user];
    }

    public function broadcastAs(string $event): ?string
    {
        return match ($event) {
            'created' => 'event.created',
            'updated' => 'event.updated',
            'deleted' => 'event.deleted',
            default => null,
        };
    }

    public function broadcastWith(string $event): array
    {
        return match ($event) {
            'created' => ['title' => $this->title, 'description' => $this->description],
            default => ['model' => $this],
        };
    }
}
