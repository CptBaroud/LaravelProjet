<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Toastr;

class RegistrationController extends Controller
{
	public function index(){

		return view ('registration.register');
	}

	public function processing(){
		$email = request('email');

		$test = DB::table('users')->where('email', $email)->get();


		if(!isset($test[0]->id)){
			try{
				$Users = new \App\Users;
				$Users->last_name = request('last_name');
				$Users->first_name = request('first_name');
				$Users->location = request('location');
				$Users->email = request('email');
				$Users->password = bcrypt(request('password'));
				$Users->permissions = 0;
				$Users->last_attempt = date("Y/m/d");
				Toastr::success('You have been registered sucessfully', 'SUCCESS', ["positionClass" => "toast-top-center"]);

				$Users->save();

				return redirect('/');

			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		else{
			Toastr::error('This email adress already exists', 'ERROR', ["positionClass" => "toast-top-center"]);
			return redirect('/register');
		}


	}
}
