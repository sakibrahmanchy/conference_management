@extends('layouts.master')

@section('content')
@include("includes.conference_edit_header")
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width:60%">
    <h2>Update Reviewer</h2>

        <form action="{{route('edit_reviewer',["conference_id"=>$conference_id,"reviewer_id"=>$reviewer->id])}}" method="post" enctype="multipart/form-data">

                <div class="form-group" >
                   <label for="name">Name:</label>
                   <input class = "form-control" name="name" id="name"  placeholder="Name." value = "{{$reviewer->name}}"><br>
                </div>

                <div class="form_group" >
                   <label for="email">Email:</label>
                   <input class = "form-control" name="email" value = "{{$reviewer->email}}" id="email"  placeholder="Email"><br>
                </div>

                <div class="form-group" >
                   <label for="password">Password:</label>
                   <input class = "form-control" type="password" name="password" id="password" value="" placeholder="Password."><br>
                </div>

                <div class="form_group" >
                   <label for="image">Image:</label>
                    <img src="{{ route('reviewer_image',['conference_id'=>$conference_id,'filename' => 'reviewer-'.$reviewer->id . '.jpg']) }}" alt="" class="img-responsive"/>
                   <input class = "form-control" name="image" id="image"  placeholder="Image" type="file"><br>
                </div>
				
                 <div class="form_group" >
                   <label for="scope_id">Select a scope to review:</label>
                   <select class = "form-control" name="scope_id" id="scope_id"  >
                       @foreach($scopes as $aScope)
                            <option @if($userScope->scope_id==$aScope->id) selected @endif value="{{$aScope->id}}">{{$aScope->name}}</option>
                       @endforeach
                   </select><br>

                </div><br>

                <button type = "submit" class = "btn btn-primary">Update Reviewer</button>
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
