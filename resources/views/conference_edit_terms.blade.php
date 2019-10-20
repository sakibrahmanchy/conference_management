@extends('layouts.master')
@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5;">
    <h2>Important Terms</h2>
    <p>Customize important terms for your conference!</p>

           <form action="{{route('edit_conference_terms',["conference_id"=>$conference->id])}}" method="post">

                <div class="form-group" >
                   <label for="submission_guideline">Submission Guideline:</label>
                   <textarea class = "form-control" name="submission_guideline" id="submission_guideline" col="2" row="30"  >{{$conference->submission_guideline}}</textarea><br>
                </div>
                <div class="form-group" >
                   <label for="plagiarism_policy">Plagiarism Policy</label>
                   <textarea class = "form-control" name="plagiarism_policy" id="plagiarism_policy" col="2" row="30"  >{{$conference->plagiarism_policy}}</textarea><br>
                </div>
                <div class="form-group" >
                   <label for="review_policy">Review Policy:</label>
                   <textarea class = "form-control" name="review_policy" id="review_policy" col="2" row="30"  >{{$conference->review_policy}}</textarea><br>
                </div>
                <div class="form-group" >
                   <label for="best_paper_award">Best Paper <Award></Award>:</label>
                   <textarea class = "form-control" name="best_paper_award" id="best_paper_award" col="2" row="30"  >{{$conference->best_paper_award}}</textarea><br>
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

        CKEDITOR.replace('submission_guideline');
        CKEDITOR.replace('plagiarism_policy');
        CKEDITOR.replace('review_policy');
        CKEDITOR.replace('best_paper_award');

 });


</script>



</body>





@endsection
