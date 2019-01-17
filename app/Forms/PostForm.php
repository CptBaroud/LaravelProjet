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
                'label' => 'Titre de l\'activité',
                'rules'=> 'require|min5:'
            ])
            ->add('content', 'textarea', [
                'label'=>'Descritpion',
                'rules'=>'require|min:15'
            ])
            ->add('date','date', [
                'label'=>'Date de l\'evenement'
            ])
            ->add('price', 'text', [
                'label'=> 'prix'
            ])
            ->add('image', 'file',[
                'label'=>'Image de l\'evenement'
            ])
            ->add('submit', 'submit', [
                'label'=> 'Envoyer'
            ]);

        $this->formOptions = [
            'method' => 'POST',
            'url' => route('activitiesStore')
        ];
    }

}
