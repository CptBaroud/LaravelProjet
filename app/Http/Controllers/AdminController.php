<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;

class AdminController extends Controller{

	public function index(){
		$data = DB::table('users')->get();
		return view('admin', compact('data'));
	}

	public function Delete($id){
		DB::table('users')->where('id',$id)->delete();

		return redirect('/admin');

	}

	public function Save(Request $request, $id){

		$first_name = 'first_name'.$id;
		$last_name = 'first_name'.$id;
		$email = 'email'.$id;
		$location = 'location'.$id;
		$password = 'password'.$id;
		$permissions = 'permissions'.$id;

		if(isset($request->password)){
			DB::table('users')->where('id',$id)->update(['last_name' => $request->input($last_name),
			'first_name' => $request->input($first_name),'email' => $request->input($email), 'location' => $request->input($location),
			'password' => bcrypt($request->input($password)), 'permissions' => $request->input($permissions)]);
		} else {
			DB::table('users')->where('id',$id)->update(['last_name' => $request->input($last_name),
			'first_name' => $request->input($first_name),'email' => $request->input($email), 'location' => $request->input($location),
			'permissions' => $request->input($permissions)]);
		}


		return redirect('/admin');
	}
}
