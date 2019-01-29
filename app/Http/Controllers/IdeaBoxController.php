<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Notifications;
use App\Notifications\Report;
use App\Forms\IdeaForm;
use DB;
use Auth;
use File;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Illuminate\Support\Facades\Input;
use Toastr;

class IdeaBoxController extends Controller{

	public function index(){
		if (!Auth::user()!=null){

			$user_connected = false;
			$permission = 0;

		} else {
			try{
				$user_connected = true;
				$permission = Auth::user()->permissions;
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}

		$data = DB::table('ideas_box')->get();

		return view('ideabox.ideabox', compact('permission', 'data', 'user_connected'));
	}


	public function DownloadUsers($id)
	{

		if (Auth::user()==null || Auth::user()->permissions = 0){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/');
		} else {
			try{
				$user = array();

				$data = DB::table('ideas_box')->where('id_idea', $id)->get();

				$headers = [
					'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
					,   'Content-type'        => 'text/csv'
					,   'Content-Disposition' => 'attachment; filename=users_ideas_box.csv'
					,   'Expires'             => '0'
					,   'Pragma'              => 'public'
				];

				$current_value = $data[0]->likes;
				$tab = explode(';',$current_value);
				for($i = 0; $i < count($tab)-1; $i++){
					$data_user = DB::table('users')->where('id', $tab[$i])->get();
					$user[$i] = $data_user[0]->last_name.' '.$data_user[0]->first_name;
				}

				$callback = function() use ($user)
				{
					$FH = fopen('php://output', 'w');

					for($i = 0; $i < count($user); $i++){
						fputcsv($FH, array($user[$i]));
					}

					fclose($FH);
				};

				return (new StreamedResponse($callback, 200, $headers))->sendContent()->Toastr::success('Users registered downloaded !', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}

	public function Form(FormBuilder $FormBuilder){

		if (Auth::user()==null){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/');
		} else {
			try{

				$Formular = $FormBuilder-> create(IdeaForm::class);

				return view('ideabox.ideaboxcreation', compact('Formular'));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}

	public function Create(){

		if (Auth::user()==null){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{

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
				Toastr::success('Idea created', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return redirect('/idea_box');

	}


	public function Update(Request $request, $id){

		if (Auth::user()==null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{
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
				Toastr::success('Idea updated', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return redirect('/idea_box');
	}

	public function Savetodb(Request $request){
		if (Auth::user()==null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/idea_box');
		} else {
			try{
				$id_user = DB::table('ideas_box')->where('id_idea', $request->id_idea)->select('id')->get();


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
					'id'=>Auth::id(),
					'date' => $request->date,
					'recursivity' => $request->recursivity

				]);



				$user_notify = \App\Users::find($id_user[0]->id);

				$user_notify->notify(new Notifications());

				DB::table('ideas_box')->where('id_idea', $request->id_idea)->delete();

				Toastr::success('IdeaSaved', 'SUCCESS', ["positionClass" => "toast-top-center"]);


				return redirect('/activities');
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}

	}

	public function Save($id){
		if (Auth::user()==null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/idea_box');
		} else {
			try{
				$data = DB::table('ideas_box')->where('id_idea',$id)->get();

				$url_image = DB::table('image')->where('id_image',$data[0]->id_image)->select('url_image')->get();

				return view('ideabox.ideaboxsave',compact('data', 'url_image', 'id'));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}

	public function Like($id){
		if (Auth::user()!=null){
			try{
				$id_user = Auth::id();
				$data = DB::table('ideas_box')->where('id_idea', $id)->get();
				$current_value = $data[0]->likes;
				DB::table('ideas_box')->where('id_idea', $id)->update(array(
					'likes'=>$current_value.$id_user.';'
				));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return back();
	}

	public function UnLike(Request $request, $id_idea)
	{
		if (Auth::user()!=null){
			try{
				$id_user = Auth::id();
				$data =DB::table('ideas_box')->where('id_idea', $id_idea)->get();

				$current_value_likes = str_replace($id_user.';',"",$data[0]->likes);
				DB::table('ideas_box')->where('id_idea', $id_idea)->update(array(
					'likes'=>$current_value_likes
				));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}

		return back();

	}


	public function Edit($id){
		if (Auth::user()==null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/idea_box');
		} else {
			try{
				$data = DB::table('ideas_box')->
				where('id_idea',$id)->get();

				$url_image = DB::table('image')->where('id_image',$data[0]->id_image)->select('url_image')->get();

				Toastr::success('Idea edited', 'SUCCESS', ["positionClass" => "toast-top-center"]);

				return view('ideabox.ideaboxedit',compact('data', 'url_image'));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}


	public function Delete($id){
		if (Auth::user()==null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/idea_box');
		} else {
			try{
				DB::table('ideas_box')->where('id_idea',$id)->delete();

				Toastr::success('Idea Deleted', 'SUCCESS', ["positionClass" => "toast-top-center"]);

				return back();
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}

	}

	public function Report($id){
		if (Auth::user()==null || Auth::user()->permissions != 2){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{
				$admin = DB::table('users')->where('permissions', '1')->select('id')->get();

				foreach ($admin as $key => $admin) {
					$user_notify = \App\Users::find($admin->id);
					$user_notify->notify(new report());
				}
				Toastr::warning('Reported', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return redirect('/idea_box');
	}

}
