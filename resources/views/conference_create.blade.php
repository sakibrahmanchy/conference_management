@extends('layouts.master')
@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" ><a href="">Dashboard</a></li>
  <li role="presentation" class = "active" ><a href="{{route('get_conferences')}}">Conferences <span class="badge"></span></a></li>

</ul>
<br>
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width:60%;">
    <h2>New Conference</h2>
    <p>Create your conference!</p>
    <form action="{{route('create_conference')}}" method="post">
                <div class="form-group" >
                   <label for="title">Title (Must be at least of two words):</label>
                   <input class = "form-control" name="title" id="title" value="{{old('title')}}" placeholder="Conference Title."><br>
                </div>
                <div class="form-group" >
                   <label for="venue">Venue:</label>
                   <textarea class = "form-control" name="venue" id="venue" value="{{old('venue')}}" col="2" row="30"  placeholder="Conference venue."></textarea><br>
                </div>
                <div class="form-group" >
                   <label for="paper_submission_deadline">Paper Submission Deadline:</label>
                   <input class = "form-control datepicker" name="paper_submission_deadline" value="{{old('paper_submission_deadline')}}" id="paper_submission_deadline"  placeholder="Paper submission deadline"><br>
                </div>
                <div class="form-group" >
                   <label for="notification_acceptance_deadline">Notification of Acceptance Deadline:</label>
                    <input class = "form-control datepicker" name="notification_acceptance_deadline" id="notification_acceptance_deadline"  placeholder="Notification of acceptance deadline"><br>
                </div>
                <div class="form_group" >
                   <label for="camera_ready_paper_date">Camera Ready Paper Date:</label>
                   <input class = "form-control datepicker" name="camera_ready_paper_date" id="camera_ready_paper_date"  placeholder="Camera Ready Paper Date"><br>
                </div>
                <div class="form-group" >
                   <label for="registration_deadline">Registration Deadline:</label>
                   <input class = "form-control datepicker" name="registration_deadline" id="registration_deadline"  placeholder="Registration Deadline."><br>
                </div>
                <div class="form-group" >
                   <label for="conference_start_date">Conference Start Date:</label>
                   <input class = "form-control datepicker" name="conference_start_date" id="conference_start_date"  placeholder="Conference Start Date."><br>
                </div>
                 <div class="form-group" >
                   <label for="conference_end_date">Conference End Date:</label>
                   <input class = "form-control datepicker" name="conference_end_date" id="conference_end_date"  placeholder="Conference End Date."><br>
                </div>

                <input type ="hidden" name ="user_status">

                <button type = "submit" class = "btn btn-primary">Create Conference</button>
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
