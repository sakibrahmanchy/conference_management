@extends('layouts.master')
@section('content')


@include('includes.message-block')
<body>
    @if($notifications->isEmpty())
     <div class = "jumbotron" style = "background-color: #204d74; color: #f5f5f5;">
       <p>You have no notifications.</p>
     </div>
    @else
    @foreach($notifications as $notification)
        <div class = "jumbotron" style = "background-color: #204d74; color: #f5f5f5; border: solid black 2px;">

            <p>{{$notification->message}}</p>
            From:  <p>{{$notification->from}}</p>
        </div>
    @endforeach
    @endif


</body>





@endsection