@extends('layouts.app')

@section('content')
<form id="user-frm" class="form-signin" method="POST" action="{{ route('login.store') }}">
    @csrf
    <img class="mb-8" src="https://www.veefin.com/assets/imgs/logo.png" alt="" width="72" height="72">

    <div class="form-group row">
        <label for="inputName" class="sr-only">Name</label>
        <input type="text" id="inputName" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter Name" autofocus autocomplete="off">
        @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
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
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign Up</button>
    <div class="checkbox mb-1">
        <label>Already have account | </label><a href="{{url('login')}}"> Login </a>
    </div>
</form>
@endsection