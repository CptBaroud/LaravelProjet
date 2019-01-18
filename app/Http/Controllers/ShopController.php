<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ItemsForm;
use DB;
class ShopController extends Controller
{

public function index(){

    $data = DB::table('product')->get();

    return view('shop.shop', compact('data'));
  }

    public function Itemform(FormBuilder $formBuilder){

    $Itemform = $formBuilder->create(ItemsForm::class, [
            'data' => [
                'admin' => true
            ]
        ]);


    /*if(auth()->guest()) {
        return redirect('connection')->withErrors([
          'password' => 'Please Log In'

        ]);
    
} 
  else {
      return view('shop.createItems', compact('Itemform'));
    }*/
    return view('shop.createItems', compact('Itemform'));
    }

    public function CreateItems(){
    if(!empty($_POST)){
      DB::table('categories')->insert(array('category_name'=>$_POST['Category_name']));

      $id = DB::getPdo()->lastInsertId();;

      DB::table('product')->insert(array('Product_name'=>$_POST['Product_name'],'Product_description'=>$_POST['Product_description'],'Price'=>$_POST['Price'],'purchase_number'=>$_POST['Purchase_number'],'url_image'=>$_POST['Url_image'],'id_category'=>$id));
      return redirect('/shop');


    }
  }
public function deleteItems(){
  print'<div id="wrapper">
                <div class="animate form">
                    <form method="post" action="admin.php?action=del&submit=true" autocomplete="on">
                        <h1>Supprimer un article</h1> 
                        <p> 
                            <label for="username" class="" data-icon="" > Nom : </label>
                            <input name="nom" required="required" type="text" placeholder=""/>
                        </p>
                        <p class="login button"> 
                            <input type="submit" value="Supprimer" /> 
                        </p>'; 

  return view('shop.shop');
}
    public function Delete($id){
    DB::table('product')->where('id_product',$id)->delete();

    return redirect('/shop');

  }
}