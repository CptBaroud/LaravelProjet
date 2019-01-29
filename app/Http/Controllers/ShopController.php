<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ItemsForm;
use DB;
use Auth;
use File;
use Toastr;
use Illuminate\Support\Facades\Input;
use App\Post;
class ShopController extends Controller
{

  public function index(){

    if (!Auth::user()!=null){
      Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

      return back();

    } else {

      $permission = Auth::user()->permissions;

      $data = DB::table('product')->orderBy('purchase_number','desc')
                                  ->take(3)
                                  ->get();
      $category = DB::table('categories')->orderBy('category_name', 'desc')
                                         ->get();
      return view('shop.shop', compact('data','category', 'permission'));
    }

  }

  public function Itemform(FormBuilder $formBuilder){

    if (!Auth::user()!=null || Auth::user()->permissions != 1){
      Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
      return redirect('/');
    } else {

    $Itemform = $formBuilder->create(ItemsForm::class);


    if(auth()->guest()) {
        return redirect('connection')->withErrors([
          'password' => 'Please Log In'

        ]);

      }
  else {
      return view('shop.createItems', compact('Itemform'));
    }
    return view('shop.createItems', compact('Itemform'));

  }
  }



  public function CreateItems(){

    if (!Auth::user()!=null || Auth::user()->permissions != 1){
      Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
      return redirect('/');
    } else {

    request()->validate([
      'Picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:4096',
    ]);

    $imageName = time() . '.' . request()->Picture->getClientOriginalExtension();
    request()->Picture->move(public_path('images'), $imageName);

    if(!empty($_POST)){
      $reponse = DB::table('categories')->select('category_name')
                                        ->where('category_name','=', $_POST['Category_name'])
                                        ->get();



      if ($reponse == '[]') {
        DB::table('categories')->insert(array('category_name' => $_POST['Category_name']));
         $id = DB::getPdo()->lastInsertId();;
         echo "<script>console.log( 'Debug Objects: " . $reponse . "' );</script>";

        DB::table('product')->insert(array('Product_name'=>$_POST['Product_name'],'Product_description'=>$_POST['Product_description'],'Price'=>$_POST['Price'],'url_image' => $_FILES["Picture"]["name"],'purchase_number'=>'0','id_category'=>$id));

        $id = DB::getPdo()->lastInsertId();;

        DB::table('product')->where('id_product',$id)->update(['url_image' => $imageName]);

      }else {
        $idCategory = DB::table('categories')->select('id_category')
                                             ->where('category_name','=', $_POST['Category_name'])
                                             ->get();
        $idCategory = substr($idCategory, 16, -2);
        DB::table('product')->insert(array('Product_name'=>$_POST['Product_name'],'Product_description'=>$_POST['Product_description'],'Price'=>$_POST['Price'],'url_image' => $_FILES["Picture"]["name"],'purchase_number'=>'0','id_category'=>$idCategory));
        $id = DB::getPdo()->lastInsertId();;

        DB::table('product')->where('id_product',$id)->update(['url_image' => $imageName]);

      }
      return redirect('/shop');

    }

    }
  }
  public function Delete($id){

    if (!Auth::user()!=null || Auth::user()->permissions != 1){
      Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);

    } else {

    DB::table('product')->where('id_product',$id)->delete();
    DB::table('categories')->where('id_category',$id)->delete();

    }

    return redirect('/shop');

  }

  public function Update(Request $request, $id){

    if (!Auth::user()!=null || Auth::user()->permissions != 1){
      Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
      return redirect('/');
    } else {

    $save = $id;
    $user = new file;
    if(Input::hasFile('file')){
      $file = Input::file('file');
      $file->move(public_path(). '/images', $file->getClientOriginalName());
      $user->title = $file->getClientOriginalName();
      $id = DB::getPdo()->lastInsertId();
      DB::table('product')->where('id_product', $save)->update(array(
        'url_image'=>$user->title
      ));
    }
      DB::table('product')->where('id_product',$save)
                          ->update(['product_name' => $request->name,'product_description' => $request->description,'price' => $request->number]);



    return redirect('/shop');
  }
  }

  public function Edit($id){

    if (!Auth::user()!=null || Auth::user()->permissions != 1){
      Toastr::warning("You arent able to do that!", 'WARNING', ["positionClass" => "toast-top-center"]);
      return redirect('/');
    } else {
    $data = DB::table('product')->where('id_product',$id)->get();
      return view('shop.shopedit',compact('data'));
    }
  }

  public function Category($id){

    if (!Auth::user()!=null){
      Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

      return back();

    } else {

    $permission = Auth::user()->permissions;

    $data = DB::table('product')->where('id_category', '=', $id)
    ->get();
    $category = DB::table('categories')
    ->get();

    return view('shop.shop', compact('data','category','permission'));
  }
  }


  public function PriceFilterDesc(){
    if (!Auth::user()!=null){
      Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

      return back();

    } else {
      $permission = Auth::user()->permissions;

    $data = DB::table('product')->orderBy('price', 'desc')
                                ->get();

    $category = DB::table('categories')->orderBy('category_name', 'desc')
                                       ->get();
    return view('shop.shop', compact('data','category'));
  }

  }
   public function PriceFilterasc(){

     if (!Auth::user()!=null){
       Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

       return back();

     } else {

      $permission = Auth::user()->permissions;
      $data = DB::table('product')->orderBy('price', 'asc')->get();

      $category = DB::table('categories')->orderBy('category_name', 'desc')
                                         ->get();
      return view('shop.shop', compact('data','category','permission'));
    }
  }

 public function fetch(Request $request)
 {

     if($request->get('query'))
     {
      $query = $request->get('query');
      $data = DB::table('product')
        ->where('product_name', 'LIKE', "%{$query}%")
        ->get();
        $product = DB::table('product')
        ->where('product_name', 'LIKE', "%{$query}%")
        ->get();
      $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
      foreach($data as $row)
      {

       $output .= "<li><a href='/shop/request/{$row->product_name}'>".$row->product_name."</a></li>";
      }
      $output .= '</ul>';
      print $output;
     }

  }


public function display($product_name)
  {
    if (!Auth::user()!=null){
      Toastr::warning("You arent logged!", 'WARNING', ["positionClass" => "toast-top-center"]);

      return back();

    } else {
      $permission = Auth::user()->permissions;

      $data = DB::table('product')->where('product_name',$product_name)
                                ->get();
      $category = DB::table('categories')->orderBy('category_name', 'desc')
                                         ->get();
      return view('shop.shop', compact('data','category', 'permission'));
    }
  }

}
