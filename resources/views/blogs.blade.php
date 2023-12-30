<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style.css" >
    <title>Document</title>
</head>
<body>
  <x-navbar></x-navbar>
  <div class="container">
    <h2>My Bologs</h2>
    @foreach($blogs as $blog )
      <h3><a href="/blogs/{{$blog->slug}}"> {{ $blog->title }} </a> </h3>
      <p>
       {{$blog->body}}
      </p>
    @endforeach
    </div>
    <x-footer></x-footer>
</body>
</html>
