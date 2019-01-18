<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ItemsForm extends Form
{
    public function buildForm()
    {

    	$this->formOptions =[
			'method' => 'POST',
			'url'=>route('Items_create')];


       $this
       		->add('Product name','text',[
       			'rules'=> 'required|min:5'
       		])
       		->add('Product description','textarea',[
       			'rules'=> 'required|min:5'
       		])
       		->add('Price', 'number')
       			//['rules'=> 'required|min:1']
       		
       		->add('Url image', 'url')
       			//['rules'=> 'required|url']
       		
       		->add('Purchase number', 'number')
       			//['rules'=> 'required|min:1']
       		
       		->add('submit', 'submit');

    }
}
