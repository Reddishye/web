<?php

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use function Livewire\Volt\{state, mount};

state('unreadMessagesCount', 0);

mount(function () {
    $this->unreadMessagesCount = Message::where('to', Auth::id())
        ->where('is_read', false)
        ->count();
});

?>
<div>
@if ($unreadMessagesCount > 0)
    <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-gray-600 rounded-md bg-gray-50 ring-1 ring-inset ring-gray-500/10">{{ $unreadMessagesCount }}</span>
@endif
</div>
