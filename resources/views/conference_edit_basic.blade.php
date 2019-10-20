@extends('layouts.master')
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
    <h2>Conference Basic Informations</h2>
    <p>Manage basic informations of your conference!</p>

           <form action="{{route('edit_conference',["conference_id"=>$conference->id])}}" method="post" enctype="multipart/form-data">
                <div class="form-group" >
                   <label for="title">Title (Must be at least of two words):</label>
                   <input class = "form-control" name="title" id="title"  placeholder="Conference Title." value="{{$conference->title}}"><br>
                </div>
                <div class="form-group" >
                   <label for="venue">Venue:</label>
                   <textarea class = "form-control" name="venue" id="venue" col="2" row="30"  placeholder="Conference venue." >{{$conference->venue}}</textarea><br>
                </div>
                 <div class="form-group" >
                   <label for="welcome_text">Welcome Text:</label>
                   <textarea class = "form-control" name="welcome_text" id="welcome_text" col="2" row="30"  placeholder="Welcome text.">{{$conference->welcome_text}}</textarea><br>
                </div>
                <div class="form-group" >
                   <label for="tag_lines">Tag Lines :</label>
                   <textarea class = "form-control" name="tag_lines" id="tag_lines" col="2" row="30"  placeholder="Add tag lines separated by comma(,) example : Papers available, Registration is closed ">{{$conference->tag_lines}}</textarea><br>
                </div>

                <div class="form_group" >
                   <label for="logo">Logo:</label>
                   <input type="file" class = "form-control" name="logo" id="logo"  placeholder="logo" type="logo"><br>
                </div>

                <div class="form_group" >
                   <label for="cover">Cover Photo:</label>
                   <input type="file" class = "form-control" name="cover" id="cover"  placeholder="cover" type="logo"><br>
                </div>

                <button type = "submit" class = "btn btn-primary">Save Basic Informations</button>
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

    CKEDITOR.replace('welcome_text');
    CKEDITOR.replace('venue');
</script>



</body>





@endsection
