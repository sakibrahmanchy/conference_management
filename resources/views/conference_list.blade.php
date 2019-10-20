@extends('layouts.master')
@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" ><a href="">Dashboard</a></li>
  <li role="presentation" class = "active"><a href="{{route('get_conferences')}}">Conferences <span class="badge"></span></a></li>
   <li role="presentation"><a href="{{route('account')}}">Account <span class="badge"></span></a></li>
</ul>
<br>
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
    <h2>Conference List</h2>
    <p>Manage your conferences!</p>
    <br><a style="float:right" class="btn btn-success" href="{{route('create_conference')}}" target="_blank">New Conference</a><br><br><br>
    @foreach($conferenceList as $aConference)

            <div class="col-md-4">
                <div class="thumbnail">
                    <img src=" {{ route('speaker_image',['conference_id'=>$aConference->id,'filename' => 'conference-cover-'.$aConference->id.'.jpg']) }}  " alt="ALT NAME" class="img-responsive" />
                    <div class="caption">
                         <h3>{{$aConference->title}}</h3>
                        <p>Conference_url: <a target="_blank" href="{{ route("conference_home",["conference_url"=>$aConference->conference_url]) }}">{{$aConference->conference_url}}</a></p>
                         <div class="row">
                         <div class="col-md-6">
                            <a href="{{route('edit_conference',["conference_id"=>$aConference->id])}}" class="btn btn-primary btn-block">Edit</a>
                         </div>
                         <div class="col-md-6">
                            <a href="http://bootsnipp.com/" class="btn btn-primary btn-block">Delete</a></div>
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
