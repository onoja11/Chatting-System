<?php

namespace App\Livewire;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;


class MarketplaceUpload extends Component
{
    use WithFileUploads;
    public $isOpen = false;
    public $title;
    public $description;
    public $category;
    public $file;
    public $price;


    public function createUpload(){
        $this->validate([
            'title' => "required|string",
            'category' => "required|numeric|exists:categories,id",
            'price' => "required|numeric",
            'description' => "required|string",
            'file' => "required|file|mimes:pdf|max:1024000",
        ]);
        
        $path=$this->file->store('images', 'public');

        Book::create([
            'title'=>$this->title,
            'description'=>$this->description,
            'category_id'=>$this->category,
            'file'=>$path,
            'price'=>$this->price,
            'seller_id'=>Auth::user()->id,
            'number_purchased'=>0
        ]);
        Alert::toast('Uploaded Successfully', 'success');
        return redirect(route('marketplace.dashboard'));
        // $authenticatedUserId = Auth::user()->id;
        // $department = Auth::user()->department;
       
    }
    public function render()
    {
        $categories =  Category::oldest('title')->get();
        return view('livewire.marketplace-upload', compact( 'categories'));
    }
}
