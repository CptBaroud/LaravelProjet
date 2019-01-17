<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConnectionController extends Controller
{
	public function index(){

		return view('registration.connection');
	}

	public function processing(){

		request()->validate([

			'email' => ['required', 'email'],
			'password' => ['required']

		]);

		$result = auth()->attempt([

    'email' => request('email'),
    'password' => request('password'),

		]);

		if($result){

			return redirect('/');

		} else {

			return back()->withInput()->withErrors([

				'password' => 'Wrong Email or Password.'

			]);

		}


	}
}
