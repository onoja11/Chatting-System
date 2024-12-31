<?php

namespace App\Livewire;

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $department = Auth::user()->department;
        $level = Auth::user()->level;
        $courses = ClassRoom::where('department','=', $department)->where('level',$level)->get();
        return view('livewire.sidebar', compact('courses'));
    }
}
