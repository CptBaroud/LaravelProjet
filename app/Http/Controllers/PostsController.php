<?php

namespace App\Http\Controllers;

use App\Forms\PostForm;
use App\Post;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilder;

class PostsController extends Controller
{
    /*private $formBuilder;

    public function edit(Post $post)
    {
        $form = $this->getForm($post);
        return view('posts.create', compact('form'));
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
    /*
        public function create(FormBuilder $formBuilder){
           $form = $formBuilder->create(PostForm::class, [
                'data' => [
                    'admin' => true
                ]
            ]);

            /*if(auth()->guest()) {
                    return redirect('connection')->withErrors([
                        'password' => 'Please Log In'

                    ]);

                } else {
            return view('activities.createActivities', compact('form'));
          }*/

    public function __construct(FormBuilder $formBuilder)
    {
        $this->formBuilder = $formBuilder;
    }

    public function create(FormBuilder $formBuilder)
    {
        $form = $this->getForm();
        return view('activities.createActivities', compact('form'));
    }

    public function store(FormBuilder $formBuilder)
    {
        $form= $this->getForm();
        if (!empty($form->getFieldValues())) {
            DB::table('activities')->insert(array('name' => $_POST['nom'],
                'description' => $_POST['content'],
                'date' => $_POST['date'],
                'price' => $_POST['price']));
            dd($form->getFieldValues());
        }
    }

    public function storeImage(){
       request()->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
        ]);
        $imageName = time().'.'.request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);
        print_r($imageName);
        $form= $this->getForm();
        if (!empty($form->getFieldValues())) {
            $id = DB::table('image')->insertGetId(array('url_image'=>$_POST[$imageName]));
            DB::table('activities')->insert(array('name' => $_POST['nom'],
                'description' => $_POST['content'],
                'date' => $_POST['date'],
                'price' => $_POST['price'],
                'id_image'=>$_POST[$id]));
            dd($form->getFieldValues());
        }

        redirect('activitiesIndex   ');
    }

    public function getForm()
    {
        return $this->formBuilder->create(PostForm::class, [
            'data' => [
                'admin' => true
            ]
        ]);
    }
}
