<?php

use App\Events\MessageSent;
use Livewire\Volt\Component;

new class extends Component
{
    public array $messages = [];
    public string $message = '';

    protected $listeners = ['echo:messages,MessageSent' => 'onMessageSent'];

    public function addMessage()
    {
        MessageSent::dispatch(auth()->user()->name, $this->message);
        $this->reset('message');
    }

    #[On('echo:messages,MessageSent')]
    public function onMessageSent($event)
    {
        $this->messages[] = $event;
    }
}
