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
                'label' => 'Secondary-Color'
            ))
            ->add('primary_color_light', TextType::class, array(
                'label' => 'Primary-Color-Light',
                'data' => 'saturate(lighten(@primary-color, 12%), 5'
            ))
            ->add('secondary_color_dark', TextType::class, array(
                'label' => 'Secondary-Color-Dark',
                'data' => 'darken(@brand-secondary, 15%)'
            ))
            ->add('highlight_success', TextType::class, array(
                'label' => 'Highlight-Success',
            ))
            ->add('highlight_info', TextType::class, array(
                'label' => 'Highlight-Info',
            ))
            ->add('highlight_notice', TextType::class, array(
                'label' => 'Highlight-Notice',
            ))
            ->add('highlight_error', TextType::class, array(
                'label' => 'Highlight-Error',
            ))
            ->add('text_color', TextType::class, array(
                'label' => 'Text-Color',
            ))
            ->add('link_color', TextType::class, array(
                'label' => 'Link-Color',
            ))
            ->add('link_color_hover', TextType::class, array(
                'label' => 'Link-Color-Hover',
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