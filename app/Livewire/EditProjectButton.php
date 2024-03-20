<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Projects;

class EditProjectButton extends Component
{
    public $project;

    public function mount(Projects $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.edit-project-button');
    }
}
