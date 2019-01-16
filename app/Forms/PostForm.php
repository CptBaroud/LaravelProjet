<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('Nom', "text")
            ->add('content', 'textarea');

        if($this->getData('admin') === true){
            $this->add('created_at', 'date');
        }
    }
}
