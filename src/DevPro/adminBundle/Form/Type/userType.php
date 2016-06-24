<?php


namespace DevPro\adminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Email;


class userType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('email', EmailType::class, array(
                             'label' => 'E-Mail',
                             'required' => true
                         ))
             ->add('password', PasswordType::class, array(
                             'label' => 'Passwort',
                             'required' => true
                         ))
            ->add('save', SubmitType::class, array(
                            'label' => '',
                            'attr' => array(
                            'class' => 'btn btn--important '
                            )
                        ))

        ;
    }
}