<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RegistrationController extends Controller
{
	public function index(){

		return view ('registration.register');
	}

	public function processing(){

		$Users = new \App\Users;
		$Users->last_name = request('last_name');
		$Users->first_name = request('first_name');
		$Users->location = request('location');
		$Users->email = request('email');
		$Users->password = bcrypt(request('password'));
		$Users->permissions = 0;
		$Users->last_attempt = date("Y/m/d");

		$Users->save();

		return redirect('/');
	}
}
