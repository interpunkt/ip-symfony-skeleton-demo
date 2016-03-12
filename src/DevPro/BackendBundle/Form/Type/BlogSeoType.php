<?php

namespace DevPro\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class BlogSeoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('seo_titel', TextType::class, array(
                'label' => 'Seo Titel',
                'required' => true
            ))
            ->add('seo_description', TextareaType::class, array(
                'label' => 'Seo Description',
                'required' => true,
                'attr' => array('rows' => '10', 'id' => 'seoCharCounter'),
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