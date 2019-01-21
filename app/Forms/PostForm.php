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
                'label' => 'Descritpion',
                'rules' => 'required'
            ])
            ->add('date', 'datetime-local', [
                'label' => 'Date de l\'evenement'
            ])
            ->add('price', 'text', [
                'label' => 'Price'
            ])
            ->add('image', 'file', [
                'label' => 'Picture'
            ])
            ->add('submit', 'submit');
    }

}
