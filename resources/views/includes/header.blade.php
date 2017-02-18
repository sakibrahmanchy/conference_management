<html>


<nav class="navbar navbar-default"  style = "height: 40px; background-color: #204d74; color:white" >
  <div class="container-fluid" >

 <a style="color:#ffffff" class="navbar-brand" @if(session('admin')=="true") href="{{ route('admin.panel') }}" @else href="{{ route('dashboard') }}" @endif>Housing Distribution</a>


    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
         @if(Auth::check()||session('admin')=="true")
                <li> <a style="color:#ffffff" href="{{route('getNotifications')}}" >Notifications</a></li>
               <li> <a style="color:#ffffff" href="{{ route('logout') }}" >Logout</a></li>
         @endif

      </ul>
    </div>
  </div>
</nav>
</html>