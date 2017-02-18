@extends('layouts.master')






@section('content')

<div class = "jumbotron">
<h1>Welcome to cuet housing distribution system!!</h1>.<p class = "alert alert-warning"> This system only accepts verified users. Please fill up the form and wait
until admin verifies you.<br> Thank you!</p>
</div>


@include('includes.message-block')
<div class="row">
    <div class="col-md-6">
      <form action="{{ route('userinfoupdate') }}" method = "post" enctype="multipart/form-data">
        <h3>Verification</h3>
        <div class = "form-group" >
            <label for="image">Photo(only .jpg)</label>
            <label for="image" style = "color:red">**Please include a formal passport size photo. Otherwise the ID will be rejected.</label>
            <input type="file" name = "image" class = "form-control" id  = "image"/>
        </div> 
        <div class="form-group {{ $errors->has('presentDesignation')?'has-error':''  }}" >
            <label for="presentDesignation">Present Designation</label>
            <select class = "form-control" name="presentDesignation" id = "presentDesignation">
                <option selected="selected" value = "0">Select</option>
                <option value="Professor">Professor</option>
                <option value="Assistant Professor">Asst. Professor</option>
                <option value="Lecturer">Lecturer</option>
                <option value="Staff">Staff</option>
            </select>
        </div>
        <div class="form-group {{ $errors->has('pdJoiningDate')?'has-error':''  }}">
            <label for="pdJoiningDate">Joining date in this designation</label>
            <input class ="form-control" type="date" name = "pdJoiningDate" id = "pdJoiningDate" />
        </div>
        <div class="form-group {{ $errors->has('joiningTime')?'has-error':''  }}" >
            <label for="joiningTime">Joining Time</label>
            <select class = "form-control" name="joiningTime" id = "joiningTime">
                <option selected="" value = "0">Select(am/pm)</option>
                <option value="am">am</option>
                <option value="pm">pm</option>
            </select>
        </div>
        <div class="form-group {{ $errors->has('payScale')?'has-error':''  }}" >
            <label for="payScale">Pay Scale</label>
            <select class = "form-control" name="payScale" id = "payScale">
                <option selected="selected" value = "0">Select(1-7)</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
            </select>
        </div>
        <div class="form-group {{ $errors->has('firstDesignation')?'has-error':''  }}" >
            <label for="firstDesignation">First Designation</label>
              <select class = "form-control" name="firstDesignation" id = "firstDesignation">
                <option selected="selected" value = "0">Select</option>
                <option value="Professor">Professor</option>
                <option value="Assistant Professor">Asst. Professor</option>
                <option value="Lecturer">Lecturer</option>
                <option value="Staff">Staff</option>
            </select>
        </div>
        <div class="form-group {{ $errors->has('firstJoiningDate')?'has-error':''  }}" >
            <label for="firstJoiningDate">First Joining Date</label>
            <input class ="form-control" type="date" name = "firstJoiningDate" id = "firstJoiningDate" />
        </div>
        <div class="form-group {{ $errors->has('maritalStatus')?'has-error':''  }}" >
            <label for="maritalStatus">Marital Status</label>
             <select class = "form-control" name="maritalStatus" id = "maritalStatus">
                <option selected="" value = "0">Select Status</option>
                <option value="Married">Married</option>
                <option value="Unmarried">Unmarried</option>
                <option value="Divorced">Divorced</option>
            </select>
        </div>
        <div class="form-group {{ $errors->has('department')?'has-error':''  }}" >
            <label for="department">Department</label>
            <input class ="form-control" type="text" name = "department" id = "department" />
        </div>
        <div class="form-group {{ $errors->has('phone')?'has-error':''  }}" >
            <label for="phone">Phone</label>
            <input class ="form-control" type="text" name = "phone" id = "phone" />
        </div>
        <button type = "submit" class = "btn btn-info">Verify</button>
        <input type="hidden" name = "_token" value = "{{ Session::token() }}"/>
      </form>
    </div>
 </div>
@stop