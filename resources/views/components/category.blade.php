
<div class="dropdown">
  <button class="btn btn-bg-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    Dropdown button
  </button>
  <ul class="dropdown-menu">
    @foreach($categories as $category)
    <li><a class="dropdown-item" href="/?category={{$category->slug}}{{request('search') ? '&search='.request('search') : '' }}">
    {{$category->name}}
    </a>

  </li>
    @endforeach
  </ul>
</div>

      