<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;
use Auth;
use Cookie;
use Toastr;

class BasketController extends Controller{

	public function index(Request $request){
		if (!Auth::user()!=null){
      Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

      return back();

    } else {
			$basket = array();
			$data = DB::table('product')->get();
			return view('basket.basket', compact('data'));

		}

	}

	public function Change(Request $request, $id, $value){
			if (!Auth::user()!=null){
				Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

			} else {
		if(!isset($value)){
			$value = 1;
		}
		if($value > 100){
			$value = 100;
		}

		$real_id = Auth::id().';'.$id;
		$request->session()->put($real_id, $value);

		}
		return back();

	}

	public function Delete(Request $request){

		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

		} else {

		$basket = array();
		$data = DB::table('product')->get();

		foreach ($data as $key => $data) {
			$value = Auth::id().';'.$data->id_product;
			if($request->session()->has($value)){

				$request->session()->forget($value);

			}

		}
		Toastr::success('Basket Deleted', 'SUCCESS', ["positionClass" => "toast-top-center"]);
	}
		return back();

	}

	public function add($id, Request $request){

		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/');
		} else {
		$value = Auth::id().';'.$id;
		if (!$request->session()->has($value)){
			$request->session()->put($value, 1);
		} else {
			$request->session()->put($value, $request->session()->get($value)+1);
		}
		Toastr::success('Product added', 'SUCCESS', ["positionClass" => "toast-top-center"]);
		return redirect()->action('BasketController@Index');
	}

	}

}
