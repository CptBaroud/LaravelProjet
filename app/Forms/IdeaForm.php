<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class IdeaForm extends Form
{
	public function buildForm()
	{

		$this->formOptions =[
			'method' => 'POST',
			'url'=>route('idea_box_create')];


			$this
			->add("Name","text",[
				'label' => 'Idea Name',
				'rules' => 'required|min:4'
			])
			->add("Description","textarea",[
				'label' => 'Description',
				'rules' => 'required|min:4'
			])
			->add("Free","checkbox")
			->add('submit', 'submit');
	}
}
