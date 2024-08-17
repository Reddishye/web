<?php

namespace App\Livewire\Calendar;

use Livewire\Component;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class Create extends Component
{
    public $title;
    public $description;
    public $start_time;
    public $end_time;
    public $status = 'pending';
    public $type = 'public';
    public $isOpen = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after_or_equal:start_time',
        'status' => 'required|in:pending,accepted,rejected',
        'type' => 'required|in:public,private',
    ];

    public function render()
    {
        return view('livewire.calendar.create');
    }

    public function openModal()
    {
        $this->resetInputFields();
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->status = 'pending';
        $this->type = 'public';
    }

    public function save()
    {
        \Log::info('Starting save method');

        $this->validate();

        \Log::info('Validation passed');

        // Check for overlapping events
        $overlappingEvents = Event::where(function ($query) {
            $query->whereBetween('start_time', [$this->start_time, $this->end_time])
                  ->orWhereBetween('end_time', [$this->start_time, $this->end_time])
                  ->orWhere(function ($query) {
                      $query->where('start_time', '<=', $this->start_time)
                            ->where('end_time', '>=', $this->end_time);
                  });
        })
        ->whereNotIn('status', ['denied', 'pending'])
        ->exists();

        \Log::info('Overlapping events checked');

        if ($overlappingEvents) {
            session()->flash('error', 'The start time or end time overlaps with an existing event.');
            return;
        }

        // If the user does not have admin permission, set status and type to pending and private
        if (!has_permission('admin')) {
            $this->status = 'pending';
            $this->type = 'private';
        }

        $start_time = Carbon::parse($this->start_time);
        $end_time = Carbon::parse($this->end_time);

        \Log::info('Times parsed');

        Event::create([
            'user_id' => Auth::id(),
            'title' => $this->title,
            'description' => $this->description,
            'start_time' => $start_time,
            'end_time' => $end_time,
            'status' => $this->status,
            'type' => $this->type,
        ]);

        \Log::info('Event created');

        session()->flash('message', 'Event created successfully.');

        $this->closeModal();
        $this->dispatch('eventAdded');
        $this->dispatch('refreshCalendar');

        \Log::info('End of save method');
    }
}
