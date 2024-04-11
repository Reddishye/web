<?php

namespace App\Livewire\Project;

use App\Models\Projects;
use Livewire\Component;

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
