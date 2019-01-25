<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class mailcontroller extends Controller
{
    public function send(){
    	mail('francois.biron@viacesi.fr', 'Thank for your purchase !', 'You did purchase some product on our website, thanks bro');
    DB::table('product')->where('id_product',$id)
						->increment('purchase_number',1);
    	return back();
    }
}
