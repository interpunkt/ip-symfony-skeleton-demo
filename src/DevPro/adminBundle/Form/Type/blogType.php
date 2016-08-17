<?php

namespace DevPro\adminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

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
            ->add('content', TextareaType::class, array(
                'label' => 'Inhalt',
                'required' => true,
                'attr' => array('class' => 'tinymce'),
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'speichern',
                'attr' => array(
                    'class' => 'btn btn-primary',
                    'formnovalidate'=> true,
                )
            ))
        ;
    }
}