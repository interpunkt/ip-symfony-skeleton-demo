<?php

namespace DevPro\adminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('absender', TextType::class, array(
                'label' => 'Absender',
                'required' => true
            ))
            ->add('titel', TextType::class, array(
                'label' => 'Titel',
                'required' => true
            ))
            ->add('content', TextareaType::class, array(
                'label' => 'Inhalt',
                'attr' => array('class' => 'tinymce'),
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'speichern',
                'attr' => array(
                    'class' => 'btn btn--important',
                    'formnovalidate'=> true,
                )
            ))
        ;
    }
}