<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Notifications;
use App\Forms\IdeaForm;
use DB;
use Auth;

class IdeaBoxController extends Controller{

	public function index(){
		if (Auth::user()!=null){
			$permission = Auth::user()->permissions;
		}
		$data = DB::table('ideas_box')->get();
		
		return view('ideabox.ideabox', compact('permission', 'data'));
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
			'id_user'=>auth::user()->id));

		return redirect(route('index'));
	}


	public function Update(Request $request, $id){

		$idlast = DB::getPdo()->lastInsertId();;

		DB::table('ideas_box')
		->where('id_idea',$id)
		->update(['name' => $request->name, 
			'description' => $request->description,
			'price' => $request->number]);

		$id_img=DB::table('ideas_box')
		->where('id_idea',$id)
		->select('id_image');

		$image = $request->image;

		request()->validate([
			'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
		]);

		$imageName = time() . '.' . request()->image->getClientOriginalExtension();
		request()->image->move(public_path('images'), $imageName);

		DB::table('image')->where('id_image',$id_img)->update(array(
			'url_image' => $_FILES["image"]["name"]));
		
		DB::table('image')->where('id_image',$id_img)->update(['url_image' => $imageName]);

		return redirect('/idea_box');
	}

	public function Savetodb(Request $request){
		
		$activityname = $request->name ;

		DB::table('activities')
		->insert(['name' => $request->name, 
			'description' => $request->description,
			'price' => $request->number]);

		auth()->user()->notify(new Notifications($activityname));


		return redirect('/idea_box');

	}

	public function Save($id){
		$data = DB::table('ideas_box')->where('id_idea',$id)->get();

		return view('ideabox.ideaboxsave',compact('data'));
	}

	public function Like($id){
		DB::table('ideas_box')
		->where('id_idea',$id)
		->increment('nber_likes');



		return redirect('/idea_box');
	}

	public function Edit($id){
		$data = DB::table('ideas_box')->
		where('id_idea',$id)->get();

		return view('ideabox.ideaboxedit',compact('data'));
	}


	public function Delete($id){

		DB::table('ideas_box')->where('id_idea',$id)->delete();

		return redirect('/idea_box');

	}
}
