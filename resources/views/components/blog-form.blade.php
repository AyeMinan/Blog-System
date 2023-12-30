@props(['blog' => null, 'categories' => null])

<div class="container">
    <form action="{{$blog ? '/admin/'.$blog->id.'/update' : '/admin/blogs/create' }}" method="POST" enctype="multipart/form-data" >
        @csrf
        @if ($blog)
@method('put')
        @endif

        <div class="mb-3 form-group">
          <label for="blog title">Blog Title</label>
          <input type="text" name="title" class="form-control"  placeholder="Enter Blog Title" value="{{$blog?->title}}">
        </div>
        @error('title')
        <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="mb-3 form-group">

            <input type="file" name="photo" class="form-control" >
          </div>
          @error('photo')
          <div class="text-danger">{{$message}}</div>
          @enderror

          @if ($blog)
          <img src="{{$blog->photo}}"
          width="200px" height="200px"
          />

          @endif

        <div class="mb-3 form-group">
          <label for="slug">Slug</label>
          <input type="text" name="slug" class="form-control" placeholder="Enter Slug" value="{{$blog?->slug}}">
        </div>
        @error('slug')
        <div class="text-danger">{{$message}}</div>
        @enderror



        <div class="mb-3 form-group">
          <label for="body">Body</label>
          <textarea type="text" name="body" class="form-control" placeholder="Enter Body" value="">{{$blog?->body}} </textarea>
        </div>
        @error('body')
        <div class="text-danger">{{$message}}</div>
        @enderror

        <div class="mb-3 form-group">
            <label for="category">Blog Category</label>
          <select name="category_id" id="">
            @foreach ($categories as $category)
            <option {{ $category->id == $blog?->category->id ? 'selected' : ''}} value="{{$category->id}}" >{{$category->name}}</option>
          @endforeach
        </select>
        </div>
        @error('category_id')
        <div class="text-danger">{{$message}}</div>
        @enderror

        <button type="submit" class="btn btn-primary">{{$blog ? 'Update' : 'Create'}}</button>
      </form>
      </div>
