<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Http\Controllers\Controller;
use App\Forms\IdeaForm;
use DB;
use DataTables;
use App\Users;
use Illuminate\Support\Facades\Input;


class AdminController extends Controller{

	public function index(){
		return view('admin');

	}
/*
	public function Delete($id){
		DB::table('users')->where('id',$id)->delete();

		return redirect('/admin');

	}

	public function Save($id){

		$input = Input::all();
		$first_name = 'first_name'.$id;
		$last_name = 'last_name'.$id;
		$email = 'email'.$id;
		$location = 'location'.$id;
		$password = 'password'.$id;
		$permissions = 'permissions'.$id;

		if(isset($input[$password])){
			DB::table('users')->where('id',$id)->update(['last_name' => $input[$last_name],
			'first_name' => $input[$first_name],'email' => $input[$email], 'location' => $input[$location],
			'password' => bcrypt($input[$password]), 'permissions' => $input[$permissions]]);
		} else {
			DB::table('users')->where('id',$id)->update(['last_name' => $input[$last_name],
			'first_name' => $input[$first_name],'email' => $input[$email], 'location' => $input[$location],
			'permissions' => $input[$permissions]]);
		}


		return redirect('/admin');
	}*/

	function postdata(Request $request)
	    {
	        $validation = Validator::make($request->all(), [
	            'first_name' => 'required',
	            'last_name'  => 'required',
	        ]);

	        $error_array = array();
	        $success_output = '';
	        if ($validation->fails())
	        {
	            foreach($validation->messages()->getMessages() as $field_name => $messages)
	            {
	                $error_array[] = $messages;
	            }
	        }
	        else
	        {

	            if($request->get('button_action') == 'update')
	            {
	                $student = Users::find($request->get('student_id'));
	                $student->first_name = $request->get('first_name');
	                $student->last_name = $request->get('last_name');
									$student->email = $request->get('email');
									$student->location = $request->get('location');
									if($request->get('password') == null || $request->get('password') == ''){
										$student->password = bcrypt($request->get('password'));
									}
									$student->permissions = $request->get('permissions');
	                $student->save();
	                $success_output = '<div class="alert alert-success">Data Updated</div>';
	            }

	        }
	        $output = array(
	            'error'     =>  $error_array,
	            'success'   =>  $success_output
	        );
	        echo json_encode($output);
	    }


		public function removedata(Request $request)
		{
				$users = Users::find($request->input('id'));
				if($users->delete())
				{
						echo 'Data Deleted';
				}
		}

		function fetchdata(Request $request)
			{
					$id = $request->input('id');
					$users = Users::find($id);
					$output = array(
							'first_name'    =>  $users->first_name,
							'last_name'     =>  $users->last_name,
							'location'     =>  $users->location,
							'permissions'     =>  $users->permissions,
							'email'     =>  $users->email

					);
					echo json_encode($output);
			}

		public function get_Datatable(){
	      $users = Users::select('id', 'first_name', 'last_name', 'location', 'email', 'permissions');
	      return Datatables::of($users)
	             ->addColumn('action', function($users){
	                 return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$users->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#" class="btn btn-xs btn-danger delete" id="'.$users->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
	             })
	             ->make(true);
	     }
}
