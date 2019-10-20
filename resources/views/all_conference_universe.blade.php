@extends('layouts.master')
@section('content')

@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
    <h2>Conference List</h2>

    @foreach($conferenceList as $aConference)

            <div class="col-md-4">
                <div class="thumbnail">
                    <img height="50px" src=" {{ route('speaker_image',['conference_id'=>$aConference->id,'filename' => 'conference-cover-'.$aConference->id.'.jpg']) }}  " alt="ALT NAME" class="img-responsive" />
                    <div class="caption">
                         <h3>{{$aConference->title}}</h3>
                        <p>Conference_url: <a target="_blank" href="{{ route("conference_home",["conference_url"=>$aConference->conference_url]) }}">{{$aConference->conference_url}}</a></p></p>
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
