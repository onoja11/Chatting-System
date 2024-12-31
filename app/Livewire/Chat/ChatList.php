<?php

namespace App\Livewire\Chat;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatList extends Component
{

    public $selectedConversation;
    public $query;

    // protected $listeners = ['refresh' => '$refresh'];
    public function render()
    {
     
        $user=auth()->user();

        // dd($user);
        $conversations = $user->conversations()->where('receiver_id',  auth()->id())->latest('updated_at')->get();
        $messages= Message::where('receiver_id', auth()->id())->latest('updated_at')->get();
        return view('livewire.chat.chat-list', compact('conversations', 'messages'));
        
        
    }
}
