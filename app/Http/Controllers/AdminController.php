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

		if(isset($request->password)){
			DB::table('users')->where('id',$id)->update(['last_name' => $request->last_name,
			'first_name' => $request->first_name,'email' => $request->email, 'location' => $request->location,
			'password' => bcrypt($request->password), 'permissions' => $request->permissions]);
		} else {
			DB::table('users')->where('id',$id)->update(['last_name' => $request->last_name,
			'first_name' => $request->first_name,'email' => $request->email, 'location' => $request->location,
			'permissions' => $request->permissions]);
		}


		return redirect('/admin');
	}
}
