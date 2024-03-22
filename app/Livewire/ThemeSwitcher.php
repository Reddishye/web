<?php

namespace App\Livewire;

use Livewire\Component;

class ThemeSwitcher extends Component
{
    public $darkMode = false;

    public function mount()
    {
        $this->darkMode = session('darkMode', false);
    }

    public function toggleTheme()
    {
        $this->darkMode = !$this->darkMode;
        session(['darkMode' => $this->darkMode]);
        $this->emit('themeChanged', $this->darkMode);
    }

    public function render()
    {
        return view('livewire.theme-switcher');
    }
}
