@extends('template')

@section('content')

<form action="/register" method="post" class="section">
       {{ csrf_field() }}

       <div>
           <label>Last Name</label>
           <div>
               <input class="input" type="text" name="last_name">
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
               <input class="input" type="text" name="location">
           </div>
           @if($errors->has('location'))
               <p class="help is-danger">{{ $errors->first('location') }}</p>
           @endif
       </div>

       <div>
           <label>E-mail</label>
           <div>
               <input class="input" type="email" name="email" value="{{ old('email') }}">
           </div>
           @if($errors->has('email'))
               <p class="help is-danger">{{ $errors->first('email') }}</p>
           @endif
       </div>

       <div>
           <label>Password</label>
           <div>
               <input class="input" type="password" name="password">
           </div>
           @if($errors->has('password'))
               <p class="help is-danger">{{ $errors->first('password') }}</p>
           @endif
       </div>
       <br>
       <div>
           <div>
               <button class="button is-link" type="submit">Sign in</button>
           </div>
       </div>
   </form>

@endsection
