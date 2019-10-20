@extends('layouts.master')



@section('title')
  Welcome!
@stop



@section('content')
@include('includes.message-block')
<div class="row jumbotron" style = "background-color: #204d74; color: #f5f5f5; "  >
    <div class="col-md-6">
      <form action="{{ route('signin') }}" method = "post">
        <h3>Sign In</h3>
        <div class="form-group {{ $errors->has('email')?'has-error':''  }}">
            <label for="id">Your email</label>
            <input class ="form-control" type="text" name = "email" id = "email" value = "{{ Request::old('email')  }}"/>
         </div>
        <div class="form-group {{ $errors->has('password')?'has-error':''  }}" >
            <label for="password">Your Password</label>
            <input class ="form-control" type="password" name = "password" id = "password"/>
        </div>
        <button type = "submit" class = "btn btn-primary">Submit</button>
        <input type="hidden" name="conference_id" value= "{{$conference_id}}">
        <input type="hidden" name = "_token" value = "{{ Session::token() }}"/>
      </form>
    </div>

    <div class="col-md-6 text-center" style="margin-top:50px">
            <h3>Not registered yet?</h3>
            <h4><a href="{{route('submit_signup_get',["conference_id"=>$conference_id])}}"><button class="btn btn-success">Sign up</button></a> now to start</h4>
      </div>
</div>


@stop
