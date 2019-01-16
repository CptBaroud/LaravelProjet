<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PostForm extends Form
{
    public function buildForm()
    {
        if($this->getMethod() && $this->getModel()->id){
            $url = route('posts.update', $this->getModel()->id);
            $method = 'PUT';
            $label = "Editer l'article";
        }else{
            $url = route('posts.store');
            $method = 'POST';
            $label = "Créer l'article";
        }

        $this
            ->add('name', 'text',[
                'label' => 'Titre'
            ])
            ->add('content', 'textarea',[
                'label' => 'Content'
            ])
            ->add('submit', 'submit', ['label' => $label]);

        $this->formsOptions = [
            'method' => $method,
            'url' => $url
        ];
    }
}
