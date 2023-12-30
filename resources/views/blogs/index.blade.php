    <x-layout>
  <x-category></x-category>
      <div class="container">
        <form action="/">
      <input value="{{request('category')}}"type="hidden" name="category">
        <label for="query">Search:</label>
        <input value="{{request('search')}}"type="text" id="query" name="search" placeholder="Type your search here...">
        <button type="submit">Search</button>
      </form>
        <h2>My Bologs</h2>
        @foreach($blogs as $blog )
          <h3><a href="/blogs/{{$blog->slug}}"> {{ $blog->title }} </a> </h3>
          <p>
          {{$blog->body}}
          </p>
          <p>
          <a href="/?category={{$blog->category->slug}}"> Category - {{$blog->category->name}} </a>
          </p>
          <p>
            <a href="/?user={{$blog->user->name}}">User - {{$blog->user->name}}</a>
          </p>
        @endforeach
      
        {{$blogs->links()}}
        </dwiv>
        </x-layout>

