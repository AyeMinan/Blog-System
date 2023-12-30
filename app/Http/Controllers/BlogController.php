<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index(){
        $filters=request(['search', 'category', 'user']);
            return view('blogs.index', [

                'blogs' =>Blog::with('category', 'user')
                ->filter($filters)
                ->latest()
                ->paginate(3)
                ->withQueryString(),

            ]);


    }

    public function show(Blog $blog){

            return view('blogs.show', [
                'blog' => $blog
            ]);


    }

    public function showWithCategory(Category $category){

            return view('blogs.index', [
                'blogs' => $category->blogs()->with('category', 'user')->paginate()

            ]);


    }
    public function showWithUser(User $user){

            return view('blogs.index', [
                'blogs' => $user->blogs()->with('category', 'user')->paginate()
            ]);

    }

}
