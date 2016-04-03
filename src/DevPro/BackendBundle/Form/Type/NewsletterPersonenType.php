<?php

namespace DevPro\BackendBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NewsletterPersonenType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'E-Mail Adresse',
                'required' => true
            ))
            ->add('anrede', ChoiceType::class, array(
                'choices'  => array(
                    'Frau' => 'Frau',
                    'Herr' => 'Herr',
                )
            ))
            ->add('vorname', TextType::class, array(
                'label' => 'Vorname',
                'required' => true
            ))
            ->add('nachname', TextType::class, array(
                'label' => 'Nachname',
                'required' => true
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