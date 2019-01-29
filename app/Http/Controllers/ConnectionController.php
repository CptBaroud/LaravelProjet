<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Toastr;

class ConnectionController extends Controller
{

	public function index(){
		if (Auth::user()!=null){
			Toastr::warning("You are already logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return back();
		} else {
			return view('registration.connection');
		}
	}

	public function log_out(){
		if (Auth::user()==null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return back();
		} else {
			Auth::logout();
			Toastr::success('You are disconnected', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			return redirect('/');
		}

	}

	public function processing(){
		try{ 

			request()->validate([

				'email' => ['required', 'email'],
				'password' => ['required']

			]);

			$userdata = array(
				'email'      => request('email'),
				'password'      => request('password')
			);
		}
		catch(Exception $e){
			echo $e->getMessage();
		}

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
