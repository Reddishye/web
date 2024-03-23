<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Link;

class ViewLinkButton extends Component
{
    public $link;

    public function mount(Link $link)
    {
        $this->link = $link;
    }

    public function render()
    {
        return view('livewire.view-link-button');
    }
}
