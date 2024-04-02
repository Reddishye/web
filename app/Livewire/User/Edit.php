<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;

class Edit extends Component
{
    public $user;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
