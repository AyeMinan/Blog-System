<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="/">Blog System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-item nav-link active" href="/">Home</a>
        <a class="nav-item nav-link" href="#">Features</a>
        <a class="nav-item nav-link" href="#">Pricing</a>
        @if (auth()->check())
        <form action="/logout" method="POST">
            @csrf
       <a class="nav-item"><button class="btn btn-danger" type="submit">Logout </button></a>
        </form>
        @else
        <a class="nav-item nav-link" href = "/login">Login</a>
        <a  class="nav-item nav-link" href = "/register">Register</a>
        @endif
      </div>
    </div>
  </nav>

@if (session()->has('message'))
<div class="alert alert-success" role="alert">
    {{(session()->get('message'))}}
  </div>
@endif


