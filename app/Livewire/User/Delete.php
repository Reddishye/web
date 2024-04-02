<?php

namespace App\Livewire\User;

use Livewire\Component;
use App\Models\User;

class Delete extends Component
{
    public $user;
    public $confirmingUserDeletion = false;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function confirmUserDeletion()
    {
        $this->confirmingUserDeletion = true;
    }

    public function deleteUser()
    {
        $this->user->delete();
        $this->confirmingUserDeletion = false;
        return redirect()->route('user.index');
    }

    public function render()
    {
        return view('livewire.user.delete');
    }
}
