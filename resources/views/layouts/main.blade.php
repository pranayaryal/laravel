<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Pranay Aryal | A Laravel Application</title>
        <link rel="stylesheet" href="{{ asset('css/foundation.css')}}" />
        <script src="{{asset('js/vendor/modernizr.js') }}"></script>
    </head>

<body>

    <!-- Header and Nav -->
 
    <nav class="top-bar" data-topbar>
        <ul class="title-area">
            <li class="name">
                <h1><a href="/todos">PRANAY ARYAL</a></h1>
            </li>
        </ul>
    </nav>
 
    <!-- End Header and Nav -->

    <!-- Adding a success message -->
    @if(Session::has('message'))
        <div class="alert-box succes">
            {{{Session::get('message')}}}
        </div>
    @endif


    <div class="row">
        <div class="large-12">
            @yield('content')
        </div>
    </div>
 
 
    <!-- Footer -->
 
    <footer class="row">
        <div class="large-12 columns">
            <hr />
            <div class="row">
                <div class="large-6 columns">
                    <p>© 2015 Pranay Aryal</p>
                </div>
            </div>
        </div>
    </footer>

    <script src='js/vendor/jquery.js'></script>
    <script src="js/foundation.min.js"></script>

    <script src="js/app.js"></script>
    <script>
      $(document).foundation();
    </script>
    </body>
</html>