<?php

namespace App\Http\Controllers;

use App\Forms\PostForm;
use App\Post;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use DB;
use Auth;
use File;
use Illuminate\Support\Facades\Input;
use App\Notifications\reportcomment;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Notifications\report;
use Toastr;



class ActivitiesController extends Controller
{
	//display the activities
	public function index(FormBuilder $formBuilder)
	{
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

		$data = DB::table('activities')->get();
		return view('activities.activity', compact('data', 'permission', 'user_connected'));

	}
//download all the users that are registered
	public function DownloadUsers($id)
	{
		if (!Auth::user()!=null || Auth::user()->permissions = 0){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/');
		} else {
			try{
				$user = array();
				$data = DB::table('activities')->where('id_activity', $id)->get();

				$headers = [
					'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0'
					,   'Content-type'        => 'text/csv'
					,   'Content-Disposition' => 'attachment; filename=users_activity.csv'
					,   'Expires'             => '0'
					,   'Pragma'              => 'public'
				];

				$current_value = $data[0]->users_registered;
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

				return (new StreamedResponse($callback, 200, $headers))->sendContent();
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}
//show all activities
	public function showActivity($id)
	{
		$id_activity = $id;
		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

			return back();
		} else {
			try{
				$permission = Auth::user()->permissions;
				$data = DB::table('activities')->where('id_activity', $id_activity)->get();
				return view('activities.showActivity', compact('data','permission'));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}
//Function wich permit to add a picture for past activity
	public function AddPicture($id)
	{
		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

		} else {
			try{
				$id_activity = $id;
				$user = new file;
				if(Input::hasFile('file')){
					$file = Input::file('file');
					$file->move(public_path(). '/images', $file->getClientOriginalName());
					$user->title = $file->getClientOriginalName();
					$id = DB::getPdo()->lastInsertId();
					DB::table('image_activity')->insert(array(
						'url_image'=>$user->title,
						'id_activity'=>$id_activity
					));
				}
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return back();

	}

//function that permit to send comment to a past activity and picture of it
	public function SendComment(Request $request, $id_image)
	{
		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/activities');
		} else {
			try{
				$id_user = Auth::id();
				$user_name = Auth::user()->first_name.' '.Auth::user()->last_name;

				DB::table('comments_image')->insert(array(
					'comment'=> $request->comment,
					'user'=> $id_user,
					'user_name'=> $user_name,
					'nbr_likes'=> 0,
					'id_image'=>$id_image
				));
				Toastr::success('Comment ADDED', 'SUCCESS', ["positionClass" => "toast-top-center"]);

				return back();
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}

	}
//delete comment function
	public function DeleteComment(Request $request, $id_comment)
	{
		if (!Auth::user()!=null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/activities');
		} else {
			try{
				DB::table('comments_image')->where('id_comment', $id_comment)->delete();
				Toastr::success('Comment deleted', 'SUCCESS', ["positionClass" => "toast-top-center"]);
				return back();
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}
//like comment function 
	public function LikeComment(Request $request, $id_comment)
	{
		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{
				$id_user = Auth::id();
				$data =DB::table('comments_image')->where('id_comment', $id_comment)->get();
				$current_value_likes = $data[0]->likes;
				$current_value_nbr_likes = $data[0]->nbr_likes;
				DB::table('comments_image')->where('id_comment', $id_comment)->update(array(
					'likes'=>$current_value_likes.$id_user.';',
					'nbr_likes' => $current_value_nbr_likes + 1
				));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return back();

	}
//unlike comment function
	public function UnLikeComment(Request $request, $id_comment)
	{
		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{
				$id_user = Auth::id();
				$data =DB::table('comments_image')->where('id_comment', $id_comment)->get();

				$current_value_likes = str_replace($id_user.';',"",$data[0]->likes);
				$current_value_nbr_likes = $data[0]->nbr_likes;
				DB::table('comments_image')->where('id_comment', $id_comment)->update(array(
					'likes'=>$current_value_likes,
					'nbr_likes' => $current_value_nbr_likes - 1
				));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}

		return back();

	}
//function to display comments
	public function showComments($id, $id_image)
	{

		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/activities');
		} else {

			if (Auth::user()!=null){
				$permission = Auth::user()->permissions;
			}
			try{
				$comments = DB::table('comments_image')
				->join('image_activity', 'comments_image.id_image', '=', 'image_activity.id_image')
				->where('image_activity.id_image', $id_image)
				->get();
				$url_image = DB::table('image_activity')->where('id_image', $id_image)->select('url_image')->get();
				$url = $url_image[0]->url_image;
			}
			catch(Exception $e){
				echo $e->getMessage();
			}



			return view('activities.showcomments', compact('comments','id_image', 'url', 'permission'));
		}
	}


//function to like 
	public function Like($id){
		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{
				$ok = false;
				$tab = array();
				$id_user = Auth::id();
				$activity = DB::table('activities')->where('id_activity', $id)->get();
				$current_value = $activity[0]->users_registered;
				$tab = explode(';',$current_value);
				for($i = 0; $i < count($tab)-1; $i++){
					if($tab[$i] == $id_user) {
						$ok = true;
					}
				}

				if(!$ok){
					DB::table('activities')->where('id_activity', $id)->update(array(
						'users_registered'=>$current_value.$id_user.';'
					));
				}
				Toastr::success('Activity liked successfully', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return back();
	}

	public function UnLike(Request $request, $id)
	{
		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			$id_user = Auth::id();
			$data =DB::table('activities')->where('id_activity', $id)->get();

			$current_value_likes = str_replace($id_user.';',"",$data[0]->users_registered);
			DB::table('activities')->where('id_activity', $id)->update(array(
				'users_registered'=>$current_value_likes
			));
		}
		return back();

	}
	//function to report an activity
	public function ReportActivity($id){
		if (!Auth::user()!=null || Auth::user()->permissions != 2){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{
				$admin = DB::table('users')->where('permissions', '1')->select('id')->get();

				foreach ($admin as $key => $admin) {
					$user_notify = \App\Users::find($admin->id);
					$user_notify->notify(new report());
				}
				Toastr::success('Activity reported', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return back();
	}
//function to edit an activity
	public function Edit($id){

		if (!Auth::user()!=null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/activities');
		} else {
			try{
				$data = DB::table('activities')->where('id_activity',$id)->get();

				$url_image = DB::table('image')->where('id_image',$data[0]->id_image)->select('url_image')->get();

				Toastr::success('Activity edited', 'SUCCESS', ["positionClass" => "toast-top-center"]);

				return view('activities.activityedit',compact('data', 'url_image'));
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}

//unction to delete an activity
	public function Delete($id){

		if (!Auth::user()!=null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);

		} else {
			try{

				$data_img = DB::table('image_activity')->select('id_image')->where('id_activity',$id)->get();

				foreach ($data_img as $img) {

					DB::table('comments_image')->where('id_image',$img->id_image)->delete();

				}

				DB::table('image_activity')->where('id_activity',$id)->delete();

				DB::table('activities')->where('id_activity',$id)->delete();

				Toastr::success('Activity deleted', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return redirect('/activities');

	}
//fuction to report a comment
	public function report($id, $id_comment){
		if (!Auth::user()!=null || Auth::user()->permissions != 2){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{
				$admin = DB::table('users')->where('permissions', '1')->select('id')->get();

				foreach ($admin as $key => $admin) {
					$user_notify = \App\Users::find($admin->id);
					$user_notify->notify(new reportcomment());
				}
				Toastr::success('Activity reported', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return back();
	}


//function to delete an activity
	public function DeleteImageActivity(Request $request, $id){

		if (!Auth::user()!=null || Auth::user()->permissions != 1){
			Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
			return redirect('/activities');
		} else {
			try{
				DB::table('comments_image')->where('id_image',$id)->delete();

				DB::table('image_activity')->where('id_image',$id)->delete();
				Toastr::success(' Image deleted', 'SUCCESS', ["positionClass" => "toast-top-center"]);

				return back();
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
	}
//function to update an activity
	public function Update(Request $request, $id){

		if (!Auth::user()!=null || Auth::user()->permissions != 1){
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

				DB::table('activities')
				->where('id_activity',$id)
				->update(['name' => $request->name,
					'description' => $request->description,
					'price' => $request->number]);

				Toastr::success('Activity updated', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}

		}
		return redirect('/activities');
	}

	public function __construct(FormBuilder $formBuilder)
	{
		$this->formBuilder = $formBuilder;
	}

	public function create(FormBuilder $formBuilder)
	{
		$form = $this->getForm();
		return view('activities.createActivities', compact('form'));
	}
//function to store the new idea
	public function store(FormBuilder $formBuilder)
	{
		if (!Auth::user()!=null){
			Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);
		} else {
			try{
				request()->validate([
					'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:32736',
				]);

				$form = $this->getForm();
				$imageName = time() . '.' . request()->image->getClientOriginalExtension();
				request()->image->move(public_path('images'), $imageName);

				if(!empty($imageName) && !empty($form->getFieldValues())){
					DB::table('image')->insert(array(
						'url_image' => $_FILES["image"]["name"]));
					$id = DB::getPdo()->lastInsertId();;

					DB::table('image')->where('id_image',$id)->update(['url_image' => $imageName]);
					DB::table('activities')->insert(array(
						'name'=>$_POST['nom'],
						'description'=>$_POST['content'],
						'price'=>$_POST['price'],
						'date' => $_POST['date'],
						'id' => Auth::id(),
						'recursivity' => $_POST['recuring'],
						'id_image'=>$id));
				}
				Toastr::success('Activity stored', 'SUCCESS', ["positionClass" => "toast-top-center"]);
			}
			catch(Exception $e){
				echo $e->getMessage();
			}
		}
		return redirect(route('activitiesIndex'));
	}
//function to get the form
	public function getForm()
	{
		return $this->formBuilder->create(PostForm::class, [
			'data' => [
				'admin' => true
			]
		]);
	}


}
