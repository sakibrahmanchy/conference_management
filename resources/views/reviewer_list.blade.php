@extends('layouts.master')
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
    <h2>Reviewer List</h2>
    <p>Manage your reviewers!</p>
    <br><a style="float:right" class="btn btn-success" href="{{route('create_reviewer',['conference_id'=>$conference_id])}}">New Reviewer</a><br><br><br>
    @foreach($reviewerList as $aReviewer)

            <div class="col-md-4">
                <div class="thumbnail">
                     <img src="{{ route('reviewer_image',['conference_id'=>$conference_id,'filename' => 'reviewer-'.$aReviewer->id . '.jpg']) }}" alt="" class="img-responsive"/>
                    <div class="caption">
                         <h3>{{$aReviewer->name}}</h3>
                        <p>{{$aReviewer->phone}}</p>
                        <div class="row">
                         <div class="col-md-6">
                            <a href="{{route('edit_reviewer',["conference_id"=>$conference_id,"reviewer_id"=>$aReviewer->id])}}" class="btn btn-primary btn-block">Edit</a>
                         </div>
                         <div class="col-md-6">
                            <a href="{{route('delete_reviewer',["reviewer_id"=>$aReviewer->id,"conference_id"=>$conference_id])}}" class="btn btn-primary btn-block">Delete</a></div>
                         </div>
                        </p>
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
