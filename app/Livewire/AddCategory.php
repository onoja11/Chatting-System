<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use RealRashid\SweetAlert\Facades\Alert;
    

class AddCategory extends Component
{
    public $isOpen = false;
    public $name;
    public $description;



    public function createCategory(){
        // dd(Auth::user()->department);
        // dd($this->lecturer_id);
        $this->validate([
            'name' => "required|string|unique:categories,title",
            'description' => "required|string"
        ]);
        Category::create([
            'title'=>$this->name,
            'description'=>$this->description
        ]);
        Alert::toast('Category Added Successfully', 'success');

        return redirect(route('marketplace.dashboard'));
        // $authenticatedUserId = Auth::user()->id;
        // $department = Auth::user()->department;
       
    }
    public function render()
    {
        return view('livewire.add-category');
    }
}
