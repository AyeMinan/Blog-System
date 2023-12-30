<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function toggle(Blog $blog){
        if($blog->isSubscribedBy(auth()->user())){
            $blog->subscribedUsers()->detach();
    }else{
        $blog->subscribedUsers()->attach(auth()->user()->id);
    }
    return back();
}

}
