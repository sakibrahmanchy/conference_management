@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')

<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" ><a href="{{route('dashboard')}}">Dashboard</a></li>
  <li role="presentation" class = "active"><a href="{{route('account')}}">Account <span class="badge"></span></a></li>
   <li role="presentation"><a href="{{route('getContact')}}">Contact <span class="badge"></span></a></li>
</ul>

<br>
        <div class = "col-md-6 col-md-offset-3 jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
            <header class = ""><h1>Your Account</h1></header>
                @if(Storage::disk('local')->has($user->userID.'.jpg'))
        <section class = "row new-post">
            <div class = "col-md-6 col-md-offset-3">
                <img src="{{ route('account.image',['filename' => $user->userID . '.jpg']) }}" alt="" class="img-responsive"/>
            </div>
        </section>
    @endif
             <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">

                <br><div class = "form-group">
                    <label for="name">Name</label>
                    <input type="text" name = "name" class = "form-control" value = "{{ $user->name }}" id = "name"/>
                </div>
                 <div class = "form-group">
                    <label for="presentDesignation">Present Designation</label>
                    <input type="text" name = "presentDesignation" class = "form-control" value = "{{ $user->presentDesignation }}" id = "presentDesignation"/>
                </div>

                 <div class = "form-group">
                    <label for="payScale">Payscale</label>
                    <input type="text" name = "payScale" class = "form-control" value = "{{ $user->payScale }}" id = "payScale"/>
                </div>
                <div class = "form-group">
                    <label for="phone">Phone</label>
                    <input type="text" name = "phone" class = "form-control" value = "{{ $user->phone }}" id = "phone"/>
                </div>

                <div class = "form-group">
                    <label for="image">Image(only .jpg)</label>
                    <input type="file" name = "image" class = "form-control" id = "image"/>
                </div>
                <button type = "submit" class = "btn btn-primary">Save Account</button>
                <input type="hidden" value = "{{ Session::token() }}" name = "_token"/>
             </form>
        </div>


@endsection