@extends('layouts.master')

@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" class = "active"><a href="{{route("submissions_get",["conference_id"=>$conference_id ])}}" >Submissions</a></li>
  <li role="presentation" ><a href="{{route('submit_files',["conference_id"=>$conference_id])}}">Submit files <span class="badge"></span></a></li>
  <li role="presentation"><a href="{{route('account',["conference_id"=>$conference_id])}}">Account <span class="badge"></span></a></li>
</ul><br>
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
        </thead>
        <tbody>
            @foreach($files as $aFile)
            <tr>
                <td id="title-{{$aFile->id}}" data-url="{{route("update_abstract",["conference_id"=>$conference_id, "submission_id"=>$aFile->id])}}" data-title = "{{$aFile->paper_title}}">{{$aFile->paper_title}}</td>
                <td><a id="abstract-{{$aFile->id}}"  data-abstract="{!! $aFile->paper_abstract !!}"  onclick=showAbstract({{$aFile->id}}) class="btn btn-primary">View/Edit Abstract</a></td>
                <td>{{$aFile->created_at}}</td>
                <td>{{$aFile->scope->name}}</td>
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

      <textarea cols="30" id="modalbody" row = "5" class="modalbody" style="color:black">

      </textarea>

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
    $(".modal-footer").text('');
    $(".modal-footer").prepend("<a onclick='saveData("+id+")' class='btn btn-primary'>Save</a>");
    $(".modal-footer").prepend(' <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>');
    $(".modal-title").text($("#title-"+id).attr("data-title"));
    $(".modalbody").text($("#abstract-"+id).attr('data-abstract'));
    $("#myModal").modal("show");
     CKEDITOR.replace("modalbody");


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
