<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;
use Illuminate\Support\Facades\Input;


class AdminController extends Controller{

	public function index(){
		$data = DB::table('users')->get();
		return view('admin', compact('data'));
	}

	public function Delete($id){
		DB::table('users')->where('id',$id)->delete();

		return redirect('/admin');

	}

	public function Save($id){

		$input = Input::all();
		$first_name = 'first_name'.$id;
		$last_name = 'last_name'.$id;
		$email = 'email'.$id;
		$location = 'location'.$id;
		$password = 'password'.$id;
		$permissions = 'permissions'.$id;

		if(isset($input[$password])){
			DB::table('users')->where('id',$id)->update(['last_name' => $input[$last_name],
			'first_name' => $input[$first_name],'email' => $input[$email], 'location' => $input[$location],
			'password' => bcrypt($input[$password]), 'permissions' => $input[$permissions]]);
		} else {
			DB::table('users')->where('id',$id)->update(['last_name' => $input[$last_name],
			'first_name' => $input[$first_name],'email' => $input[$email], 'location' => $input[$location],
			'permissions' => $input[$permissions]]);
		}


		return redirect('/admin');
	}
}
