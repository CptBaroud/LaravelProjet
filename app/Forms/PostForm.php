<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this->formOptions = [
            'method' => 'POST',
            'url' => route('activitiesStore')
        ];

        $this
            ->add('nom', "text", [
                'label' => 'Title',
                'rules' => 'required'
            ])
                ->add('content', 'textarea', [
                'label' => 'Description',
                'rules' => 'required'
            ])
            ->add('date', 'datetime-local', [
                'label' => 'Event time'
            ])
            ->add('price', 'number', [
                'label' => 'Price',
                'rules'=> 'required|max:200'
            ])
            ->add('image', 'file', [
                'label' => 'Picture'
            ])
            ->add('recuring', 'choice', [
                'choices' => ['0' => '', '1' => 'weekly', '2' => 'monthly', '3' => 'annual']
            ])
            ->add('submit', 'submit');
    }

}
