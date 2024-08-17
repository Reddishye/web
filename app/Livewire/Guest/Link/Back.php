<?php

namespace App\Livewire\Guest\Link;

use Livewire\Component;

class Back extends Component
{
    public $backLink;
    public $showButton = false;

    public function mount($backLink)
    {
        if ($backLink) {
            $this->showButton = true;
            if ($backLink == '/') {
                $this->backLink = null;
            } else return;

            $this->backLink = $backLink;
        }
    }

    public function render()
    {
        return view('livewire.guest.link.back');
    }
}
