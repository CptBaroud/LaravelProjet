<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
	public function index(){
        $data = DB::table('activities')->get();
			return view('welcome', compact('data'));
	}
}
