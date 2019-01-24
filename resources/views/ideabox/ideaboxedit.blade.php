@extends('template')

@section('content')
<br>
@foreach($data as $key => $data)
<form action="{{ url('/idea_box/update')}}/{{$data->id_idea}}" method="post" role="form" enctype="multipart/form-data" onsubmit="return verifForm(this)">
	@csrf
	<div class="form-group">
		<label for="Name">Name</label>
		<input  name="name" class="form-control" value="{{$data->name}}" onblur="verifName(this)">
	</div>
	<div class="form-group">
		<label type="textarea" for="Description">Description</label>
		<input name='description' class="form-control" value="{{$data->description}}" onblur="verifDescription(this)">
	</div>
	<div class="form-group">
		<input type='hidden' name='id_image' class="form-control" value="{{$data->id_image}}" >
		<img src="{{ url('/images')}}/{{$url_image[0]->url_image}}" width="10%" height="10%" border="0" />
	</div>
	<div class="form-group">
		<label for="Picture">Change Picture</label>
		<input type="file" name="file" class="form-control">
	</div>
	<div class="form-group">
		<label type="number" for="Description">Price</label>
		<input name='number' class="form-control" value="{{$data->price}}" onblur="verifNumber(this)">
	</div>
	<button type="submit" class="btn btn-primary">Submit</button>
</form>

<script>

	function surligne(champ, erreur)
	{
		if(erreur)
			champ.style.backgroundColor = "#fba";
		else
			champ.style.backgroundColor = "";
	}


	function verifName(champ)
	{
			if(champ.value.length < 2 || champ.value.length > 25)
			{
				surligne(champ, true);
				return false;
			}
			else
			{
				surligne(champ, false);
				return true;
			} 
		}

		function verifDescription(champ)
		{
			if(champ.value.length < 2 || champ.value.length > 225)
			{
				surligne(champ, true);
				return false;
			}
			else
			{
				surligne(champ, false);
				return true;
			}
		}

		function verifNumber(champ)
		{
			
			var number = parseInt(champ.value);
			if(isNaN(number) || number < 1 || number > 100)
			{
				surligne(champ, true);
				return false;
			}
			else
			{
				surligne(champ, false);
				return true;
			}
		}

		function verifForm(f)
		{
			var nameOk = verifName(f.name);
			var descriptionOk = verifDescription(f.description);
			var numberOk = verifNumber(f.number);

			if(nameOk && descriptionOk && numberOk)
				return true;
			else
			{
				alert("Veuillez remplir correctement tous les champs");
				return false;
			}
		}
	</script>
@endforeach

@endsection
