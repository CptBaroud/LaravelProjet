<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;
use Auth;

class BasketController extends Controller{

	public function index(){
		
		$data = DB::table('basket')->get();

		return view('basket.basket', compact('data'));
	}

	public function add($id){
		$test = DB::table('basket')->where('id_product',$id)->select(
			'id_product')->get();
			if ($test = $id){

				DB::table('basket')->where('id_product',$id)->increment('quantity');
			}
			else{
				DB::table('basket')->insert(array(
				'id_product'=>$id,
				'quantity'=>+1,
				'id'=>auth::user()->id));
			}
			return back();

			}

}