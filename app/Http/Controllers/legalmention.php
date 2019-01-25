<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class legalmention extends Controller
{
    public function index(){

    	return view('legalmention.legalmention');
    }

    public function mention(){

    	return view('legalmention.purchasemention');
    }

}
