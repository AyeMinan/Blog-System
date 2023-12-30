<x-layout>
    <div class="container my-3">
  <form action="/login" method="POST">
    @csrf
    <div class="row">
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" value="{{old('email')}}" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
      @error('email')
      <p class="text-danger">{{$message}}</p>
       @enderror
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" value="{{old('password')}}" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
      @error('password')
      <p class="text-danger">{{$message}}</p>
       @enderror
    </div>
    </div>
    <div class="form-group my-3">
    <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </form>

  </div>
  </x-layout>
