
  @if(count($errors)>0)
        <br>
        <div class="row">
            <div class="col-md-6  col-md-offset-3">
                <ul class = "alert alert-danger alert-dismissible" role="alert">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    @foreach($errors->all() as $error)
                       {{ $error }} <br>
                    @endforeach
                </ul>
            </div>
        </div>
  @endif
  @if(Session::has('message'))
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="alert alert-success alert-dismissible" role="alert">
                {{Session::get('message')}}
                </div>
            </div>
        </div>
  @endif
  @if(Session::has('errormessage'))
        <br>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="alert alert-danger alert-dismissible" role="alert">
                {{Session::get('errormessage')}}
                </div>
            </div>
        </div>
  @endif
