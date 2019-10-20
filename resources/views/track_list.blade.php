@extends('layouts.master')
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
    <h2>Track List</h2>
    <p>Manage your tracks!</p>
    <br><a style="float:right" class="btn btn-success" href="{{route('create_track',['conference_id'=>$conference_id])}}">New Track</a><br><br><br>
    <?php $trackCounter = "1"; ?>
    @foreach($trackList as $aTrack)
       <div class="panel-group" id="accordion" style="color:black   ">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$trackCounter}}">Track {{$trackCounter}}: {{ $aTrack->track_name }} </a>
              <a style="float: right; color: #006dcc; margin-right: 5px; " href="{{route('delete_track',["conference_id"=>$conference_id,"track_id"=>$aTrack->id])}}">Delete</a><span style="float:right">| </span>
              <a style="float: right; color: #006dcc;margin-right: 5px;" href="{{route('edit_track',["conference_id"=>$conference_id,"track_id"=>$aTrack->id])}}" >Edit </a>
            </h4>
          </div>
          <div id="collapse{{$trackCounter++}}" class="panel-collapse collapse" >
            <div class="panel-body">{{$aTrack->description}}
            <br><br>
            <div class="col-md-6">
                <ul>
                @foreach($aTrack->scopes as $aScope)
                    <li>{{@$aScope->name}}
                        <a style=" margin-left: 20px; color: #006dcc; margin-right: 5px; " href="{{route('delete_scope',["conference_id"=>$conference_id,"scope_id"=>$aScope->id])}}">Delete</a>|
              <a style=" color: #006dcc;margin-right: 5px;" href="{{route('edit_scope',["conference_id"=>$conference_id,"scope_id"=>$aScope->id])}}" >Edit</a>
                    </li>
                @endforeach
                <br><br>
                <li style="list-style-type: none"><a class="btn btn-primary" href="{{route('create_scope',["conference_id"=>$conference_id,"track_id"=>$aTrack->id])}}" >New Scope</a></li>
                </ul>
                <br><br>

            </div>
            <div class="col-md-6 thumbnail">
               <img src="{{ route('track_image',['conference_id'=>$conference_id,'filename' => 'track-'.$aTrack->id . '.jpg']) }}" alt="" class="img-responsive"/>
            </div>
          </div>
        </div>
        </div>
    @endforeach

</div>


<script>
 $(document).ready(function(){
        $('.datepicker').datepicker({
            orientation: "bottom",
            autoclose: true,
            format: 'yyyy/mm/dd'
        });

 });


</script>



</body>





@endsection
