<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable=[
        'receiver_id',
        'sender_id'
    ];


    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getReceiver(){
        if ($this->sender_id === auth()->id()) {
            return User::firstWhere('id', $this->receiver_id);
            # code...
        }
        else{
            return User::firstWhere('id', $this->sender_id);
        }
    }
}
