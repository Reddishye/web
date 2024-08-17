<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Laracasts\Flash\Flash;

class Info extends Component
{
    public $event;
    public $title;
    public $description;
    public $start_time;
    public $end_time;
    public $status;
    public $type;
    public $isOpen = false;
    public $isEventOwner = false;
    public $hasAccess = false;

    protected $listeners = ['openEventModal' => 'loadEvent'];

    public function loadEvent($data)
    {
        $eventId = $data['eventId'];
        $event = Event::find($eventId);

        if (!$event) {
            session()->flash('error', 'Event not found.');
            return;
        }

        if (Auth::user()->id === $event->user_id || has_permission('admin')) {
            $this->isEventOwner = true;
        }

        if ($event->type === 'private' && !$this->isEventOwner) {
            $this->hasAccess = false;
        } else {
            $this->hasAccess = true;
        }

        $this->event = $event;
        if ($this->hasAccess) {
            $this->title = $event->title;
            $this->description = $event->description;
            $this->status = $event->status;
            $this->type = $event->type;
            $this->start_time = Carbon::parse($event->start_time)->format('Y-m-d\TH:i');
            $this->end_time = Carbon::parse($event->end_time)->format('Y-m-d\TH:i');
        } else {
            $this->title = 'Private Event';
            $this->description = 'You do not have permission to view this event.';
            $this->status = 'accepted';
            $this->type = 'private';
            $this->start_time = null;
            $this->end_time = null;
        }
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function save()
    {
        if ($this->isEventOwner || has_permission('admin')) {
            $this->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'start_time' => 'required|date',
                'end_time' => 'required|date|after_or_equal:start_time',
                'status' => 'required|string|in:pending,accepted,rejected',
                'type' => 'required|string|in:public,private',
            ]);

            $this->event->update([
                'title' => $this->title,
                'description' => $this->description,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'status' => $this->status,
                'type' => $this->type,
            ]);

            session()->flash('message', 'Event updated successfully.');
            $this->closeModal();
            $this->dispatch('eventUpdated');
            $this->dispatch('refreshCalendar');
        } else {
            session()->flash('error', 'You do not have permission to update this event.');
        }
    }

    public function delete()
    {
        if (Auth::user()->id === $this->event->user_id || has_permission('admin')) {
            $this->event->delete();
            $this->closeModal();
            $this->dispatch('eventDeleted');
            // reload the calendar component
            $this->dispatch('refreshCalendar');
        } else {
            session()->flash('error', 'You do not have permission to delete this event.');
        }
    }

    public function render()
    {
        if (!$this->isEventOwner === true) {
            $disabled = 'readonly';
        } else {
            $disabled = '';
        }
        return view('livewire.calendar.info', [
            'isEventOwner' => $this->isEventOwner,
            'hasAccess' => $this->hasAccess,
            'disabled' => $disabled
        ]);
    }
}
