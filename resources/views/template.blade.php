<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>CESI BDE</title>
    {!! Html::style('css/bootstrap.min.css') !!}
    {!! Html::style('css/sticky-footer-navbar.css') !!}
    {!! Html::style('css/style.css') !!}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">


</head>

<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top dark">
        <a class="navbar-brand text-light" href="{{ url('/') }}">BDE CESI</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse"
        aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">

            <?php $Actualpage = $_SERVER['PHP_SELF'];

            echo("<li class='nav-item ");

            if ($Actualpage === '/index.php') {
                echo 'active';
            }

            echo("'>
              <a class='nav-link text-warning' href='/'> Home </a>
              </li>
              <li class='nav-item ");

            if ($Actualpage === '/index.php/idea_box' || $Actualpage === '/index.php/idea_box/create') {
                echo 'active';
            }

            echo("'>
              <a class='nav-link text-warning' href='/idea_box'>Idea-box </a>
              </li>
              <li class='nav-item ");

            if ($Actualpage === '/index.php/activities') {
                echo 'active';
            }

            echo("'>
              <a class='nav-link text-warning' href='/activities'>Activities</a>
              </li>
              <li class='nav-item ");

            if ($Actualpage === '/index.php/shop') {
                echo 'active';
            }

            echo("'>
              <a class='nav-link text-warning' href='/shop'> Shop </a>
              </li>
              </ul>");

            if (isset(Auth::user()->email)) {

                if (isset(Auth::user()->permissions)) {
                    $permissions = Auth::user()->permissions;
                    if ($permissions === 1) {
                        echo("<ul class='navbar-nav '><li class='nav-item ");
                        if ($Actualpage === '/index.php/admin') {
                            echo 'active';
                        }
                        echo("'>
                            <a class='nav-link text-warning' href='/admin'>Page Admin</a>
                            </li>");
                    }
                } else {

                    echo "<ul class='navbar-nav '>";

                }

                echo("<ul class='navbar-nav '>
                    <li class='nav-item'>
                    <a class='nav-link text-warning' href='/log_out'>Log out</a>
                    </li>
                    <li class='nav-item'>
                    <a class='nav-link text-warning' href='/basket'>Basket</a>
                    </li>");


            } else {


                echo("<ul class='navbar-nav '>
                    <li class='nav-item ");
                if ($Actualpage === '/index.php/connection') {
                    echo 'active';
                }
                echo("'>
                    <a class='nav-link text-warning' href='/connection'>Connection</a>
                    </li>
                    <li class='nav-item ");
                if ($Actualpage === '/index.php/register') {
                    echo 'active';
                }

                echo("'>
                    <a class='nav-link text-warning' href='/register'>Register</a>
                    </li>");
            }

            ?>
            @if(isset(Auth::user()->email))
            @if(count(Auth()->user()->unreadNotifications) > 0)
            <li class='dropdown' id="markasread"
            onclick="markNotificationAsRead('{{count(Auth()->user()->unreadNotifications)}}')">
            <a class='nav-link dropdown-toggle' data-toggle='dropdown' role='button'
            aria-expanded='false'>
            <span class='glyphicon glyphicon-globe'></span> Notifications <span
            style='text-color :white' class='badge'>
            <?php echo(count(Auth()->user()->unreadNotifications))?> </span>
            <ul class='dropdown-menu' role='menu'>
                <li>
                  @foreach(auth()->user()->unreadNotifications as $Notification)

                  @include('notification.'.snake_case(class_basename($Notification->type)))

                  @endforeach
              </li>
          </ul>
      </li>
      @endif
      @endif

  </ul>
</div>
</nav>
</header>


<body>
    @yield('content')
</body>

<footer class="page-footer font-small stylish-color-dark pt-4">

    <!-- Footer Links -->
    <div class="container text-center text-md-left">

        <!-- Grid row -->
        <div class="row">

            <!-- Grid column -->
            <div class="col-md-4 mx-auto">

                <!-- Content -->
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4 text-warning">Info</h5>
                <p class="text-light">You're actually on the website of the Group 2 for the web project</p>

            </div>
            <!-- Grid column -->

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <div class="col-md-2 mx-auto">

                <!-- Links -->
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4 text-warning">Features</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="/activities" class="font-weight-light text-light">Activities</a>
                    </li>
                    <li>
                        <a href="/shop" class="font-weight-light text-light">Shop</a>
                    </li>
                    <li>
                        <a href="/idea_box" class="font-weight-light text-light">IdeaBox</a>
                    </li>
                    <li>
                        <a href="/" class="font-weight-light text-light">Home</a>
                    </li>
                </ul>

            </div>

            <hr class="clearfix w-100 d-md-none">

            <!-- Grid column -->
            <div class="col-md-2 mx-auto">

                <!-- Links -->
                <h5 class="font-weight-bold text-uppercase mt-3 mb-4 text-warning">Legal</h5>

                <ul class="list-unstyled">
                    <li>
                        <a href="/legalmention" class="font-weight-light text-light">Legal mention</a>
                    </li>
                </ul>

            </div>
        </div>
        <!-- Footer Links -->
        <!-- Copyright -->
        <div class="footer-copyright text-center py-3 text-muted bottom">
            © 2018 Copyright : Group 2 Gurvan / Julien / François / Benjamin
        </div>
        <!-- Copyright -->
    </div>
</footer>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
crossorigin="anonymous"></script>
<script src="{{asset('js/main.js')}}"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

@yield('script')
</html>
