<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{

    protected $fillable = [
        'course_title',
        'course_code',
        'lecturer_id',
        'level',
        'department',
        'lecturer_name'
    ];
    public function getReceiver(){
        if ($this->sender_id === auth()->id()) {
            return User::firstWhere('id', $this->receiver_id);
            # code...
        }
        else{
            return ClassRoom::firstWhere('department', $this->sender_id);
        }
    }

    public function classMessage()
    {
        return $this->hasMany(ClassMessage::class);
    }
}
