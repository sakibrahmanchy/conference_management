<!DOCTYPE html>
<html>
    <head>
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
      {{--  <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}
        <link rel="stylesheet" href="{{ asset('bootstrap-3.3.7-dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('src/css/main.css') }}"/>
        <link rel="stylesheet" href="{{ asset('src/css/sweetalert.css') }}"/>
        <link rel="stylesheet" href="{{asset('src/css/navbar-fixed-side.css')}} " />
        <script src="{{ URL::to('jquery/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ URL::to('bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>

        <style>

          .modal-dialog {
           margin-top: 10%;
          }
        </style>
        <script type="text/javascript">

  </script>

    </head>
    <div id = "container">
        <div id = "header">
            @include('includes.header')
        </div>
        <body>
            <div class="container">
                <div class="content">
                <div class="title">@yield('content')</div>
                </div>
            </div>



                <script src="{{ URL::to('src/js/app.js') }}"></script>
                <script src="src/js/sweetalert.min.js"></script>

                <br>
                 <script>
                      @if(notify()->ready())
                        swal({
                            title:"{{notify()->message()}}",
                            type:"{{notify()->type()}}"
                        });
                      @endif
                </script>
        </body>
        <div id = "footer">
            @include('includes.footer')
        </div>
   </div>
</html>
