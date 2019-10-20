@extends('layouts.master')
<?php $bodySize = "60" ?>
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width:60%">
    <h2>Create Reviewer</h2>

        <form action="{{route('create_reviewer',['conference_id'=>$conference_id])}}" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                   <label for="name">Name:</label>
                   <input class = "form-control" name="name" id="name"  placeholder="Name."><br>
                </div>
                 <div class="form_group" >
                   <label for="email">Email:</label>
                   <input class = "form-control" name="email" id="email"  placeholder="Email"><br>
                </div>
                <div class="form-group" >
                   <label for="password">Password:</label>
                   <input class = "form-control" name="password" id="password" type="password"  placeholder="Password"><br>
                </div>
                <div class="form-group" >
                   <label for="phone">Phone:</label>
                    <input class = "form-control" name="phone" id="phone"  placeholder="Phone"><br>
                </div>
                <div class="form_group" >
                   <label for="image">Image:</label>
                   <input class = "form-control" name="image" id="image"  placeholder="Image" type="file"><br>
                </div>
                 <div class="form_group" >
                   <label for="scope_id">Select a scope to review:</label>
                   <select class = "form-control" name="scope_id" id="scope_id"  >
                       @foreach($scopes as $aScope)
                            <option {{--@if($scope->track_id==$aTrack->id) selected @endif--}} value="{{$aScope->id}}">{{$aScope->name}}</option>
                       @endforeach
                   </select><br>

                </div><br>
                <button type = "submit" class = "btn btn-primary">Create Reviewer</button>
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
