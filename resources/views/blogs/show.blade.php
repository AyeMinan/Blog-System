<x-layout>
    <div class="container">
    <h2>{{$blog->id}} {{$blog->title}} </h2>
    <p>{{$blog->body}} </p>
    <form action="/blogs/{{$blog->slug}}/handle-subscription" method="POST">
        @csrf
    @if ($blog->isSubscribedBy(auth()->user()))

    <button class="btn btn-danger" type="submit">UnSubscribe</button>
    @else
    <button class="btn btn-warning"  type="submit">Subscribe</button>

    @endif
</form>


    <div class="row">
        <div class="my-3">
            <form action="/blogs/{{$blog->slug}}/comments" method="post">
                @csrf
                <textarea class="form-control" name="body" cols="30" rows="10" placeholder="comments...."></textarea>
                @error('body')
                <p class="text-danger">{{$message}}</p>
                 @enderror
                <button class="mt-3 btn btn-primary" type="submit">Comment</button>
            </form>
        </div>

        @foreach ($blog->comments->load('user')->sortByDesc('id') as $comment)
            <div>
                <h3>{{$comment->user->name}}</h3>
                <p>
                    {{$comment->body}}
                </p>
                <p>
                   Commented at - {{$comment->created_at->diffForHumans()}}
                </p>
                <form action="/comments/{{$comment->id}}/edit" method="POST">
                    @csrf
                <button class="mb-3 btn btn-primary"  >Edit</button>
                </form>
                <form action="/comments/{{$comment->id}}" method="POST">
                    @csrf
                <button class="btn btn-danger" type="submit">Delete</button>
                <form>
            </div>
        @endforeach
    </div>
</div>
</x-layout>
