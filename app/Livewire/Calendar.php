<?php

namespace App\Livewire;

use Omnia\LivewireCalendar\LivewireCalendar;
use App\Models\Event;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class Calendar extends LivewireCalendar
{
    public function events(): Collection
    {
        logger('Loading events...');
        return Event::query()
            ->whereDate('start_time', '>=', $this->gridStartsAt)
            ->whereDate('start_time', '<=', $this->gridEndsAt)
            ->get()
            ->filter(function (Event $event) {
                if ($event->status == 'rejected') {
                    // skip this event
                    return false;
                }

                if ($event->status == 'pending' && !has_permission('admin') || $event->status == 'pending' && Auth::user()->id != $event->user_id) {
                    // skip this event
                    return false;
                }

                // keep this event
                return true;
            })
            ->map(function (Event $event) {
                if ($event->type == 'private' && !has_permission('admin')) {
                    return [
                        'id' => $event->id,
                        'title' => 'Private Event',
                        'description' => 'Details are not available',
                        'date' => $event->start_time,
                    ];
                }

                if ($event->status == 'pending' && has_permission('admin') || $event->status == 'pending' && Auth::user()->id == $event->user_id) {
                    $event->title = '🟡 ' . $event->title;
                }

                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'description' => $event->description,
                    'date' => $event->start_time,
                ];
            });
    }

    public function render()
    {
        return parent::render();
    }

    public function onDayClick($year, $month, $day)
    {
        // Lógica cuando se hace clic en un día
    }

    public function onEventClick($eventId)
    {
        $this->dispatch('openEventModal', ['eventId' => $eventId]);
    }


    public function onEventDropped($eventId, $year, $month, $day)
    {
        // Lógica cuando se arrastra y suelta un evento
    }

    public function refreshCalendar()
    {
        $this->dispatch('refreshCalendar');
    }
}
