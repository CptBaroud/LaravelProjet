@extends('template')

@section('content')


<!-- Header with Background Image -->
<header class="business-header">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="display-3 text-center mt-4 H1">BDE CESI</h1>
			</div>
		</div>
	</div>
</header>

<!-- Page Content -->
<div class="container">

	<div class="row">
		<div class="col-sm-8">
			<h2 class="mt-4">What is the BDE ?</h2>
			<p>A student office (BDE) or student office, is a student association of the same university or school, elected by their members, and which is responsible for organizing extracurricular activities such as student evenings, welcoming new students, and various activities ranging from sports events to cultural events, including the management of potential cafeterias or student cooperatives.
			
		</div>
		<div class="col-sm-4">
			<h2 class="mt-4">Contact Us</h2>
			<address>
				<strong>Address</strong>
				<br>Boulevard de l'Université
				<br>Saint Nazaire, 44600
				<br>
			</address>
			<address>
				<abbr title="Email">Email:</abbr>
				<a >bdecesisaintnazaire44@gmail.com</a>
			</address>
		</div>
	</div>
	<!-- /.row -->

	<div class="row">
		<div class="col-sm-4 my-4">
			<div class="card">
				<img class="card-img-top" height="200" width="300" src="images/idea_box.jpg" alt="idea_box.jpg">
				<div class="card-body">
					<h4 class="card-title">Idea Box</h4>
					<p class="card-text">In this section, you will be able to see all the ideas, like idea that you prefer,
					and also, you could suggest some idea. If your idea get a lot of likes, it will be transfered to the activities section.</p>
				</div>
				<div class="card-footer">
					<a href="/idea_box" class="btn btn-primary button">Find Out More!</a>
				</div>
			</div>
		</div>
		<div class="col-sm-4 my-4">
			<div class="card">
				<img class="card-img-top" height="200" width="300" src="images/activities.jpg" alt="">
				<div class="card-body">
					<h4 class="card-title">Activities</h4>
					<p class="card-text">In this section, you will be able to see all the activities, post some pictures 
					on the past activities, registered yourself to the upcoming one, comment the pictures ect...</p>
				</div>
				<div class="card-footer">
					<a href="/activities" class="btn btn-primary button">Find Out More!</a>
				</div>
			</div>
		</div>
		<div class="col-sm-4 my-4">
			<div class="card">
				<img class="card-img-top" src="images/tshirt.jpg" alt="">
				<div class="card-body">
					<h4 class="card-title">Shop</h4>
					<p class="card-text">In this section, you will be able to purchase some goodies from the BDE shop. </p>
				</div>
				<div class="card-footer">
					<a href="/shop" class="btn btn-primary button">Find Out More!</a>
				</div>
			</div>
		</div>

	</div>
	<!-- /.row -->

</div>
<!-- /.container -->

@endsection
