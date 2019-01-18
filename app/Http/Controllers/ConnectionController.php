<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ConnectionController extends Controller
{

	public function index(){

		return view('registration.connection');

	}

	public function log_out(){

			Auth::logout();
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

			return redirect('/');

		} else {

			return back()->withInput()->withErrors([

				'password' => 'Wrong Email or Password.'

			]);

		}

	}
}
