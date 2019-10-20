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
            <th>Paper Abstract</th>
            <th>Uploaded at</th>
            <th>Scope</th>
            <th>Status</th>
            <th>Average</th>
            <th>Actions</th>
        </thead>
        <tbody>
            @foreach($files as $aFile)
            <tr>
                <td id="title-{{$aFile->file_unique_id}}" data-url="{{route("update_abstract",["conference_id"=>$conference_id, "submission_id"=>$aFile->file_unique_id])}}" data-title = "{{$aFile->paper_title}}">{{$aFile->paper_title}}</td>
                <td><a id="abstract-{{$aFile->file_unique_id}}"  data-abstract="{!! $aFile->paper_abstract !!}"  onclick=showAbstract({{$aFile->file_unique_id}}) class="btn btn-primary">View/Edit Abstract</a></td>
                <td>{{$aFile->created_at}}</td>
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
                <td>{{ number_format((float)$aFile->average, 2, '.', '')}}</td>
                <td><div class="dropdown">
                      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                      <span class="caret"></span></button>
                      <ul class="dropdown-menu">
                        <li><a href="{{route('download_file',["conference_id"=>$conference_id,"file_name"=>$aFile->file_name])}}">Download</a></li>

                            <li><a href="{{route('accept_submission',["conference_id"=>$conference_id,"submission_id"=>$aFile->file_unique_id])}}">Accept</a></li>
                            <li><a href="{{route('reject_submission',["conference_id"=>$conference_id,"submission_id"=>$aFile->file_unique_id])}}">Reject</a></li>

                      </ul>
                    </div></td>
            </tr>
            @endforeach
        </tbody>

    </table>

<script>
  var submission_id;
</script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" >
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:black"></h4>
      </div>

      <div disabled cols="30" id="modalbody" row = "5" class="modalbody" style="color:black; padding:10px">

      </div>

      <div class="modal-footer" >

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
    $(".modal-footer").text('');
    $(".modal-footer").prepend(' <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    $(".modal-title").text($("#title-"+id).attr("data-title"));
    $(".modalbody").html($("#abstract-"+id).attr('data-abstract'));
    $("#myModal").modal("show");



}


function saveData(id){

    var abstract =  CKEDITOR.instances.modalbody.getData();
    console.log(abstract);
    $.ajax({
        url: "http://localhost/conf-master/public/conference/<?php echo $conference_id ?>/submit_paper/update/abstract/"+id,
        type: "POST",

        data: {
        paper_abstract : abstract
        }
        }).done(function(response) {
            location.reload();
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
