<x-layout>
   <div class="d-flex justify-content-center" >
    <a href="" class=" btn btn-primary">Blogs</a>
    <a href="/admin/blogs" class=" btn btn-warning">Create Blog</a>
</div>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Blog Title</th>
            <th scope="col">Slug </th>
            <th scope="col">Body </th>
            <th scope="col">Category</th>
            <th scope="col" colspan="2">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <th scope="row">{{$blog->id}}</th>
                <td>{{$blog->title}}</td>
                <td>{{$blog->slug}}</td>
                <td>{{$blog->body}}</td>
                <td>{{$blog->category->name}}</td>
                @if (auth()->user()->can('edit', $blog))
                <td> <a href="/admin/{{$blog->id}}/edit" class="btn btn-warning">Edit</a></td>
                @endif

                @if (auth()->user()->can('delete', $blog))
                <form action="/admin/{{$blog->id}}/delete" method="POST">
                    @csrf
                   <td><button type="submit" class="btn btn-danger">
                    Delete</button></td>
                   </form>
                @endif

              </tX`r>
            @endforeach

        </tbody>
      </table>


</x-layout>
