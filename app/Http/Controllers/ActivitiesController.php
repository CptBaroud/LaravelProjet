<?php

namespace App\Http\Controllers;

use App\Forms\PostForm;
use App\Post;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class ActivitiesController extends Controller
{
	public function index(FormBuilder $formBuilder){

        $form = $formBuilder->create(PostForm::class, [
            'data' => [
                'admin' => true
            ]
        ]);


        	return view('activities.createActivities', compact('form'));



	}
}
