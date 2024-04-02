<?php

namespace App\Livewire\Project;

use Livewire\Component;
use App\Models\Projects;

class View extends Component
{
    public $project;

    public function mount(Projects $project)
    {
        $this->project = $project;
    }

    public function render()
    {
        return view('livewire.project.view');
    }
}
