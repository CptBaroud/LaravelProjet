<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
	public function index(){
		
		if(auth()->guest()) {
			return redirect('connection')->withErrors([
				'password' => 'Please Log In'

			]);

		} else {
			return view('welcome');
		}
	}
}
