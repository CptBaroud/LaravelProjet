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
use File;
use Illuminate\Support\Facades\Input;

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
			'id'=>auth::user()->id));

		return redirect('/idea_box');
	}


	public function Update(Request $request, $id){

		$user = new file;
		if(Input::hasFile('file')){
			$file = Input::file('file');
			$file->move(public_path(). '/images', $file->getClientOriginalName());
			$user->title = $file->getClientOriginalName();
			$id = DB::getPdo()->lastInsertId();
			DB::table('image')->where('id_image', $request->id_image)->update(array(
				'url_image'=>$user->title
			));
		}

		DB::table('ideas_box')
		->where('id_idea',$id)
		->update(['name' => $request->name,
			'description' => $request->description,
			'price' => $request->number]);


		return redirect('/idea_box');
	}

	public function Savetodb(Request $request){

		DB::table('ideas_box')->where('id_idea', $request->id_idea)->delete();

		$user = new file;
		if(Input::hasFile('file')){
			$file = Input::file('file');
			$file->move(public_path(). '/images', $file->getClientOriginalName());
			$user->title = $file->getClientOriginalName();
			$id = DB::getPdo()->lastInsertId();
			DB::table('image')->where('id_image', $request->id_image)->update(array(
				'url_image'=>$user->title
			));
		}

		DB::table('activities')
		->insert(['name' => $request->name,
			'description' => $request->description,
			'price' => $request->number,
			'id_image'=>$request->id_image,
			'date' => date("Y/m/d")]);



		auth()->user()->notify(new Notifications());


		return redirect('/activities');

	}

	public function Save($id){
		$data = DB::table('ideas_box')->where('id_idea',$id)->get();

		$url_image = DB::table('image')->where('id_image',$data[0]->id_image)->select('url_image')->get();

		return view('ideabox.ideaboxsave',compact('data', 'url_image', 'id'));
	}

	public function Like($id){
		$ok = false;
		$tab = array();
		$id_user = Auth::id();
			$idea = DB::table('ideas_box')->where('id_idea', $id)->get();
			$current_value = $idea[0]->likes;
			$tab = explode(';',$current_value);
			for($i = 0; $i < count($tab)-1; $i++){
				if($tab[$i] == $id_user) {
					$ok = true;
				}
			}

			if(!$ok){
				DB::table('comments_image')->where('id_comment', $id_comment)->update(array(
					'likes'=>$current_value.$id_user.';'
				));
			}

		return back();
	}

	public function Edit($id){
		$data = DB::table('ideas_box')->
		where('id_idea',$id)->get();

		$url_image = DB::table('image')->where('id_image',$data[0]->id_image)->select('url_image')->get();

		return view('ideabox.ideaboxedit',compact('data', 'url_image'));
	}


	public function Delete($id){

		DB::table('ideas_box')->where('id_idea',$id)->delete();

		return redirect('/idea_box');

	}
}
