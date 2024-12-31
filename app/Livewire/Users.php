<?php
namespace App\Livewire;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Users extends Component
{
    public function message($userId)
    {
        $authenticatedUserId = Auth::user()->id;

        // Check if a conversation already exists between the authenticated user and the selected user
        $existingConversation = Conversation::where(function ($query) use ($authenticatedUserId, $userId) {
            $query->where('sender_id', $authenticatedUserId)
                  ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($authenticatedUserId, $userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', $authenticatedUserId);
        })->first();

        if ($existingConversation) {
            // If a conversation already exists, redirect to the chat route with the conversation ID
            return redirect()->route('chat', ['query' => $existingConversation->id]);
        }

        // If no conversation exists, create a new one
        $createConversation = Conversation::create([
            'sender_id' => $authenticatedUserId,
            'receiver_id' => $userId,
        ]);

        return redirect()->route('chat', ['query' => $createConversation->id]);
    }

    public function render()
    {
        $users = User::where('id', '!=', auth()->id())->where('level',Auth::user()->level)->where('department',Auth::user()->department)->get();
        return view('livewire.users', compact('users'))->layout('layouts.app');
    }
}

