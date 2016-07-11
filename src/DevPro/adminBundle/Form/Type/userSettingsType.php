<?php


namespace DevPro\adminBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;


class userSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('repo', TextType::class, array(
                'label' => 'E-Mail',
                'required' => true
            ))
            ->add('view', CheckboxType::class, array(
                'label' => 'ansehen'
            ))
            ->add('edit', CheckboxType::class, array(
                'label' => 'bearbeiten'
            ))
            ->add('delete', CheckboxType::class, array(
                'label' => 'löschen'
            ))
        ;
    }
}