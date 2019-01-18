<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;

class IdeaBoxController extends Controller{

	public function index(){

		$data = DB::table('ideas_box')->get();

		return view('ideabox.ideabox', compact('data'));
	}

	public function Form(FormBuilder $FormBuilder){

		$Formular = $FormBuilder-> create(IdeaForm::class);

		return view('ideabox.ideaboxcreation', compact('Formular'));
	}

	public function Create(){

		if(!empty($_POST)){
			DB::table('ideas_box')->insert(array(
				'name'=>$_POST['Name'],
				'description'=>$_POST['Description'],
				'price'=>$_POST['Price'],
				'creation_date' => date("Y/m/d")));
			
			DB::table('image')->insert(array(
				'url_image'=>$_POST['Picture']));

			return redirect(route('index'));
		}
	}
}
