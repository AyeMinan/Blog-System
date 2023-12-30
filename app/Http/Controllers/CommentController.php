<?php

namespace App\Http\Controllers;

use App\Mail\SubscriberMail;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    public function store(Blog $blog)
    {
        if (!auth()->check()) {
            // Handle the case where the user is not authenticated
            return redirect()->route('login')->with('message', 'Please log in to leave a comment.');
        }
        request()->validate([
            'body' => 'required',
        ]);


        $comment = new Comment(['body' => request('body')]);
        $comment->user()->associate(auth()->user());
        $blog->comments()->save($comment);

        $subscribedUsers = $blog->subscribedUsers->filter(function ($user){
            return $user->id !== auth()->id();
        })->each(function ($subscriber) use ($comment){
            Mail::to($subscriber->email)->queue(new SubscriberMail($subscriber, $comment));
        });




        return back()->with('message','Commented');
    }

    public function delete( Comment $comment){
        $comment->delete();
        return back()->with('message','Comment is successfully deleted');
    }

    public function edit(Comment $comment){
        return view('comments.edit', [
            'comment' => $comment,
        ]);
    }

    public function update(Comment $comment){

            request()->validate([
                'body'=> 'required',
                ]);

            $comment->body = request('body');
            $comment->save();
            return redirect()->route('blogs.show' , $comment->blog->slug);
        }

}
