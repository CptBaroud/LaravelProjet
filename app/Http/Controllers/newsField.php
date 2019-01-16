<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class newsField extends Controller
{
    public function create(){
        return view('news.field');
    }
}
