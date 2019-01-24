@extends('template')
@section('content')

<form onsubmit="return verifFormRegister(this)" action="/register" method="post" class="section">
 {{ csrf_field() }}

 <div>
   <label>Last Name</label>
   <div>
     <input class="input" type="text" name="last_name" onblur="checkNickName(this)">
   </div>
   @if($errors->has('last_name'))
   <p class="help is-danger">{{ $errors->first('last_name') }}</p>
   @endif
 </div>

 <div>
   <label>First Name</label>
   <div>
     <input class="input" type="text" name="first_name">
   </div>
   @if($errors->has('first_name'))
   <p class="help is-danger">{{ $errors->first('first_name') }}</p>
   @endif
 </div>

 <div>
   <label>Location</label>
   <div>
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
  </div>
  @if($errors->has('location'))
  <p class="help is-danger">{{ $errors->first('location') }}</p>
  @endif
</div>

<div>
 <label>E-mail</label>
 <div>
   <input class="input" onblur="checkMail(this)" type="email" name="email" value="{{ old('email') }}">
 </div>
 @if($errors->has('email'))
 <p class="help is-danger">{{ $errors->first('email') }}</p>
 @endif
</div>

<div>
 <label>Password</label>
 <div>
  <input onblur="checkPswd(this)" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" class="input" type="password" name="password">
</div>
@if($errors->has('password'))
<p class="help is-danger">{{ $errors->first('password') }}</p>
@endif
</div>
<br>
<div>
  <input type="checkbox" name="checkbox" value="check" id="agree" /> I have read and agree to the <a href="/legalmention"> Terms and Conditions and Privacy Policy</a>
</div>
<div>
  <button class="button is-link" type="submit">Sign in</button>
</div>
</form>
@endsection
