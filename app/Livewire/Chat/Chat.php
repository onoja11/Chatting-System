<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use Livewire\Component;

class Chat extends Component
{
    public $query;
    public $selectedConversation;

    public function mount($query)
    {
        $this->query = $query;

        // Ensure the conversation exists
        $this->selectedConversation = Conversation::findOrFail($this->query);

        if (auth()->check()) {
            Message::where('conversation_id', $this->selectedConversation->id)
                ->where('receiver_id', auth()->id())
                ->whereNull('read_at')
                ->update(['read_at' => now()]);
        }
    }

    public function render()
    {
        return view('livewire.chat.chat')->layout('layouts.app');
    }
}
