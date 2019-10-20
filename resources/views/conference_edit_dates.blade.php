@extends('layouts.master')
<?php $bodySize = "60" ?>
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width: 60%;">
    <h2>Important Dates</h2>
    <p>Schedule important dates for your conference!</p>

           <form action="{{route('edit_conference_dates',["conference_id"=>$conference->id])}}" method="post">
                <div class="form-group" >
                   <label for="paper_submission_deadline">Paper Submission Deadline:</label>
                   <input class = "form-control datepicker" value="{{$conference->paper_submission_deadline}}" name="paper_submission_deadline" id="paper_submission_deadline"  placeholder="Paper submission deadline"><br>
                </div>
                <div class="form-group" >
                   <label for="notification_of_acceptance_date">Notification of Acceptance Deadline:</label>
                    <input class = "form-control datepicker" value="{{$conference->notification_of_acceptance_date }}" name="notification_of_acceptance_date" id="notification_acceptance_deadline"  placeholder="Notification of acceptance deadline"><br>
                </div>
               <div class="form_group" >
                   <label for="camera_ready_paper_date">Camera Ready Paper Date:</label>
                   <input class = "form-control datepicker" value="{{$conference->camera_ready_paper_date }}" name="camera_ready_paper_date" id="camera_ready_paper_date"  placeholder="Camera Ready Paper Date"><br>
                </div>
                <div class="form-group" >
                   <label for="registration_deadline">Registration Deadline:</label>
                   <input class = "form-control datepicker" value="{{$conference->registration_deadline }}" name="registration_deadline" id="registration_deadline"  placeholder="Registration Deadline."><br>
                </div>
                <div class="form-group" >
                   <label for="conference_start_date">Conference Start Date:</label>
                   <input class = "form-control datepicker" value="{{$conference->conference_start_date }}" name="conference_start_date" id="conference_start_date"  placeholder="Conference Start Date."><br>
                </div>
                 <div class="form-group" >
                   <label for="conference_end_date">Conference End Date:</label>
                   <input class = "form-control datepicker" value="{{$conference->conference_end_date }}" name="conference_end_date" id="conference_end_date"  placeholder="Conference End Date."><br>
                </div>


                <button type = "submit" class = "btn btn-primary">Save Changes</button>
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
