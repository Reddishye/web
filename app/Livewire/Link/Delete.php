<?php

namespace App\Livewire\Link;

use App\Models\Link;
use Livewire\Component;

class Delete extends Component
{
    public $link;

    public $confirmingLinkDeletion = false;

    public function mount(Link $link)
    {
        $this->link = $link;
    }

    public function confirmLinkDeletion()
    {
        $this->confirmingLinkDeletion = true;
    }

    public function deleteLink()
    {
        $this->link->delete();
        $this->confirmingLinkDeletion = false;

        return redirect()->route('links.index');
    }

    public function render()
    {
        return view('livewire.link.delete');
    }
}
