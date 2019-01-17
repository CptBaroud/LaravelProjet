<?php

namespace App\Http\Controllers;

use App\Forms\PostForm;
use App\Post;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\FormBuilder;

class PostsController extends Controller
{
    /*private $formBuilder;

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    public function create()
    {
        $form = $this->getForm();
        return view('posts.create', compact('form'));
    }

    public function edit(Post $post)
    {
        $form = $this->getForm($post);
        return view('posts.create', compact('form'));
    }

    public function store()
    {
        $form = $this->getForm();
        $form->redirectIfNotValid();
        $form->getModel()->save();
        return redirect()->route('posts.index');
    }

    public function update(Post $post, Request $request)
    {
        $form = $this->getForm($post);
        $form->redirectIfNotValid();
        $post->save();
        return redirect()->route('posts.index');
    }

    public function getForm(?Post $post = null): PostForm
    {
    $post = $post ?: new Post();
    return $this->formBuilder->create(PostForm::class, [
        'model' => $post
    ]);
    }
*/

    public function create(FormBuilder $formBuilder){
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
    }
}
