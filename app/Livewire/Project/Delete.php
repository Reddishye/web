<?php

namespace App\Livewire\Project;

use Livewire\Component;
use App\Models\Projects;

class Delete extends Component
{
    public $project;
    public $confirmingProjectDeletion = false;

    public function mount(Projects $project)
    {
        $this->project = $project;
    }

    public function confirmProjectDeletion()
    {
        $this->confirmingProjectDeletion = true;
    }

    public function deleteProject()
    {
        $this->project->delete();
        $this->confirmingProjectDeletion = false;
        return redirect()->route('projects.index');
    }

    public function render()
    {
        return view('livewire.project.delete');
    }
}
