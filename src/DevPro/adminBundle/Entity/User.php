<?php
// src/AppBundle/Entity/user.php

namespace DevPro\adminBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $dp_surname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Type("string")
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Mindestens {{ limit }} Zeichen länge!",
     *      maxMessage = "Maximal {{ limit }} Zeichen länge!"
     * )
     */
    protected $dp_name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "Bitte eine gültige E-Mail Adresse eingeben",
     * )
     */
    protected $email;
    

    /**
     * Set dp_surname
     *
     * @param string $dpSurname
     * @return User
     */
    public function setDpSurname($dpSurname)
    {
        $this->dp_surname = $dpSurname;

        return $this;
    }

    /**
     * Get dp_surname
     *
     * @return string 
     */
    public function getDpSurname()
    {
        return $this->dp_surname;
    }

    /**
     * Set dp_name
     *
     * @param string $dpName
     * @return User
     */
    public function setDpName($dpName)
    {
        $this->dp_name = $dpName;

        return $this;
    }

    /**
     * Get dp_name
     *
     * @return string 
     */
    public function getDpName()
    {
        return $this->dp_name;
    }
}
