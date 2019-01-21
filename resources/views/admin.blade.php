@extends('template')

@section('content')
<br>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Last Name</th>
      <th scope="col">First Name</th>
      <th scope="col">Email</th>
      <th scope="col">Location</th>
      <th scope="col">Password</th>
      <th scope="col">Permission</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
    @foreach($data as $key => $data)
    <form action="{{ url('/admin/save')}}/{{$data->id}}" method="post" role="form">
    @csrf
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td><div class="form-group"><input name="last_name" id="last_name" type="text" value="{{$data->last_name}}" name="fname"></div></td>
      <td><div class="form-group"><input name="first_name" id="first_name" type="text" value="{{$data->first_name}}" name="fname"></div></td>
      <td><div class="form-group"><input name="email" id="email" type="text" value="{{$data->email}}" name="fname"></div></td>
      <td><div class="form-group"><input name="location" id="location" type="text" value="{{$data->location}}" name="fname"></div></td>
      <td><div class="form-group"><input name="password" id="password" type="password" value="" placeholder="Password" name="fname"></div></td>
      <td>
        <?php
        switch ($data->permissions) {
          case 0:
            echo'<div class="form-group"><select name="permissions" id="permissions">
                <option value="0" selected>Student</option>
                <option value="1">BDE member</option>
                <option value="2">CESI Staff</option>
              </select></div>';
              break;
          case 1:
            echo'<div class="form-group"><select name="permissions" id="permissions">
                <option value="0">Student</option>
                <option value="1" selected>BDE member</option>
                <option value="2">CESI Staff</option>
              </select></div>';
              break;
          case 2:
              echo '<div class="form-group"><select name="permissions" id="permissions">
                <option value="0">Student</option>
                <option value="1">BDE member</option>
                <option value="2" selected>CESI Staff</option>
              </select></div>';
              break;
        }

        ?>
      </td>
      <td><a href="admin\delete\{{ $data->id}}"><button type="button" class="btn btn-sm btn-outline-secondary">Delete</button></a>
      <td><button type="submit" class="btn btn-sm btn-outline-secondary">Save</button>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection
