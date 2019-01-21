<?php

namespace App\Http\Controllers;

use App\Forms\PostForm;
use App\Post;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;
use DB;


class ActivitiesController extends Controller
{
	public function index(FormBuilder $formBuilder)
    {
        $data = DB::table('activities')->get();
        return view('activities.activity', compact('data', 'img'));

    }
}
