<?php
// src/adminBundle/Entity/Settings.php

namespace DevPro\adminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="index")
 */
class index
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
     * @ORM\Column(type="integer", length=255)
     */
    protected $customId;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $x;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $y;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $width;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    protected $height;

    /**
     * @ORM\Column(type="text")
     */
    protected $content;
}