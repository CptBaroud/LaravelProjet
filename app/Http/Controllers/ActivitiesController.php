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

    public function showActivity($id)
    {
        $data = DB::table('activities')->where('id_activity', $id)->get();
        return view('activities.showactivity', compact('data'));
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
				DB::table('comments_image')->insert(array(
					'comment'=> $request->comment,
					'users'=> $id_user,
					'id_image'=>$id_image
				));
			return back();

		}

		public function showComments($id, $id_image)
		{
				$comments = DB::table('comments_image')
				->join('image_activity', 'comments_image.id_image', '=', 'image_activity.id_image')
				->where('image_activity.id_image', $id_image)
				->get();
				$url_image = DB::table('image_activity')->where('id_image', $id_image)->select('url_image')->get();
				$url = $url_image[0]->url_image;



				return view('activities.showcomments', compact('comments','id_image', 'url'));
		}



			public function Like($id){
				DB::table('ideas_box')
				->where('id_idea',$id)
				->increment('nber_likes');

				return redirect('/idea_box');
			}


			public function Edit($id){
				$data = DB::table('activities')->
				where('id_activity',$id)->get();

				$url_image = DB::table('image')->where('id_image',$data[0]->id_image)->select('url_image')->get();

				return view('activities.activityedit',compact('data', 'url_image'));
			}


			public function Delete($id){

				$data_img = DB::table('image_activity')->where('id_activity',$id)->get();
				$id_img = DB::table('activities')->where('id_activity',$id)->get();

				foreach ($data_img as $key => $data_img) {
					DB::table('comments_image')->where('id_image',$data_img->id_image)->delete();

				}

				DB::table('image_activity')->where('id_activity', $id)->delete();
				DB::table('image')->where('id_image', $id_img[0]->id_image)->delete();


				return redirect('/activities');

			}
}
