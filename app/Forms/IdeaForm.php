<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class IdeaForm extends Form
{
	public function buildForm()
	{

		$this->formOptions  =[
			'method' => 'POST',
			'url'=>route('idea_box_create')];


			$this
			->add("Name","text")
			->add("Description","textarea")
			->add("Free","checkbox")
			->add('submit', 'submit');
	}
}
