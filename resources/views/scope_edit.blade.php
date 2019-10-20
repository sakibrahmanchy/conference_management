@extends('layouts.master')
<?php $bodySize = "60" ?>
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width:60%">
    <h2>Edit Scope</h2>

        <form action="{{route('edit_scope',['conference_id'=>$conference_id,'scope_id'=>$scope->id])}}" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                   <label for="name">Name:</label>
                   <input class = "form-control" name="name" id="name" value="{{$scope->name}}" placeholder="Name."><br>
                </div>
                <div class="form_group" >
                   <label for="track_id">Select a Track for the scope:</label>
                   <select class = "form-control" name="track_id" id="track_id"  >
                       @foreach($tracks as $aTrack)
                            <option @if($scope->track_id==$aTrack->id) selected @endif value="{{$aTrack->id}}">{{$aTrack->track_name}}</option>
                       @endforeach
                   </select><br>

                </div><br>

                <button type = "submit" class = "btn btn-primary">Save Scope</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"/>
     </form>




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
