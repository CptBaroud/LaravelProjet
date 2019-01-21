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

    $data = DB::table('product')->orderBy('purchase_number','desc')
                                ->take(3)
                                ->get();
    $category = DB::table('categories')->orderBy('category_name', 'desc')
                                       ->get();
    return view('shop.shop', compact('data','category'));
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
      $reponse = DB::table('categories')->select('category_name')
                                        ->where('category_name','=', $_POST['Category_name'])
                                        ->take(3)
                                        ->get();
      echo "<script>console.log( 'Debug Objects: " . $reponse . "' );</script>";
      if ($reponse == '[]') {  
        DB::table('categories')->insert(array('category_name' => $_POST['Category_name']));
        $id = DB::getPdo()->lastInsertId();;
        DB::table('product')->insert(array('Product_name'=>$_POST['Product_name'],'Product_description'=>$_POST['Product_description'],'Price'=>$_POST['Price'],'url_image'=>$_POST['Url_image'],'purchase_number'=>'0','id_category'=>$id));

      }else { 
        $idCategory = DB::table('categories')->select('id_category')
                                             ->where('category_name','=', $_POST['Category_name'])
                                              ->get();
        $idCategory = substr($idCategory, 16, -2);
        DB::table('product')->insert(array('Product_name'=>$_POST['Product_name'],'Product_description'=>$_POST['Product_description'],'Price'=>$_POST['Price'],'url_image'=>$_POST['Url_image'],'purchase_number'=>'0','id_category'=>$idCategory));

      } 
           return redirect('/shop');


    }
  }
  public function Delete($id){

    DB::table('product')->where('id_product',$id)->delete();
    DB::table('categories')->where('id_category',$id)->delete();

    return redirect('/shop');

  }

    public function Update(Request $request, $id){
    DB::table('product')
    ->where('id_product',$id)
    ->update(['product_name' => $request->name, 'product_description' => $request->description,'price' => $request->number]);


    return redirect('/shop');
  }

  public function Edit($id){
    $data = DB::table('product')->where('id_product',$id)->get();

    return view('shop.shopedit',compact('data'));
  }

   public function Achat($id){
    DB::table('product')
    ->where('id_product',$id)
    ->increment('purchase_number',1);
      return redirect('/shop');
    }

  public function category($id){
        $data = DB::table('product')->where('id_category', '=', $id)
                                    ->get();
        $category = DB::table('categories')
                                       ->get();

    return view('shop.shop', compact('data','category'));
}
}