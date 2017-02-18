@extends('layouts.master')
@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" class = "active"><a href="">Dashboard</a></li>
  <li role="presentation"><a href="{{route('account')}}">Account <span class="badge"></span></a></li>
   <li role="presentation"><a href="{{route('getContact')}}">Contact <span class="badge"></span></a></li>
</ul>

@include('includes.message-block')
<body>

<div class="container">
  <br>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      @foreach($advertisements as $index=>$advertisement)
         <li data-target="#myCarousel" data-slide-to="{{ $index }}" class="active"></li>
      @endforeach
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner jumbotron" role="listbox" style = " background-color:#204d74 ;color: #f5f5f5;">
        @foreach($advertisements as $index=>$advertisement)
                <div class="item @if($index==0) {{ 'active' }} @endif">
                        <div class="col-sm-2">

                        </div>
                        <div class="col-sm-8" style = "text-align: left; background-color:#204d74 ">
                            <p></p><br>
                             <p><b>House No.:</b> {{$advertisement->houseName}}</p>
                             <p><b>House Type:</b> {{$advertisement->houseType}}</p>
                             <p><b>House Description:</b> {{$advertisement->houseDescription}}</p>
                             <p><b>Additional Comments:</b> {{$advertisement->comments  }}</p>
                            <i> <p style="text-align: right">posted at {{$advertisement->created_at}}</p></i>
                            <a  href="{{route('request.allotment',['housename'=>$advertisement->houseName])}}" type = "button" class = "btn btn-primary col-md-offset-3">Request for allotment</a><br><br>
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