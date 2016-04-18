<?php

namespace DevPro\FrontendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="frontend_kontaktformular")
 */
class Foo
{
    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $betreff;

    /**
     * @ORM\Column(type="text")
     */
    protected $nachricht;

}