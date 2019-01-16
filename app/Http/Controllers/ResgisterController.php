<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResgisterController extends Controller
{
    public function create(){
        return view('registration.create');
    }
}
