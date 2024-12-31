<?php

namespace App\Livewire;

use App\Models\ClassRoom;
use App\Models\Conversation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;


class JoinClass extends Component
{
    public $isOpen = false;
    public $course_title;
    public $course_code;
    public $lecturer_id;

    
    public function createClassroom(){
        // dd(Auth::user()->department);
        // dd($this->lecturer_id);
        $this->validate([
            'course_title' => "required|string|unique:class_rooms,course_title",
            'course_code' => "required|string|unique:class_rooms,course_code"
        ]);
        ClassRoom::create([
            'course_title'=>$this->course_title,
            'course_code'=>$this->course_code,
            'lecturer_id'=> Auth::user()->id,
            'department' => Auth::user()->department,
            'lecturer_name' => Auth::user()->name,
            'level' => Auth::user()->level
        ]);
        Alert::toast('Class Created Successfully', 'success');
        return redirect(route('classroom'));
        $authenticatedUserId = Auth::user()->id;
        $department = Auth::user()->department;
       
    }

    public function render()
    {
        return view('livewire.join-class');
    }
}
