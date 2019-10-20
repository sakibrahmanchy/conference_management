@extends('layouts.master')
@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" class = "active"><a href="{{route('user.requests')}}">User Requests <span class="badge"></span></a></li>
</ul>
<br>
@include('includes.message-block')
<body>

<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      @foreach($userRequests as $index=>$userRequest)
         <li data-target="#myCarousel" data-slide-to="{{ $index }}" class="active"></li>
      @endforeach
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner jumbotron" role="listbox" style = "background-color:#204d74 ;color: #f5f5f5;">

        @foreach($userRequests as $index=>$userRequest)
                <div class="item @if($index==0) {{ 'active' }} @endif">
                         <div class="col-sm-4 " style = " background-color:#204d74 ">
                         <p class="text-left"><h2>{{$userRequest->name}}</h2></p>
                         @if(Storage::disk('local')->has("user-".$userRequest->id.'.jpg'))
                                    <image src ="{{route('account.image',['filename'=>"user-".$userRequest->id.'.jpg'])}}" alt = "" class="img-responsive"></image>
                         @else
                            <image src ="{{route('account.image',['filename'=>'default.jpg'])}}" alt = "" class="img-responsive"></image>
                         @endif
                        </div>
                        <div class="col-sm-8" style = "text-align: left; background-color:#204d74 ">
                            <p></p><br>
                             <p><b>Staff email:</b> {{$userRequest->email}}</p>
                             <p><b>Description:</b> {{$userRequest->description}}</p>
                             <p><b>Phone:</b> {{$userRequest->phone}}</p>
                             <p><b>Facebook:</b> <a href = "www.facebook.com/{{$userRequest->facebook}}">www.facebook.com/{{$userRequest->facebook}}</a></p>
                             <p><b>Twitter:</b> <a href = "www.twitter.com/{{$userRequest->twitter}}">www.twitter.com/{{$userRequest->firstDesignation}}</a></p>

                        </div>
                        <div class="col-sm-4" style = "text-align: left; background-color:#204d74;margin-left: 140px ">
                            <p></p><br><br><br><br>

                             <a href="{{route('user.accept',['userid'=>$userRequest->id])}}" type = "button" class = "btn btn-primary">Accept</a>
                            <a href="{{route('user.reject',['userid'=>$userRequest->id])}}" type = "button" class = "btn btn-primary">Reject</a><br><br>
                        </div>
                </div>
        @endforeach
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>

</body>





@endsection