@extends('layouts.app')

@section('content')
<form id="user-frm" class="form-signin" method="POST" action="{{ route('login.authenticate') }}">
    
<img class="mb-8" src="https://www.veefin.com/assets/imgs/logo.png" alt="" width="72" height="72">
    @csrf
    <div class="form-group row">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" name="email" class="form-control" value="{{ old('email') }}" placeholder="Email address" autofocus autocomplete="off">
        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group row">
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="password" class="form-control" value="{{ old('password') }}" placeholder="Password" autocomplete="off">
        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <div class="checkbox mb-1">
        <label>don't have account | </label> <a href="{{url('register')}}"> Register </a>
    </div>
</form>
@endsection