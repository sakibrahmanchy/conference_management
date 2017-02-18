@extends('layouts.master')
@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" class = "active"><a href="#">Advertisements</a></li>
  <li role="presentation"><a href="{{ route('user.requests') }}">User Requests <span class="badge">{{$requests}}</span></a></li>
  <li role="presentation"><a href="{{ route('allotments') }}">Allotment Requests </a></li>
  <li role="presentation"><a href="{{ route('route.house.entry') }}">HouseEntry </a></li>
</ul>

@include('includes.message-block')
<br>
    <section class = 'row new-post'>
        <div class="col-md-6 col-md-offset-3 jumbotron" style = "background-color: #204d74; color: #f5f5f5;"  >
            <header><h3>Create a new advertisement!</h3></header>
            <form action="{{route('advertise.post')}}" method="post">
                <div class="form-group" >
                    <label for="houseNo">House to be alloted:</label>
                    <select class="form-control" name = "houseNo" required>
                       <option selected="" value = "0">Select House no. from list</option>
                       @foreach($allotmentStatus as $status)
                            <option value="{{$status->houseName}}">{{$status->houseName}}</option>
                       @endforeach
                    </select>
                    <br>
                    <label for="comments">House description:</label>
                    <textarea class = "form-control {{ $errors->has('houseDess')?'has-error':''  }}" name="comments" cols="5" placeholder="Additional comments for user advantages" ></textarea>
                    <br>
                </div>

                <button type="submit" class="btn btn-primary" >Create Post!</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"/>
            </form>
        </div>
    </section>


@endsection