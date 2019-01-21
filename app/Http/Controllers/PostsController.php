<?php

namespace App\Http\Controllers;

use App\Forms\PostForm;
use App\Post;
use Illuminate\Support\Facades\DB;
use Kris\LaravelFormBuilder\FormBuilder;
use Auth;

class PostsController extends Controller
{
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
        //request()->validate([
           // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:32736',
        //]);

        $form = $this->getForm();
        $imageName = time() . '.' . request()->image->getClientOriginalExtension();
        request()->image->move(public_path('images'), $imageName);

        if(!empty($imageName) && !empty($form->getFieldValues())){
            DB::table('image')->insert(array(
                'url_image' => $_FILES["image"]["name"]));
            $id = DB::getPdo()->lastInsertId();;

            DB::table('image')->where('id_image',$id)->update(['url_image' => $imageName]);
            DB::table('activities')->insert(array(
                'name'=>$_POST['nom'],
                'description'=>$_POST['content'],
                'price'=>$_POST['price'],
                'date' => $_POST['date'],
                'id_image'=>$id));
        }

        return redirect(route('activitiesIndex'));
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
