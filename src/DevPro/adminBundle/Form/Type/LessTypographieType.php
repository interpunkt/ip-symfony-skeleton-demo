<?php

namespace DevPro\adminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class LessTypographieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('font_size', TextType::class, array(
                'label' => 'Schriftgrösse P',
            ))
            ->add('font_family', TextType::class, array(
                'label' => 'Schrift Familie',
            ))
            ->add('h_one', TextType::class, array(
                'label' => 'H1',
            ))
            ->add('h_two', TextType::class, array(
                'label' => 'H2',
            ))
            ->add('h_three', TextType::class, array(
                'label' => 'H3',
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