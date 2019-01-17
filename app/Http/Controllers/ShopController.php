<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Kris\LaravelFormBuilder\FormBuilder;
use App\Forms\ItemsForm;
class ShopController extends Controller
{
    public function index(FormBuilder $formBuilders){
$Itemform = $formBuilders->create(ItemsForm::class, [
            'data' => [
                'admin' => true
            ]
        ]);
      if(auth()->guest()) {
        return redirect('connection')->withErrors([
          'password' => 'Please Log In'

        ]);
		

      } else {
    	return view('shop.createItems', compact('Itemform'));
    }
    }
}
