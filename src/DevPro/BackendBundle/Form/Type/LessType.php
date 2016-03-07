<?php

namespace DevPro\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class LessType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('primary_color', TextType::class, array(
                'label' => 'Primary-Color',
                'required' => true
            ))
            ->add('secondary_color', TextType::class, array(
                'label' => 'Secondary-Color',
            ))
            ->add('save', SubmitType::class, array(
                'label' => 'speichern',
                'attr' => array(
                    'class' => 'btn btn--important '
                )
            ))
        ;
    }
}