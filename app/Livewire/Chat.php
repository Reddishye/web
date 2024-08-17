<?php

namespace App\Livewire;

use App\Events\MessageSent;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Chat extends Component
{
    public $user;
    public $messages = []; // Initialize messages as an empty array
    public $message;
    public $page = 1;
    public $perPage = 30;
    public $initialLoad = true;

    protected $rules = [
        'message' => 'required|string|max:1000',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->loadMessages();
    }

    public function loadMessages()
    {
        $this->messages = Message::where(function($query) {
            $query->where('from', Auth::id())->where('to', $this->user->id);
        })->orWhere(function($query) {
            $query->where('from', $this->user->id)->where('to', Auth::id());
        })->orderBy('created_at', 'desc')
          ->take($this->page * $this->perPage)
          ->get()
          ->reverse()
          ->toArray();

        if ($this->initialLoad) {
            $this->dispatch('scrollToBottom');
            $this->initialLoad = false;
        }

        // Mark messages as read
        $this->markMessagesAsRead();
    }

    public function loadMoreMessages($previousHeight)
    {
        $this->page++;
        $this->loadMessages();
        $this->dispatch('maintainScrollPosition', ['previousHeight' => $previousHeight]);
    }

    public function sendMessage($messageContent = null, $tempMessageId = null)
    {
        $this->message = $messageContent ?? $this->message;

        $this->validate();

        $message = Message::create([
            'from' => Auth::id(),
            'to' => $this->user->id,
            'message' => $this->message,
        ]);

        broadcast(new MessageSent($message))->toOthers();

        $this->messages[] = $message->toArray();
        //$this->message = '';

        // Log to verify the event emission
        logger()->info('Message sent and event emitted', ['message' => $message]);

        // Update the temporary message bubble to the final one
        $this->dispatch('updateMessageBubble', ['tempMessageId' => $tempMessageId, 'messageContent' => $message->message]);

        // Scroll to the bottom after sending a message
        $this->dispatch('scrollToBottom');
    }

    public function addMessage($payload)
    {
        $this->messages[] = $payload['message'];

        // Log to verify the event reception
        logger()->info('Message received', ['message' => $payload['message']]);
    }

    public function markMessagesAsRead()
    {
        Message::where('to', Auth::id())
            ->where('from', $this->user->id)
            ->where('is_read', false)
            ->update(['is_read' => true, 'read_at' => now()]);
    }

    public function render()
    {
        return view('livewire.chat', ['messages' => $this->messages, 'user' => $this->user]);
    }
}
