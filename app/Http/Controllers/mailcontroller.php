<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;
// Please specify your Mail Server - Example: mail.example.com.
ini_set("SMTP","smtp.gmail.com");

// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
ini_set("smtp_port","587");

// Please specify the return address to use
ini_set('sendmail_from', 'fransosichewot@gmail.com');

error_reporting(-1);

ini_set('display_errors', 'On');


class mailcontroller extends Controller
{
    public function send(){
    	/**Mail::send(['text'=>'mail'],['name','TEST'], function($message){
    		$message->to('fransosichewot@gmail.com','To Test')->subject('test email');
    		$message->from('iamnotarerolldudet@gmail.com','test');
    	});**/
    	$mail = mail('iamnotarerolldude@gmail.com', 'Mon Sujet', 'SALUT LE TEST');
    	return back();
    }
}
