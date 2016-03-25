<?php

namespace DevPro\FrontendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class KontaktformularType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, array(
                'label' => 'Titel',
                'required' => true
            ))
            ->add('betreff', TextType::class, array(
                'label' => 'Inhalt',
            ))
            ->add('nachricht', TextareaType::class, array(
                'label' => 'Inhalt'
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'senden',
                'attr' => array(
                    'class' => 'btn btn--important',
                    'formnovalidate'=> true,
                )
            ))
        ;
    }
}