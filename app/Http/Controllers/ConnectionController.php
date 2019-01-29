<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Toastr;

class ConnectionController extends Controller
{

	public function index(){

		return view('registration.connection');

	}

	public function log_out(){

		Auth::logout();
		Toastr::success('You are disconnected', 'SUCCESS', ["positionClass" => "toast-top-center"]);
		return redirect('/');

	}

	public function processing(){

		request()->validate([

			'email' => ['required', 'email'],
			'password' => ['required']

		]);

		$userdata = array(
			'email'      => request('email'),
			'password'      => request('password')
		);

		if(Auth::attempt($userdata)){
			Toastr::success('You are connected', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			return redirect('/');

		} else {

			return back()->withInput()->withErrors([

				'password' => 'Wrong Email or Password.'


			]);
			Toastr::error('Wrong Email or Password', 'Error', ["positionClass" => "toast-top-center"]);

		}
	}
}
