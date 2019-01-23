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
		$real_id = Auth::id().';'.$id;
		$request->session()->put($real_id, $value);


		return back();

	}

	public function Delete(Request $request){

		$basket = array();
		$data = DB::table('product')->get();

		foreach ($data as $key => $data) {
			$value = Auth::id().';'.$data->id_product;
			if($request->session()->has($value)){

			 	$request->session()->forget($value);

			}

		}
		return back();
	}

	public function add($id, Request $request){
		$value = Auth::id().';'.$id;
		if (!$request->session()->has($value)){
			$request->session()->put($value, 1);
		} else {
			$request->session()->put($value, $request->session()->get($value)+1);
		}

		return redirect()->action('BasketController@Index');

	}

}
