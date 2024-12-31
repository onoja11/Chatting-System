<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassMessage extends Model
{
    protected $fillable=[
        'class_rooms_id',
        // 'department_id',
        'sender_id',
        'body', 
        'file_name'
    ];

    public function classroom()
     {
         return $this->belongsTo(ClassRoom::class);
     }
}
