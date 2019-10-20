
  <div class="col-md-6">
      <form action="{{ route('signup') }}" method = "post">
        <h3>Sign up to create and manage conference</h3>
        <div class="form-group {{ $errors->has('id')?'has-error':''  }}" >
            <label for="id">Your email</label>
            <input class ="form-control" type="text" name = "id" id = "id" value = "{{ Request::old('id')  }}"/>
        </div>
        <div class="form-group {{ $errors->has('name')?'has-error':''  }}">
            <label for="name">Your Name</label>
            <input class ="form-control" type="text" name = "name" id = "name" value = "{{ Request::old('name')  }}"/>
        </div>
        <div class="form-group {{ $errors->has('password')?'has-error':''  }}" >
            <label for="password">Your Password</label>
            <input class ="form-control" type="password" name = "password" id = "password" />
        </div>
        <button type = "submit" class = "btn btn-primary">Submit</button>
        <input type="hidden" name = "_token" value = "{{ Session::token() }}"/>
      </form>
    </div>