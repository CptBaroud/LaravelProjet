<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;
use Auth;
use Cookie;

class BasketController extends Controller{

	public function index(Request $request){

		$basket = array();
		$data = DB::table('product')->get();

		return view('basket.basket', compact('data'));

	}

	public function Change(Request $request, $id, $value){

		$request->session()->put($id, $value);


		return redirect()->action('BasketController@Index');

	}

	public function Delete(Request $request){

		$basket = array();
		$data = DB::table('product')->get();

		foreach ($data as $key => $data) {

			if($request->session()->has($data->id_product)){

			 	$request->session()->forget($data->id_product);

			}

		}
		return back();
	}

	public function add($id, Request $request){

		if (!$request->session()->has($id)){
			$request->session()->put($id, 1);
		} else {
			$request->session()->put($id, $request->session()->get($id)+1);
		}

		return redirect()->action('BasketController@Index');

	}

}
