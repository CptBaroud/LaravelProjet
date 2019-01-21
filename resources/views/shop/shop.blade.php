@extends('template')

@section('content')
<div id="contenu">

  <div id="wrapper"></div>
  <div id="barre_boutons_admin">
    <p>
      <br>
    </p>
    <a href='/shop/create'>
      <div class="bouton_admin">
      Ajouter un article </div>
    </a>
  </div>
</div>
<div class="container">

  <div class="row">

    <div class="col-lg-3">

      <h1 class="my-4">Shop</h1>
      @foreach($category as $key => $category)
      <div class="list-group">
        <a href="shop\category\{{ $category->id_category}}" class="list-group-item">{{$category->category_name}}</a>
      </div>
      @endforeach
    </div>
    <div class="col-lg-9">

      <div id="carouselExampleIndicators" class="carousel slide my-4" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
            <img class="d-block img-fluid" src= "http://placehold.it/900x350"" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="http://placehold.it/900x350" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="row">
        @foreach($data as $key => $data)



        <div class="col-lg-4 col-md-6 mb-4">
          <div class="card h-100">
            <a href="shop\achat\{{ $data->id_product}}"><img class="card-img-top" src= "images/{{$data->url_image}}" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="shop\achat\{{ $data->id_product}}">images/{{$data->url_image}} {{$data->product_name}}</a>
              </h4>
              <h5>{{$data->price}} €</h5>
              <p class="card-text">{{$data->product_description}}</p>
              <div class="btn-group">
                <a href="shop\delete\{{ $data->id_product}}"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
                <a href="shop\edit\{{ $data->id_product}}"> <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
              </div>
            </div>
            <div class="card-footer">
              <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
            </div>
          </div>
        </div>


        <!-- /.row -->
        @endforeach
      </div>
    </div>
    <!-- /.col-lg-9 -->

  </div>
  <!-- /.row -->

</div>





@endsection