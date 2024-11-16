<?php

namespace App\Livewire\Chat;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Livewire\Component;

class ChatBox extends Component
{
    public $user;
    public $selectedConversation;
    public $name;
    public $body;
    public $loadedMessages;

    public function mount()
    {
        $conversationId = request()->route('query');

        $this->selectedConversation = Conversation::find($conversationId);

        if ($this->selectedConversation) {
            $this->user = User::find($this->selectedConversation->receiver_id);
        }
        $this->loadedMessages();
        // $this->name = Conversation::all();
    }

    public function loadedMessages(){
        $this->loadedMessages=Message::where('conversation_id',$this->selectedConversation->id)->get();
    }
    public function sendMessage(){
        $this->validate(['body'=>'required|string']);
        $createMessage = Message::create([
            'conversation_id'=>$this->selectedConversation->id,
            'sender_id'=>auth()->id(),
            'receiver_id'=>$this->selectedConversation->getReceiver()->id,
            'body'=> $this->body
        ]);
        $this->body = ' ';
        $this->loadedMessages->push($createMessage);
    }

    public function render()
    {
        return view('livewire.chat.chat-box', [
            'selectedConversation' => $this->selectedConversation,
            // 'data' => $this->name,
            // 'user' => $this->user,
        ]);
    }
}
