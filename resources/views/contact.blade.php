@extends('layouts.master')
@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" ><a href="{{route('dashboard')}}">Dashboard</a></li>
  <li role="presentation"><a href="{{route('account')}}">Account <span class="badge"></span></a></li>
   <li role="presentation" class = "active"><a href="">Contact <span class="badge"></span></a></li>
</ul>
<br>
@include('includes.message-block')
<body>

<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width:60%;">
 <form action="{{route('post.notifications',['to'=>'admin'])}}" method="post">
                <div class="form-group" >
                   <h1>Contact Admin</h1><p>Contact our admin -panel for any type of enquiries.<p><br>
                   <label for="message">Message:</label>
                   <textarea class = "form-control" name="message" id="message" cols="2" rows = "5" placeholder="Your message for the admin."></textarea><br>

                </div>
                <button type = "submit" class = "btn btn-primary">Send Message</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"/>
            </form>


</div>

</body>





@endsection