<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;

class UploadController extends Controller{

	public function index(){
		return view('upload');
	}
	public function images(){
		$data = DB::table('image')->get();
		return view('all_images', compact('data'));
	}

	public function upload_image(Request $request){

		$user = new file;
		$user->title = Input::get('name');
		if(Input::hasFile('image')){
			$file=Input::file('image');
			$file->move(public_path(). '/img', $file->getClientOriginalName());
			$user->title = $file->getClientOriginalName();
			DB::table('image')->insert(array(
				'url_image'=>$user->title ));
		}

		return view('all_images');
	}

}
