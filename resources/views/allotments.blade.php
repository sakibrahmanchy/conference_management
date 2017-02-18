@extends('layouts.master')
@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" class = ""><a href="{{route('admin.panel')}}">Advertisements</a></li>
  <li role="presentation" class = ""><a href="{{route('user.requests')}}">User Requests <span class="badge">{{$requests}}</span></a></li>
  <li role="presentation" class = "active"><a href="#">Allotment Requests</a></li>
  <li role="presentation"><a href="{{ route('route.house.entry') }}">HouseEntry </a></li>
</ul>

@include('includes.message-block')
<body>
<br>
<div class="container jumbotron"  style = "background-color:#204d74 ;color:white;font-size:20px">
        @foreach($userRequests as $index=>$userRequest)
                 <div>
                           <div class="container col-sm-4">
                                <h2>House: {{$userRequest->houseName}}</h2>
                                <p>{{$userRequest->houseType}}</p>
                                <a href = "{{route('sorted.users',['housename'=>$userRequest->houseName])}}" type="button" class="btn btn-info">View Requests</a>
                           </div>

                 </div>
        @endforeach
</div>


</body>





@endsection