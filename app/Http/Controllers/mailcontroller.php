<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
use DB;
use Auth;
class mailcontroller extends Controller
{
	public function send($id){
		$id_user=Auth::id();
		$mail = DB::table('users')->where('id',$id_user)->select('email')->get();
		mail($mail[0]->email, 'Thank for your purchase !', 'You did purchase some product on our website, thanks bro');

		$admin = DB::table('users')->where('permissions', '1')->select('email')->get();
		foreach ($admin as $key) {
			mail($admin[0]->email, $mail[0]->email.' purchase on your website', 'Somebody just purchase on the website');
		}
		DB::table('product')->where('id_product',$id)
		->increment('purchase_number',1);
		Toastr::success('Mail send', 'SUCCESS', ["positionClass" => "toast-top-center"]);
		return back();
	}
}
