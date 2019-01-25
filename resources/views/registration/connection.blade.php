@extends('template')

@section('content')
<div class="login-page">
  <div class="form">
    <form action="/connection" method="post" class="login-form">
      {{ csrf_field() }}

      <label>E-mail</label>
      <input placeholder="username" type="email" name="email" value="{{ old('email') }}"/>

      <label>Password</label>
      <input  name="password" type="password" placeholder="password"/>
      @if($errors->has('password'))
      <p class="help is-danger">{{ $errors->first('password') }}</p>
      @endif

      <button type="submit">login</button>
      <p class="message">Not registered? <a href="/register">Create an account</a></p>
    </form>
  </div>
</div>
@endsection
