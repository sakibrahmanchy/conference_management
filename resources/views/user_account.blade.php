@extends('layouts.master')

@section('title')
    Account
@endsection

@section('content')

<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" ><a href="{{route("submissions_get",["conference_id"=>$conference_id ])}}" >Submissions</a></li>
  <li role="presentation"><a href="{{route('submit_files',["conference_id"=>$conference_id])}}">Submit files <span class="badge"></span></a></li>
  <li role="presentation"  class = "active"><a href="{{route('account',["conference_id"=>$conference_id])}}">Account <span class="badge"></span></a></li>
</ul><br>
<br>        <div class = "col-md-6 col-md-offset-3 jumbotron" style = "background-color: #204d74; color: #f5f5f5; ">
            <header class = ""><h1>Your Account</h1></header>
           @if(Storage::disk('local')->has("user-".$user->id.'.jpg'))
        <section class = "row new-post">
            <div class = "col-md-6 col-md-offset-3">
                <img src="{{ route('account.image',['filename' => "user-".$user->id . '.jpg']) }}" alt="" class="img-responsive"/>
            </div>
        </section>
    @endif
             <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">

                <br> <div class="row">
            <div class="col-md-6 form-group {{ $errors->has('email')?'has-error':''  }}" >
                <label for="email">Your email</label>
                <input readonly class ="form-control" type="text" name = "email" id = "email" value = "{{ $user->email  }}"/>
            </div>
            <div class="col-md-6 form-group {{ $errors->has('name')?'has-error':''  }}">
                <label for="name">Your Name</label>
                <input class ="form-control" type="text" name = "name" id = "name" value = "{{ $user->name  }}"/>
            </div>
        </div>
        <div class="form-group {{ $errors->has('phone')?'has-error':''  }}" >
            <label for="password">Your Password</label>
            <input class ="form-control" type="password" name = "password" id = "password" />
        </div>
         <div class="form-group {{ $errors->has('address')?'has-error':''  }}" >
            <label for="address">Address</label>
            <textarea class ="form-control" type="address" value="{{ $user->description  }}" name = "address" id = "address" row="30" col="5">{{ $user->description  }} </textarea>
        </div>
         <div class="form-group {{ $errors->has('phone')?'has-error':''  }}" >
            <label for="phone">Phone</label>
            <input class ="form-control" value="{{ $user->phone  }}" type="phone" name = "phone" id = "phone" />
        </div>
        <div class="row">
            <div class="col-md-6 form-group {{ $errors->has('twitter')?'has-error':''  }}" >
                <label for="twitter">Twitter</label>
                <div class="input-group">
                    <span style="background-color: #eee;" class="input-group-addon">twitter.com/</span>
                    <input class ="form-control" type="twitter" value="{{ $user->twitter_username  }}" name = "twitter" id = "twitter" />
                </div>
             </div>
            <div class="col-md-6 form-group {{ $errors->has('facebook')?'has-error':''  }}" >
                <label for="twitter">Facebook</label>
                <div class="input-group">
                    <span style="background-color: #eee;" class="input-group-addon">facebook.com/</span>
                    <input class ="form-control" type="facebook" value="{{ $user->facebook_username  }}" name = "facebook" id = "facebook" />
                </div>
            </div>
        </div>

                <div class = "form-group">
                    <label for="image">Image(only .jpg)</label>
                    <input type="file" name = "image" class = "form-control" id = "image"/>
                </div>
                <button type = "submit" class = "btn btn-primary">Save Account</button>
                <input type="hidden" value = "{{ Session::token() }}" name = "_token"/>
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

    CKEDITOR.replace('address');
</script>

@endsection