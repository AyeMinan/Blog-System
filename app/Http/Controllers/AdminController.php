<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogFormRequest;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index(){
        return view("admin.index", [
            'blogs' => auth()->user()->blogs()->latest()->paginate(5)
        ]);
    }

    public function delete(Blog $blog){
        $blog->delete();
        return redirect()->back();
    }
    public function show(Blog $blog){
        return view('admin.create', [
            'blog' => $blog,
            'categories' => Category::all(),
        ]);
    }

    public function edit(Blog $blog){
        $this->authorize('edit', $blog);
        return view("admin.edit", [
            'blog' => $blog,
            'categories' => Category::all()
        ]);
    }

    public function create(Blog $blog, BlogFormRequest $request){
        $validatedData = $request->validated();

         $validatedData['user_id'] = auth()->id();

         $validatedData['photo'] = '/storage/' . request('photo')->store('/blogs');

         $blog->create($validatedData);
         return redirect('/admin');



    }

    public function update(Blog $blog, BlogFormRequest $request){
        $validatedData = $request->validated();

        if(request('photo')){
            $validatedData['photo'] = '/storage/' . request('photo')->store('/blogs');
            File::delete(public_path($blog->photo));
        }


         $blog->update($validatedData);

        return redirect('/admin');
    }
}
