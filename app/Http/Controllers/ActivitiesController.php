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

        if(auth()->guest()) {
        	return redirect('connection')->withErrors([
        		'password' => 'Please Log In'

        	]);

        } else {
        	return view('activities.createActivities', compact('form'));
        }

        return view('activities.activity');

	}
}
