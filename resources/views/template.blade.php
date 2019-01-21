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


</head>

<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top dark">
    <a class="navbar-brand" href="{{ url('/') }}">BDE CESI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">

        <?php $Actualpage= $_SERVER['PHP_SELF'];


            echo("<li class='nav-item ");

            if($Actualpage == '/index.php'){
              echo 'active';
            }

            echo("'>
              <a class='nav-link' href='/'> Home </a>
              </li>
              <li class='nav-item ");

              if($Actualpage == '/index.php/idea_box' || $Actualpage == '/index.php/idea_box/create'){
                echo 'active';
              }

              echo ("'>
              <a class='nav-link' href='idea_box'>Idea-box </a>
              </li>
              <li class='nav-item ");

              if($Actualpage == '/index.php/activities'){
                echo 'active';
              }

              echo ("'>
              <a class='nav-link' href='activities'>Activities</a>
              </li>
              <li class='nav-item ");

              if($Actualpage == '/index.php/shop'){
                echo 'active';
              }

              echo ("'>
              <a class='nav-link' href='shop'> Shop </a>
              </li>
              </ul>");


              if(isset(Auth::user()->email)) {

                if(isset(Auth::user()->permissions)) {
                  $permissions = Auth::user()->permissions;
                  if($permissions == 1){
                    echo ("<ul class='navbar-nav '><li class='nav-item ");
                    if($Actualpage == '/index.php/admin'){
                      echo 'active';
                    }
                    echo ("'>
                    <a class='nav-link' href='admin'>Page Admin</a>
                    </li>");
                  }
                } else {

                  echo "<ul class='navbar-nav '>";

                }

                echo ("
                <li class='nav-item'>
                <a class='nav-link' href='log_out'>Log out</a>
                </li>");

              } else {

                echo ("<ul class='navbar-nav '>
                <li class='nav-item ");

                if($Actualpage == '/index.php/connection'){
                  echo 'active';
                }

                echo ("'>
                <a class='nav-link' href='connection'>Connection</a>
                </li>
                <li class='nav-item ");
                if($Actualpage == '/index.php/register'){
                  echo 'active';
                }

                echo ("'>
                <a class='nav-link' href='register'>Register</a>
                </li>
                </ul>");

              }

  ?>

</div>
</nav>
</header>


<body>
    @yield('content')

</body>

<footer class="footer">
    <div class="container">
      <span class="text-muted">© 2019 Exia Cesi A2 Groupe 2</span>
  </div>
</footer>

<script src="js/popper.min.js"></script>
<script src="/js/bootstrap.min.js"></script>

</body>
</html>
