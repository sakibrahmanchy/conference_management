@extends('layouts.master')

@section('content')
@include('includes.conference_edit_header')
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5;">
    <h2>Uploaded files</h2>

    <table class="table table-responsive card">
        <thead>
            <th>Paper Title</th>
            <th>Reviewed By</th>
            <th>Review Note</th>
            <th>Scope</th>
            <th>Status</th>
            <th>Uploaded at</th>
            <th>Actions</th>
          @php
              $index = 0;
          @endphp
        </thead>
        <tbody>
            @foreach($files as $aFile)
            <tr>
                <td id="title-{{$aFile->file_id}}{{$index}}" @if(isset($aFile->score)&&!is_null($aFile->score)) data-score = "{{ $aFile->score }}" data-note = "{{ $aFile->review_note }}"  @endif data-url="{{route("update_abstract",["conference_id"=>$conference_id, "submission_id"=>$aFile->file_id])}}" data-title = "{{$aFile->paper_title}}">{{$aFile->paper_title}}</td>
                <td>{{$aFile->reviewer_name}}</td>
                <td><a id="abstract-{{$aFile->file_id}}{{$index}}"  data-abstract="{!! $aFile->paper_abstract !!}"  onclick=showAbstract({{$aFile->file_id}}{{$index}}) class="btn btn-primary">View Abstract</a></td>
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
               <td>
                    <div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="{{route('download_file',["conference_id"=>$conference_id,"file_name"=>$aFile->file_name])}}">Download</a></li>
                        <li><a href="#reviewModal"  onclick="showReviewModal({{ $aFile->file_id  }}{{$index}})" >Review</a></li>
                        <li><a href="#">JavaScript</a></li>
                      </ul>
                    </div>
               </td>
            </tr>
            @php $index++; @endphp
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
          <input type="text" name="score" id="score" class="form-control" placeholder="Score (Out of 30)" disabled/><br>
           <label for="reviewNote">Review Note</label>
          <div id="reviewNote" row = "5" cols="30" class="modalbody" style="color:black;padding:15px">

          </div>
          <input type="hidden" id="file_id" value="">
       </div>
      <div class="modal-footer">

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
    // CKEDITOR.replace('reviewNote');
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
