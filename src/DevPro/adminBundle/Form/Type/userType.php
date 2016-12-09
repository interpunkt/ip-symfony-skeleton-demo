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
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\DependencyInjection\Container;


class userType extends AbstractType
{
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
             ->add('email', EmailType::class, array(
                             'label' => 'E-Mail',
                             'required' => true
                         ))
             ->add('dp_surname', TextType::class, array(
                             'label' => 'Vorname',
                             'required' => true
                         ))
             ->add('dp_name', TextType::class, array(
                            'label' => 'Name',
                            'required' => true
                        ))
            ->add('username', HiddenType::class, array(
                            'data' => uniqid(),
                        ))
            ->add('roles', ChoiceType::class, array(
                'label' => 'Benutzerrolle',
                'choices' => $this->getExistingRoles(),
                'expanded' => true,
                'multiple' => true,
                'mapped' => true,
            ))
        ;
    }

    public function getExistingRoles()
    {
        $roleHierarchy = $this->container->getParameter('security.role_hierarchy.roles');
        $roles = array_keys($roleHierarchy);

        foreach ($roles as $role) {
            $theRoles[$role] = $role;
        }
        return $theRoles;
    }
}