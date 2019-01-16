<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CESI BDE</title>

  <link href="/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/sticky-footer-navbar.css" rel="stylesheet">
</head>

<body>
  <header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
      <a class="navbar-brand" href="{{ url('welcome') }}">Home</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="{{ url('idea_box') }}">Idea-box </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('activities') }}">Activities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('shop') }}">Shop</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('shop') }}">Contact</a>
          </li>
          <!--<li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>-->
        </ul>
      </div>
    </nav>
  </header>
  <body>


    @yield ('content')


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
