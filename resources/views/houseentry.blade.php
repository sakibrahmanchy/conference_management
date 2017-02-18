@extends('layouts.master')
@section('content')
<ul class="nav nav-pills col-md-offset-3" role="tablist">
  <li role="presentation" class = ""><a href="{{route('admin.panel')}}">Advertisements</a></li>
  <li role="presentation" class = ""><a href="{{route('user.requests')}}">User Requests <span class="badge">{{$requests}}</span></a></li>
  <li role="presentation"><a href="{{route('allotments')}}">Allotment Requests</a></li>
  <li role="presentation"  class = "active"><a href="{{ route('route.house.entry') }}">HouseEntry </a></li>
</ul>
<br>
@include('includes.message-block')
        <div class="col-md-6 col-md-offset-3 jumbotron" style = "background-color: #204d74; color: #f5f5f5;"  >
            <header><h3>Data entry for houses!</h3></header>
            <form action="{{route('house.entry')}}" method="post">
                <div class="form-group" >
                    <label for="houseNo">House No.:</label>
                    <input class="form-control {{ $errors->has('houseNo')?'has-error':''  }}" name="houseNo" id="houseNo"  placeholder="Unique house no. to identify the house"><br>
                    <label for="houseDescription">House description:</label>
                    <textarea class = "form-control {{ $errors->has('houseDess')?'has-error':''  }}" name="houseDescription" id="houseDescription" cols="5" placeholder="Description of the house." ></textarea>
                    <br>
                    <label for="houseType">House type:</label>
                    <select class="form-control" name = "houseType" >
                       <option selected="" value = "0">Select House Type</option>
                       <option value="Banglow">Banglow</option>
                       <option value="Quarter">Quarter</option>
                       <<option value="Mess">Mess</option>
                    </select>
                    <br>
                    <label for="houseType">House status:</label>
                    <select class="form-control" name = "houseStatus" >
                       <option selected="" value = "0">Select House Status</option>
                       <option value="free">Free</option>
                       <option value="alloted">Alloted</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" >Add House!</button>
                <input type="hidden" name="_token" value="{{ Session::token() }}"/>
            </form>
        </div>



@endsection