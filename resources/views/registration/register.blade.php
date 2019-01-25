@extends('template')
@section('content')
<div class="login-page">
  <div class="form">
    <form onsubmit="return verifFormRegister(this)" action="/register" method="post" class="login-form">

     {{ csrf_field() }}

     <label>Last Name</label>  
     <input class="input" type="text" name="last_name" onblur="checkNickName(this)">
     @if($errors->has('last_name'))
     <p class="help is-danger">{{ $errors->first('last_name') }}</p>
     @endif


     
     <label>First Name</label>
     <input class="input" type="text" name="first_name">
     @if($errors->has('first_name'))
     <p class="help is-danger">{{ $errors->first('first_name') }}</p>
     @endif
     


     <label>Location</label>
     <select name="location">
      <option>Saint Nazaire</option>
      <option>Lille</option>
      <option>Arras</option>
      <option>Rouen</option>
      <option>Caen</option>
      <option>Nantes</option>
      <option>Brest</option>
      <option>La Rochelle</option>
      <option>Bordeaux</option>
      <option>Pau</option>
      <option>Lyon</option>
      <option>Montpellier</option>
      <option>Nice</option>
      <option>Nancy</option>
      <option>Strasbourg</option>
    </select>   
    @if($errors->has('location'))
    <p class="help is-danger">{{ $errors->first('location') }}</p>
    @endif

    <br>
    <label>E-mail</label>
    <input class="input" onblur="checkMail(this)" type="email" name="email" value="{{ old('email') }}">
    @if($errors->has('email'))
    <p class="help is-danger">{{ $errors->first('email') }}</p>
    @endif


    <label>Password</label>
    <input onblur="checkPswd(this)" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="input" type="password" name="password">
    @if($errors->has('password'))
    <p class="help is-danger">{{ $errors->first('password') }}</p>
    @endif

    <br>

    <input type="checkbox" name="checkbox" value="check" id="agree" /> I have read and agree to the <a href="/legalmention"> Terms and Conditions and Privacy Policy</a>
    <br>
    <button type="submit">Sign in</button>
  </form>
</div>
</div>

@endsection
