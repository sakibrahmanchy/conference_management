@extends('layouts.master')
<?php $bodySize = "60" ?>
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width:60%">
    <h2>Create Speaker</h2>

        <form action="{{route('create_speaker',['conference_id'=>$conference_id])}}" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                   <label for="name">Name:</label>
                   <input class = "form-control" name="name" id="name"  placeholder="Name."><br>
                </div>
                <div class="form-group" >
                   <label for="venue">Profession:</label>
                   <textarea class = "form-control" name="profession" id="profession" col="2" row="30"  placeholder="Profession."></textarea><br>
                </div>
                <div class="form-group" >
                   <label for="institute">Institute:</label>
                   <input class = "form-control" name="institute" id="institute"  placeholder="Institute"><br>
                </div>
                <div class="form-group" >
                   <label for="address">Address:</label>
                    <input class = "form-control" name="address" id="address"  placeholder="Address"><br>
                </div>
                <div class="form_group" >
                   <label for="email">Email:</label>
                   <input class = "form-control" name="email" id="email"  placeholder="Email"><br>
                </div>
                <div class="form-group" >
                   <label for="biography">Biography:</label>
                   <textarea class = "form-control" name="biography" id="biography" col="2" row="30"  placeholder="Biography."></textarea><br>
                </div>
                <div class="form_group" >
                   <label for="image">Image:</label>
                   <input class = "form-control" name="image" id="image"  placeholder="Image" type="file"><br>
                </div>

                <button type = "submit" class = "btn btn-primary">Create Speaker</button>
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
