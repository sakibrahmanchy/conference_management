@extends('layouts.master')
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
    <h2>Committee List</h2>
    <p>Manage your committees!</p>
    <br><a style="float:right" class="btn btn-success" href="{{route('create_committee',['conference_id'=>$conference_id])}}">New Committee</a><br><br><br>
    <?php $committeeCounter = "1"; ?>
    @foreach($committeeList as $aCommittee)
       <div class="panel-group" id="accordion" style="color:black   ">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$committeeCounter}}">Committee {{$committeeCounter}}: {{ $aCommittee->name }} </a>
              <a style="float: right; color: #006dcc; margin-right: 5px; " href="{{route('delete_committee',["conference_id"=>$conference_id,"committee_id"=>$aCommittee->id])}}">Delete</a><span style="float:right">| </span>
              <a style="float: right; color: #006dcc;margin-right: 5px;" href="{{route('edit_committee',["conference_id"=>$conference_id,"committee_id"=>$aCommittee->id])}}" >Edit </a>
            </h4>
          </div>
          <div id="collapse{{$committeeCounter++}}" class="panel-collapse collapse" >
            <div class="panel-body">{!! $aCommittee->description !!}</div>
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
