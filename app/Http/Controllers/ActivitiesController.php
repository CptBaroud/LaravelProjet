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



class ActivitiesController extends Controller
{
	public function index(FormBuilder $formBuilder)
    {

			if (Auth::user()!=null){
				$permission = Auth::user()->permissions;
			}
        $data = DB::table('activities')->get();
        return view('activities.activity', compact('data', 'permission'));

    }

    public function DownloadUsers($id)
    {
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

		public function showActivity($id)
    {
			if (Auth::user()!=null){
				$permission = Auth::user()->permissions;
			}
        $data = DB::table('activities')->where('id_activity', $id)->get();
       return view('activities.showActivity', compact('data'));
    }

		public function AddPicture($id)
		{
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
			return back();

		}


		public function SendComment(Request $request, $id_image)
		{
			$id_user = Auth::id();
			$user_name = Auth::user()->first_name.' '.Auth::user()->last_name;

				DB::table('comments_image')->insert(array(
					'comment'=> $request->comment,
					'user'=> $id_user,
					'user_name'=> $user_name,
					'nbr_likes'=> 0,
					'id_image'=>$id_image
				));


			return back();

		}

		public function DeleteComment(Request $request, $id_comment)
		{
				DB::table('comments_image')->where('id_comment', $id_comment)->delete();
			return back();
		}

		public function LikeComment(Request $request, $id_comment)
		{
			$id_user = Auth::id();
			$data =DB::table('comments_image')->where('id_comment', $id_comment)->get();
			$current_value_likes = $data[0]->likes;
			$current_value_nbr_likes = $data[0]->nbr_likes;
					DB::table('comments_image')->where('id_comment', $id_comment)->update(array(
						'likes'=>$current_value_likes.$id_user.';',
						'nbr_likes' => $current_value_nbr_likes + 1
					));

			return back();

		}

		public function UnLikeComment(Request $request, $id_comment)
		{
			$id_user = Auth::id();
			$data =DB::table('comments_image')->where('id_comment', $id_comment)->get();

			$current_value_likes = str_replace($id_user.';',"",$data[0]->likes);
			$current_value_nbr_likes = $data[0]->nbr_likes;
					DB::table('comments_image')->where('id_comment', $id_comment)->update(array(
						'likes'=>$current_value_likes,
						'nbr_likes' => $current_value_nbr_likes - 1
					));

			return back();

		}

		public function showComments($id, $id_image)
		{



			if (Auth::user()!=null){
				$permission = Auth::user()->permissions;
			}
				$comments = DB::table('comments_image')
				->join('image_activity', 'comments_image.id_image', '=', 'image_activity.id_image')
				->where('image_activity.id_image', $id_image)
				->get();
				$url_image = DB::table('image_activity')->where('id_image', $id_image)->select('url_image')->get();
				$url = $url_image[0]->url_image;



				return view('activities.showcomments', compact('comments','id_image', 'url', 'permission'));
		}



			public function Like($id){
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

				return back();
			}

			public function UnLike(Request $request, $id)
			{
				$id_user = Auth::id();
				$data =DB::table('activities')->where('id_activity', $id)->get();

				$current_value_likes = str_replace($id_user.';',"",$data[0]->users_registered);
						DB::table('activities')->where('id_activity', $id)->update(array(
							'users_registered'=>$current_value_likes
						));

				return back();

			}


			public function Edit($id){
				$data = DB::table('activities')->where('id_activity',$id)->get();

				$url_image = DB::table('image')->where('id_image',$data[0]->id_image)->select('url_image')->get();

				return view('activities.activityedit',compact('data', 'url_image'));
			}


			public function Delete($id){

				DB::table('activities')->where('id_activity',$id)->delete();

				return redirect('/activities');

			}

			public function report($id, $id_comment){

				$admin = DB::table('users')->where('permissions', '1')->select('id')->get();

				foreach ($admin as $key => $admin) {
					$user_notify = \App\Users::find($admin->id);
					$user_notify->notify(new reportcomment());
				}
				return back()->withMessage('The comment has been reported');
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

					DB::table('activities')
					->where('id_activity',$id)
					->update(['name' => $request->name,
						'description' => $request->description,
						'price' => $request->number]);


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

				public function store(FormBuilder $formBuilder)
				{
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

						return redirect(route('activitiesIndex'));
				}

				public function getForm()
				{
						return $this->formBuilder->create(PostForm::class, [
								'data' => [
										'admin' => true
								]
						]);
				}


}
