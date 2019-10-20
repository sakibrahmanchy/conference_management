@extends('layouts.master')






@section('content')



@include('includes.message-block')
<div class="row jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
    <div class="text-center">
        <h2>Fill up the form to get started!!</h2>
    </div>
    <div class="col-md-offset-2 col-md-8" >
       <form action="{{ route('submit_signup_post',["conference_id"=>$conference_id]) }}" method = "post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 form-group {{ $errors->has('email')?'has-error':''  }}" >
                <label for="email">Your email</label>
                <input class ="form-control" type="text" name = "email" id = "email" value = "{{ Request::old('email')  }}"/>
            </div>
            <div class="col-md-6 form-group {{ $errors->has('name')?'has-error':''  }}">
                <label for="name">Your Name</label>
                <input class ="form-control" type="text" name = "name" id = "name" value = "{{ Request::old('name')  }}"/>
            </div>
        </div>
        <div class="form-group {{ $errors->has('phone')?'has-error':''  }}" >
            <label for="password">Your Password</label>
            <input class ="form-control" type="password" name = "password" id = "password" />
        </div>
         <div class="form-group {{ $errors->has('address')?'has-error':''  }}" >
            <label for="address">Address</label>
            <textarea class ="form-control" type="address" name = "description" id = "address" row="30" col="5"></textarea>
        </div>
         <div class="form-group {{ $errors->has('phone')?'has-error':''  }}" >
            <label for="phone">Phone</label>
            <input class ="form-control" type="phone" name = "phone" id = "phone" />
        </div>
        <div class="row">


        <button type = "submit" class = "btn btn-primary">Submit</button>
        <input type="hidden" name = "_token" value = "{{ Session::token() }}"/>
      </form>
    </div>
 </div>

 <script>
 $(document).ready(function(){
        $('.datepicker').datepicker({
            orientation: "bottom",
            autoclose: true,
            format: 'yyyy/mm/dd'
        });

 });

    CKEDITOR.replace('address');
</script>

@stop