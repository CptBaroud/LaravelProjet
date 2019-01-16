<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CESI BDE</title>

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/sticky-footer-navbar.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<header>
  <!-- Fixed navbar -->
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{ url('/') }}">BDE CESI</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
      <ul class="navbar-nav mr-auto">

        <?php $Actualpage= $_SERVER['PHP_SELF']; 
        if($Actualpage == '/index.php'){

          echo("<li class='nav-item active'>
            <a class='nav-link' href='/'> Home </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='idea_box'>Idea-box </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='activities'>Activities</a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='shop'>Shop</a>
            </li>
            </ul>

            <ul class='navbar-nav '>
            <li class='nav-item'>
            <a class='nav-link' href='connection'>Connection</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' href='register'>Register</a>
            </li>
            </ul>");
        }

        else if($Actualpage == '/index.php/idea_box'){
          echo("<li class='nav-item'>
            <a class='nav-link' href='/'> Home </a>
            </li>
            <li class='nav-item active'>
            <a class='nav-link' href='idea_box'>Idea-box </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='activities'>Activities</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' href='shop'>Shop</a>
            </li>
            </ul>

            <ul class='navbar-nav '>
            <li class='nav-item'>
            <a class='nav-link' href='connection'>Connection</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' href='register'>Register</a>
            </li>
            </ul>");

        }
        else if($Actualpage == '/index.php/shop'){
          echo("<li class='nav-item '>
            <a class='nav-link' href='/'> Home </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='idea_box'>Idea-box </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='activities'>Activities</a>
            </li>
            <li class='nav-item active'>
            <a class='nav-link' href='shop'>Shop</a>
            </li>
            </ul>

            <ul class='navbar-nav '>
            <li class='nav-item'>
            <a class='nav-link' href='connection'>Connection</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' href='register'>Register</a>
            </li>
            </ul>");

        }
        else if($Actualpage == '/index.php/activities'){
          echo("<li class='nav-item '>
            <a class='nav-link' href='/'> Home </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='idea_box'>Idea-box </a>
            </li>
            <li class='nav-item active'>
            <a class='nav-link' href='activities'>Activities</a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='shop'>Shop</a>
            </li>
            </ul>


            <ul class='navbar-nav '>
            <li class='nav-item'>
            <a class='nav-link' href='connection'>Connection</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' href='register'>Register</a>
            </li>
            </ul>");
        }
        else if($Actualpage == '/index.php/register'){
          echo("<li class='nav-item'>
            <a class='nav-link' href='/'> Home </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='idea_box'>Idea-box </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='activities'>Activities</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' href='shop'>Shop</a>
            </li>
            </ul>

            <ul class='navbar-nav '>
            <li class='nav-item'>
            <a class='nav-link' href='connection'>Connection</a>
            </li>
            <li class='nav-item active'>
            <a class='nav-link' href='register'>Register</a>
            </li>
            </ul>");

        }
        else if($Actualpage == '/index.php/connection'){
          echo("<li class='nav-item'>
            <a class='nav-link' href='/'> Home </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='idea_box'>Idea-box </a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='activities'>Activities</a>
            </li>
            <li class='nav-item'>
            <a class='nav-link' href='shop'>Shop</a>
            </li>
            </ul>

            <ul class='navbar-nav '>
            <li class='nav-item active'>
            <a class='nav-link' href='connection'>Connection</a>
            </li>
            <li class='nav-item '>
            <a class='nav-link' href='register'>Register</a>
            </li>
            </ul>");

        }
        ?>



      </div>
    </nav>
  </header>


  <body>

    <br>
    <br>
    <br>

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
