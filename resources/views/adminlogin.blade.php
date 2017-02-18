@extends('layouts.master')



@section('title')
  Admin Section
@stop


@section('content')
@include('includes.message-block')
<div>
    <div>
      <form action="{{ route('admin.verify') }}" method = "post">
        <div class = "jumbotron" >
            <div class="text-center">
                <h1>Admin Login Page</h1>
                <p class = "alert alert-warning"> This is only for admins. Please verify yourself before entering.</p>
            </div>
        </div>

        <div class="form-group {{ $errors->has('password')?'has-error':''  }}" >
            <label for="password">Admin`s Password</label>
            <input class ="form-control" type="password" name = "password" id = "password" />
        </div>
        <button type = "submit" class = "btn btn-primary">Submit</button>
        <input type="hidden" name = "_token" value = "{{ Session::token() }}"/>
      </form>
    </div>
  </div>
@stop
