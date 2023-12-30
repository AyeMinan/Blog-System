<x-layout>
    <form action="/comments/{{$comment->id}}/update" method="POST">
        @csrf
<textarea class="form-control" name="body" cols="30" rows="10" placeholder="comments....">{{$comment->body}}</textarea>
<button class="mt-3 btn btn-primary" type="submit">Update</button>
    </form>
    @error('body')
                <p class="text-danger">{{$message}}</p>
                 @enderror
</x-layout>

