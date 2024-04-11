<?php

namespace App\Livewire\Link;

use App\Models\Link;
use Livewire\Component;

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
