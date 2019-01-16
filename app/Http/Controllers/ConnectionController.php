<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConnectionController extends Controller
{
	public function index(){

		return view('registration.connection');
	}
}
