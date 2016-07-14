<?php
namespace DevPro\adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="ip_user_mail_settings")
 */
class userMailSettings
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "Bitte eine gültige E-Mail Adresse eingeben",
     * )
     */
    protected $newUserSender;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    protected $newUserSubject;

    /**
     * @ORM\Column(type="text", length=255)
     * @Assert\NotBlank()
     */
    protected $newUserContent;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set newUserSender
     *
     * @param string $newUserSender
     * @return userMailSettings
     */
    public function setNewUserSender($newUserSender)
    {
        $this->newUserSender = $newUserSender;

        return $this;
    }

    /**
     * Get newUserSender
     *
     * @return string 
     */
    public function getNewUserSender()
    {
        return $this->newUserSender;
    }

    /**
     * Set newUserSubject
     *
     * @param string $newUserSubject
     * @return userMailSettings
     */
    public function setNewUserSubject($newUserSubject)
    {
        $this->newUserSubject = $newUserSubject;

        return $this;
    }

    /**
     * Get newUserSubject
     *
     * @return string 
     */
    public function getNewUserSubject()
    {
        return $this->newUserSubject;
    }

    /**
     * Set newUserContent
     *
     * @param string $newUserContent
     * @return userMailSettings
     */
    public function setNewUserContent($newUserContent)
    {
        $this->newUserContent = $newUserContent;

        return $this;
    }

    /**
     * Get newUserContent
     *
     * @return string 
     */
    public function getNewUserContent()
    {
        return $this->newUserContent;
    }
}
