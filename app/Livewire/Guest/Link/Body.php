<?php

namespace App\Livewire\Guest\Link;

use Livewire\Component;

class Body extends Component
{
    public $link;
    public $actionType = 'classic';

    public function mount($link)
    {
        $this->link = $link;

        // Check for special action types:
        /*
            copy:<text_to_copy> - Copies the specified text to clipboard
            newwindow:<url> - Opens the specified URL in a new window
            route:<route_name> - Redirects to the specified route
            onlyview - Disables the link (for display only)
        */
        if (strpos($link->url, 'copy:') === 0) {
            $this->actionType = 'copy';
        } elseif (strpos($link->url, 'newwindow:') === 0) {
            $this->actionType = 'newwindow';
        } elseif (strpos($link->url, 'route:') === 0) {
            $this->actionType = 'route';
        } elseif (strpos($link->url, 'onlyview') === 0) {
            $this->actionType = 'onlyview';
        }
    }


    public function render()
    {
        return view('livewire.guest.link.body');
    }
}
