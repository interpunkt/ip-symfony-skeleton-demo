<?php

namespace DevPro\adminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
use FM\ElfinderBundle\Form\Type\ElFinderType;

class blogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sort', TextType::class, array(
                'label' => 'Sort',
                'required' => true
            ))
            ->add('titel', TextType::class, array(
                'label' => 'Titel',
                'required' => true
            ))
            ->add('image',ElFinderType::class, array(
                'instance'=>'form',
                'enable'=>true,
                'label'=>'File'
            ))
            ->add('content', CKEditorType::class, array(
                'config' => array(
                    'filebrowserBrowseRoute' => 'elfinder',
                    'filebrowserBrowseRouteParameters' => array(
                        'instance' => 'default',
                        'homeFolder' => ''
                    )
                ),
            ))
        ;
    }
}