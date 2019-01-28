@extends('template')

@section('content')
<div>

  <section class="jumbotron text-center">
    <div class="container">
      <h1 class="jumbotron-heading">Shop</h1>
      <p class="lead text-muted">In this section, you'll be able to see all the different product that has been proposed to our students.</p>
    </div>
    <a href= '/shop/create'> <button type="button" class="btn btn-dark">Add a product</button></a>
    <p><br></p>
    <div class="form-group" my-2 my-lg-0>
      <input type="text" name="product_name" id="product_name" class="form-control input-lg" placeholder="Enter a product" />
      <div id="productList">
      </div>
    </div>
    {{ csrf_field() }}
  </div>
</section>

<div class="container">

  <div class="row">

    <div class="col-lg-3">
      <p><br></p>
            @foreach($category as $key => $category)
      <div class="list-group">
        <a href="/shop/category/{{ $category->id_category}}" class="list-group-item">{{$category->category_name}}</a>
      </div>
      @endforeach
      <div>
      <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Filter</a>
      <div class="dropdown-menu" aria-labelledby="dropdown01">
        <a class="dropdown-item" href="/shop/PriceFilterDesc">Forward sort by price</a>
        <a class="dropdown-item" href="/shop/PriceFilterAsc">Backward sort by price</a>
      </div>
     </div>

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
            <img class="d-block img-fluid" src= "/images/1548253316.jpg" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="/images/teeshirt_caroussel_shop.png" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block img-fluid" src="/images/polo_caroussel_shop.png" alt="Third slide">
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

          <img class="card-img-top" src= "/images/{{$data->url_image}}" height="250 px"
                                         width="241 px" alt="">
            <div class="card-body">
              <h4 class="card-title">
                <a href="/basket\add\{{$data->id_product}}">{{$data->product_name}}</a>
              </h4>
              <h5>{{$data->price}} €</h5>
              <p class="card-text">{{$data->product_description}}</p>
              <div class="btn-group">
                <a href="/basket\add\{{$data->id_product}}"><button type="button" class="btn btn-sm btn-outline-secondary">Add</button></a>
                <a href="/shop\delete\{{ $data->id_product}}"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
                <a href="/shop\edit\{{ $data->id_product}}"> <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button></a>
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


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function(){

   $('#product_name').keyup(function(){
    var query = $(this).val();
    if(query != '')
    {
     var _token = $('input[name="_token"]').val();
     $.ajax({
      url:"{{ route('autocomplete.fetch') }}",
      method:"POST",
      data:{query:query, _token:_token},
      success:function(data){
       $('#productList').fadeIn();
       $('#productList').html(data);
     }
   });
   }
 });

   $(document).on('click', 'li', function(){
    $('#product_name').val($(this).text());
    $('#productList').fadeOut();
  });

 });
</script>
@endsection
