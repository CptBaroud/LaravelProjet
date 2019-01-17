<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;

class IdeaBoxController extends Controller{

	public function index(){

		return view('ideabox.ideabox');
	}


	public function Form(FormBuilder $FormBuilder){

		$Formular = $FormBuilder-> create(IdeaForm::class);

		return view('ideabox.ideaboxcreation', compact('Formular'));
	}

	public function Create(){
		if(!empty($_POST)){
			DB::table('ideas_box')->insert(array('name'=>$_POST['Name'],'description'=>$_POST['Description']));
			return redirect(route('index'));
		}
	}
}
