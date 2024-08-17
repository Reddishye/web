<x-guest-layout>

@php
    // Get the first link from the database
    $link = App\Models\Link::first();
@endphp

<!-- Summon Livewire Link Body component (guest.link.body) -->
<livewire:guest.link.body :link="$link" />
</x-guest-layout>
