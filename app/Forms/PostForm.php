<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use function Sodium\add;

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('nom', "text", [
                'label' => 'Titre de l\'activité'
            ])
            ->add('content', 'textarea')
            ->add('submit', 'submit');

        $this->formOptions = [
            'method' => 'POST',
            'url' => route('create')
        ];
    }
}
