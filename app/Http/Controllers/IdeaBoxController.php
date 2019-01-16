<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IdeaBoxController extends Controller
{
    public function index(){

    	return view('ideabox.index');
    }
}
