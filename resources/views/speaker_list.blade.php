@extends('layouts.master')
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
    <h2>Speaker List</h2>
    <p>Manage your speakers!</p>
    <br><a style="float:right" class="btn btn-success" href="{{route('create_speaker',['conference_id'=>$conference_id])}}">New Speaker</a><br><br><br>
    @foreach($speakerList as $aSpeaker)

            <div class="col-md-4">
                <div class="thumbnail">
                     <img src="{{ route('speaker_image',['conference_id'=>$conference_id,'filename' => 'speaker-'.$aSpeaker->id . '.jpg']) }}" alt="" class="img-responsive"/>
                    <div class="caption">
                         <h3>{{$aSpeaker->name}}</h3>
                        <p>{{$aSpeaker->profession}}</p>
                        <p>{{$aSpeaker->institute}}</p>
                         <div class="row">
                         <div class="col-md-6">
                            <a href="{{route('edit_speaker',["conference_id"=>$conference_id,"speaker_id"=>$aSpeaker->id])}}" class="btn btn-primary btn-block">Edit</a>
                         </div>
                         <div class="col-md-6">
                            <a href="{{route('delete_speaker',["speaker_id"=>$aSpeaker->id,"conference_id"=>$conference_id])}}" class="btn btn-primary btn-block">Delete</a></div>
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
