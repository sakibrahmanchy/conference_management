@extends('layouts.master')

@section('content')
@include("includes.conference_edit_header")
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width:60%">
    <h2>Update Track</h2>

        <form action="{{route('edit_track',["conference_id"=>$conference_id,"track_id"=>$track->id])}}" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                   <label for="name">Name:</label>
                   <input class = "form-control" name="track_name" id="name"  placeholder="Name." value = "{{$track->track_name}}"><br>
                </div>
                <div class="form-group {{ $errors->has('description')?'has-error':''  }}" >
                    <label for="description">Description</label>
                     <textarea class ="form-control" type="description" name = "description" id = "description" row="30" col="5">{{$track->description}}</textarea>
                </div>

                <div class="form_group" >
                   <label for="image">Image:</label>
                    <img src="{{ route('track_image',['conference_id'=>$conference_id,'filename' => 'track-'.$track->id . '.jpg']) }}" alt="" class="img-responsive"/>
                   <input class = "form-control" name="image" id="image"  placeholder="Image" type="file"><br>
                </div>

                <button type = "submit" class = "btn btn-primary">Update Track</button>
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
