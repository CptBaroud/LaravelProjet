@extends('template')

@section('content')

<form action="/connection" method="post" class="section">
       {{ csrf_field() }}

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
               <button class="button is-link" type="submit">Login</button>
           </div>
       </div>
   </form>

@endsection
