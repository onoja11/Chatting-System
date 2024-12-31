<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\ClassRoom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;


class PageController extends Controller
{
    public function classroom(){
        // dd(Auth::user()->department);
        // $classrooms = ClassRoom::all();
        $department = Auth::user()->department;
        $level = Auth::user()->level;
        $color = ['blue','red', 'green', 'purple'];
        $color = $color[3];
        $classrooms = ClassRoom::where('department','=', $department)->where('level',$level)->get();
        return view('classroom', compact('classrooms','color'));
    }

    public function classchat(){
        return view('classchat');
        }

    public function marketplaceDashboard(){
        $seller_id=Auth::user()->id;
        $books=Book::where('seller_id', $seller_id)->paginate(6);
        $title1 = 'Delete User!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title1, $text);
        return view('marketplace/dashboard', compact('books'));
    }

    public function marketplaceShop(){
        $department = Auth::user()->department;
        $level = Auth::user()->level;
        $books=Book::latest()->paginate(6);
        $courses = ClassRoom::where('department', $department)->where('level',$level)->get();
        $categories=Category::all()->sortBy('title');
        return view('marketplace/shop', compact('categories', 'books', 'courses'));
    }

    public function destroy($id)
    {
        Book::whereId($id)->delete();
        
        Alert::toast('Deleted Successfully', 'success');
        return back();
    }

    public function edit($id)
    {
        // $category = Category::find($id)
        $books = Book::findOrFail($id);
        $categories = Category::oldest('title')->get();

        return view('marketplace.edit-book', compact('categories','books'));
    }

    public function update(Request $request, $id){
        // dd("dhdhd");
        $book = Book::where('id', $id)->firstOrFail();
        
        $data = $request->validate([
            'title' => "required|string",
            // 'description' => "required|string",
            'category' => "required|numeric|exists:categories,id",
            'description' => "required|string",
            // 'cover' => "nullable|image|mimes:jpg,png,jpeg|max:2048",
            'file' => "nullable|file|mimes:pdf|max:10240",
            'price' => "required|numeric",
        ]);

        if ($request->hasFile('file')) {
            $path=$data['file']->store('images', 'public');
        }

        // $oldBookFile = public_path('uploads/books/' . $book->file);

        $book->update([
            'category_id' => $data['category'],
            'title' => $data['title'],
            'file' => $request->hasFile('file') ? $path : $book->file,
            'description' => $data['description'],
            'price'=>$data['price']
        ]);
        // dd("nice");
        // if ($request->hasFile('file')) {
        //     if (File::exists($oldBookFile)) {
        //         File::delete($oldBookFile);
        //     }
        // }
        Alert::toast('Book Updated Successfully', 'success');
        return redirect(route('marketplace.dashboard'));

    }



    public function search(Request $request)
    {
        $search=$request->input('search');
        if (empty($search)) {
            Alert::toast('Please Enter a Search Keyword', 'warning');
            return redirect(route('marketplace.shop'));
        }
        else{
            $books= Book::where('title', 'like', "%$search%")
            ->orwhere('price', 'like', "%$search%")
            ->orwhereHas('category', function($query) use ($search){
                $query->where('title', 'like', "%$search%");
            })
            ->with(['category'])
            ->paginate(12);
            $department = Auth::user()->department;
            $level = Auth::user()->level;
            // $books=Book::latest()->get();
            $courses = ClassRoom::where('department', $department)->where('level',$level)->get();
            $categories=Category::all()->sortBy('title');
            // $title="Search Result For: ".$search;
            return view('marketplace.search', compact('books', 'search','courses','categories'));
        }
    }


    public function watch(){
        Alert::error('No Available Ads', 'Please try again later');
        return back();
    }
}
