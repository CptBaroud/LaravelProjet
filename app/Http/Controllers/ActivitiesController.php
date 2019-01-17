<?php

namespace App\Http\Controllers;

use App\Forms\PostForm;
use App\Post;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class ActivitiesController extends Controller
{
	public function index(FormBuilder $formBuilder){
        return view('activities.activity');
	}
}
