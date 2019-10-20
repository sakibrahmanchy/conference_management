@extends('layouts.master')

@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" ><a href="{{route("submissions_get",["conference_id"=>$conference_id ])}}" >Submissions</a></li>
  <li role="presentation" class = "active"><a href="{{route('submit_files',["conference_id"=>$conference_id])}}">Submit files <span class="badge"></span></a></li>
  <li role="presentation"><a href="{{route('account',["conference_id"=>$conference_id])}}">Account <span class="badge"></span></a></li>
</ul><br>
@include('includes.message-block')
<body>
<div class="container jumbotron" style = "background-color: #204d74; color: #f5f5f5; width:60%">
    <h2>Submit a paper</h2>

        <form action="{{route('submit_files',['conference_id'=>$conference_id])}}" method="post" enctype="multipart/form-data">

                <div class="form-group" >
                   <label for="paper_title">Paper title:</label>
                   <input class = "form-control" name="paper_title" id="paper_title" type="text"><br>
                </div>
                <div class="form-group {{ $errors->has('paper_abstract')?'has-error':''  }}" >
                    <label for="paper_abstract">Abstract</label>
                    <textarea class ="form-control" type="paper_abstract" name = "paper_abstract" id = "paper_abstract" row="30" col="5"></textarea>
                </div>
                <div class="form-group" >
                   <label for="file">File (only pdf):</label>
                   <input class = "form-control" name="file" id="file" type="file"><br>
                </div>

                <div class="form_group" >
                   <label for="Scope">Select a scope:</label>
                   <select name = "scope" class="form-control">
                        @foreach($scopes as $aScope)
                            <option value="{{$aScope->id}}" selected>{{$aScope->name}}</option>
                        @endforeach
                   </select><br>
                </div>

                <button type = "submit" class = "btn btn-primary">Submit file</button>
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
        CKEDITOR.replace(paper_abstract);
 });


</script>



</body>



@endsection
