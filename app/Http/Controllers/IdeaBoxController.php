<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;
use Auth;

class IdeaBoxController extends Controller{

	public function index(){

		$permission = Auth::user()->permissions;
		$data = DB::table('ideas_box')->get();

		return view('ideabox.ideabox', compact('data','permission'));
	}

	public function Form(FormBuilder $FormBuilder){

		$Formular = $FormBuilder-> create(IdeaForm::class);

		return view('ideabox.ideaboxcreation', compact('Formular'));
	}

	public function Create(){

		request()->validate([
			'Picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
		]);

		$imageName = time() . '.' . request()->Picture->getClientOriginalExtension();
		request()->Picture->move(public_path('images'), $imageName);

		DB::table('image')->insert(array(
			'url_image' => $_FILES["Picture"]["name"]));
		$id = DB::getPdo()->lastInsertId();;
		
		DB::table('image')->where('id_image',$id)->update(['url_image' => $imageName]);
		DB::table('ideas_box')->insert(array(
			'name'=>$_POST['Name'],
			'description'=>$_POST['Description'],
			'price'=>$_POST['Price'],
			'creation_date' => date("Y/m/d"),
			'id_image'=>$id,
			'id_user'=>Auth::user()->id));

		return redirect(route('index'));
	}


	public function Update(Request $request, $id){
		DB::table('ideas_box')
		->where('id_idea',$id)
		->update(['name' => $request->name, 'description' => $request->description,'price' => $request->number]);


		return redirect('/idea_box');
	}

	public function Savetodb(Request $request){
		DB::table('activities')
		->insert(['name' => $request->name, 'description' => $request->description,'price' => $request->number]);


		return redirect('/idea_box');
	}

	public function Save($id){
		$data = DB::table('ideas_box')->where('id_idea',$id)->get();

		return view('ideabox.ideaboxsave',compact('data'));
	}

	public function Like($id){
		DB::table('ideas_box')
		->where('id_idea',$id)
		->update(['id_users_likes' => (DB::table('ideas_box')->where('id_idea',$id)->get('id_users_likes')) +1]);


		return redirect('/idea_box');
	}

	public function Edit($id){
		$data = DB::table('ideas_box')->where('id_idea',$id)->get();

		return view('ideabox.ideaboxedit',compact('data'));
	}


	public function Delete($id){

		DB::table('ideas_box')->where('id_idea',$id)->delete();

		return redirect('/idea_box');

	}
}
