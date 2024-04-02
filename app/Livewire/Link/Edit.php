<?php

namespace App\Livewire\Link;

use Livewire\Component;
use App\Models\Link;

class Edit extends Component
{
    public $link;

    public function mount(Link $link)
    {
        $this->link = $link;
    }

    public function render()
    {
        return view('livewire.link.edit');
    }
}
