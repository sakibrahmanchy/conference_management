@extends('layouts.master')

@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" class="active"><a href="{{route("reviewer_dashboard")}}" >Dashboard</a></li>
  {{--<li role="presentation" ><a href="--}}{{--{{route('submit_files',["conference_id"=>$conference_id])}}--}}{{--">Submit files <span class="badge"></span></a></li>--}}
  <li role="presentation"><a href="{{route('account')}}">Account <span class="badge"></span></a></li>
</ul><br>
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5;">
    <h2>Uploaded files</h2>

    <table class="table table-responsive card">
        <thead>
            <th>Paper Title</th>
            <th>Paper Abstract</th>
            <th>Scope</th>
            <th>Status</th>
            <th>Uploaded at</th>
            <th>Download Paper</th>
            <th>Review paper</th>
        </thead>
        <tbody>
            @foreach($files as $aFile)
            <tr>
                <td id="title-{{$aFile->file_unique_id}}" @if(isset($aFile->score)&&!is_null($aFile->score)) data-score = "{{ $aFile->score }}" data-note = "{{ $aFile->review_note }}"  @endif data-url="{{route("update_abstract",["conference_id"=>$conference_id, "submission_id"=>$aFile->file_unique_id])}}" data-title = "{{$aFile->paper_title}}">{{$aFile->paper_title}}</td>
                <td><a id="abstract-{{$aFile->file_unique_id}}"  data-abstract="{!! $aFile->paper_abstract !!}"  onclick=showAbstract({{$aFile->file_unique_id}}) class="btn btn-primary">View Abstract</a></td>
                <td>{{$aFile->name}}</td>
                <td>
                      @if($aFile->status==0)
                        <span class="label label-primary">Submitted for review</span>
                      @elseif($aFile->status==1)
                         <span class="label label-warning">Under Review</span>
                      @elseif($aFile->status==2)
                           <span class="label label-success">Accepted</span>
                      @else
                           <span class="label label-danger">Rejected</span>
                      @endif
                </td>
                <td>{{$aFile->created_at}}</td>
                <td><a href="{{route('download_file',["conference_id"=>$conference_id,"file_name"=>$aFile->file_name])}}" class="btn btn-primary">Download</a></td>
                <td><a href="#reviewModal"  onclick="showReviewModal({{ $aFile->file_unique_id  }})" class="btn btn-primary">Review</a></td>
            </tr>
            @endforeach
        </tbody>

    </table>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:black"></h4>
      </div>

      <div id="modalbody" row = "5" class="modalbody" style="color:black;padding:15px">

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>

<!-- Modal -->
<div id="reviewModal" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:black">Review Paper</h4>
      </div>
      <div class="form-group" style="padding:10px">
          <div class="alert" id="message"></div>
          <label for="score">Score (Out of 30)</label>
          <input type="text" name="score" id="score" class="form-control" placeholder="Score (Out of 30)"/><br>
           <label for="reviewNote">Review Note</label>
          <textarea id="reviewNote" row = "5" cols="30" class="modalbody" style="color:black;padding:15px">

          </textarea>
          <input type="hidden" id="file_id" value="">
       </div>
      <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="saveReview()" >Save Review</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>



<script>

function showAbstract(id){

    submission_id = id;
    var url = $("#title"+id).attr("data-url");
    $(".modal-title").text($("#title-"+id).attr("data-title"));
    $(".modalbody").html($("#abstract-"+id).attr('data-abstract'));
    $("#myModal").modal("show");

}

function showReviewModal(id){

    $("#score").val($("#title-"+id).attr("data-score"));
    $(".modalbody").html($("#title-"+id).attr('data-note'));
     CKEDITOR.replace('reviewNote');
    $("#file_id").val(id);
    $("#reviewModal").modal("show");
}

function saveReview(){

    var file_id = $("#file_id").val();
    var score = $("#score").val();
    var note = CKEDITOR.instances.reviewNote.getData();

    $.ajax({
    type: "POST",
    url: "{{ route('save_review') }}",
    data: {
        file_id: file_id,
        score: score,
        note: note
    }
    }).done(function(response){
            if(response.error){
                $("#message").hide();
                $("#message").removeClass('alert-success').addClass("alert-danger");
                $("#message").html(response.message);
                $("#message").fadeIn();

            }else if(response.success){
                $("#message").hide();
                $("#message").removeClass('alert-danger').addClass("alert-success");
                $("#message").html(response.message);
                $("#message").fadeIn().delay(400);
                location.reload();
            }

           // $("#message").html(response);
    });

}



 $(document).ready(function(){

        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
         });
        $('.datepicker').datepicker({
            orientation: "bottom",
            autoclose: true,
            format: 'yyyy/mm/dd'
        });



 });


</script>



</body>



@endsection
